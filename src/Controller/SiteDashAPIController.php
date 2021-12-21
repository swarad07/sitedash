<?php
namespace Drupal\sitedash\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\sitedash\Entity\Sitedash;
use Laminas\Diactoros\Response\JsonResponse;

/**
 * A custom API endpoint for Sitedash portal.
 */
class SiteDashAPIController extends ControllerBase {

  /**
   * Returns a JSON response.
   */
  public function getData() {
    // This condition checks the `Content-type` and makes sure to
    // decode JSON string from the request body into array.
    $response = [];
    $request = \Drupal::request();
    $response['method'] = $request->getMethod();
    $data = $request->getContent();
    $decoded_data = json_decode($data, TRUE);
    // Basic Checks.
    if ($decoded_data === NULL) {
      $response['error_data'] = $this->t('Not an acceptable JSON Data.');
      return new JsonResponse($response);
    }

    // Create/Update.
    if ($response['method'] === 'POST') {
      // If id then we do update.
      if (!isset($decoded_data['id'])) {
        $sitedash_entity = Sitedash::create([
          'name' => $decoded_data['name'],
          'siteFavicon' => $decoded_data['faviconUrl'],
          'siteUrl' => $decoded_data['url'],
          'siteAPIUrl' => $decoded_data['endpoint'],
          'siteToken' => $decoded_data['token'],
        ]);
      }
      else {
        $sitedash_entity = Sitedash::load($decoded_data['id']);
        if (isset($sitedash_entity)) {
          $sitedash_entity->set('name', $decoded_data['name']);
          $sitedash_entity->set('siteFavicon', $decoded_data['faviconUrl']);
          $sitedash_entity->set('siteUrl', $decoded_data['url']);
          $sitedash_entity->set('siteAPIUrl', $decoded_data['endpoint']);
          $sitedash_entity->set('siteToken', $decoded_data['token']);
        }
        else {
          $response['error_data'] = $this->t('No entity found.');
          return new JsonResponse($response);
        }
      }
      // Expected: SAVED_NEW = 1 and SAVED_UPDATED = 2.
      $entity_saved_flag = $sitedash_entity->save();
      $response['entity_saved_flag'] = $entity_saved_flag;
      return new JsonResponse($response);
    }

    // Delete.
    if ($response['method'] === 'DELETE') {
      $sitedash_entity = \Drupal::entityTypeManager()->getStorage('sitedash_entity')->load($decoded_data['id']);
      try {
        $flag = $sitedash_entity->delete();
        $response['entity_saved_flag'] = 'Entity deleted';
        return new JsonResponse($response);
      }
      catch (\Exception $e) {
        $response['error_data'] = $e->getMessage();
        return new JsonResponse($response);
      }
    }
  }

}
