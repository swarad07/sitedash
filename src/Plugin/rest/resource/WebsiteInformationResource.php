<?php

namespace Drupal\sitedash\Plugin\rest\resource;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Provides a Website Information Resource.
 *
 * @RestResource(
 *   id = "website_information_resource",
 *   label = @Translation("Website Information Resource"),
 *   serialization_class = "",
 *   uri_paths = {
 *     "canonical" = "/sitedash/information",
 *     "create" = "/sitedash/information"
 *   }
 * )
 */
class WebsiteInformationResource extends ResourceBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   * The current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * An http client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Constructs a Drupal\rest\Plugin\ResourceBase object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The Guzzle instance for HTTP requests.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, array $serializer_formats, LoggerInterface $logger, EntityTypeManagerInterface $entity_type_manager, AccountProxyInterface $current_user, ClientInterface $http_client) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
    $this->entityTypeManager = $entity_type_manager;
    $this->currentUser = $current_user;
    $this->httpClient = $http_client;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('sitedash_connector'),
      $container->get('entity_type.manager'),
      $container->get('current_user'),
      $container->get('http_client')
    );
  }

  /**
   * Responds to POST requests.
   *
   * Returns a list of bundles for specified entity.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function post($data) {
    // Set error message for unauthorised access.
    if (!$this->currentUser->hasPermission('access content')) {
      throw new AccessDeniedHttpException();
    }

    // Compute the required information based on request paramters.
    if (!empty($data['website_id']) && !empty($data['information'])) {
      // Get URL of the website from the sitedash entity and remove trailing
      // slash.
      $url = $this->entityTypeManager->getStorage('sitedash_entity')->load($data['website_id'])->get('siteUrl')->getValue()[0]['value'];
      $url = rtrim($url, '/');

      // Get token stored for the website in the entity settings.
      $token = $this->entityTypeManager->getStorage('sitedash_entity')->load($data['website_id'])->get('siteToken')->getValue()[0]['value'];

      // Logic to handle the different type of information request.
      switch ($data['information']) {
        case 'ping':
          $data = $this->getHttpResponseStatusCode($url);
          break;

        case 'status_report':
          $data = $this->getHttpData($url, $token, 'status_report');
          break;

        case 'logs':
          $data = $this->getHttpData($url, $token, 'logs');
          break;

        case 'content_statistics':
          $data = $this->getHttpData($url, $token, 'content_statistics');
          break;
      }

      return new ResourceResponse($data, 200);
    }

    return new ResourceResponse(['Invalid Request'], 200);
  }

  /**
   * Function to perform the actual HTTP request on connected websites.
   */
  public function getHttpData($url, $token, $information) {
    try {
      $response = $this->httpClient->post($url . '/sitedash-connector/website-information', [
        'json' => [
          'token' => $token,
          'information' => $information,
        ],
      ])->getBody()->getContents();
      if (!empty($response)) {
        return json_decode($response, TRUE);
      }
    }
    catch (RequestException $e) {
      return ['Invalid Request'];
    }
  }

  /**
   * Function to check HTTP status of a URL.
   */
  public function getHttpResponseStatusCode($url) {
    $status = NULL;

    $headers = @get_headers($url, 1);
    if (is_array($headers)) {
      $status = substr($headers[0], 9);
    }

    return $status;
  }

}
