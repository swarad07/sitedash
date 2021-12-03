<?php

namespace Drupal\sitedash\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form handler for the Sitedash add and edit forms.
 */
class SitedashForm extends EntityForm {

  /**
   * Constructs an SitedashForm object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entityTypeManager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $sitedash = $this->entity;

    // Change page title for the edit operation.
    if ($this->operation == 'edit') {
      $form['#title'] = $this->t('Edit sitedash: @label', ['@label' => $sitedash->label()]);
    }

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site Name'),
      '#maxlength' => 255,
      '#default_value' => $sitedash->label(),
      '#description' => $this->t("Label for the Sitedash Site."),
      '#required' => TRUE,
    ];
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $sitedash->id(),
      '#machine_name' => [
        'exists' => [$this, 'exist'],
      ],
      '#disabled' => !$sitedash->isNew(),
    ];
    $form['siteUrl'] = [
      '#type' => 'url',
      '#title' => $this->t('Site URL'),
      '#size' => 50,
      '#default_value' => $sitedash->getSiteUrl(),
      '#description' => $this->t("The Site URL."),
      '#required' => TRUE,
    ];
    $form['siteAPIUrl'] = [
      '#type' => 'url',
      '#title' => $this->t('Site API end point URL'),
      '#size' => 100,
      '#default_value' => $sitedash->getSiteAPIUrl(),
      '#description' => $this->t("API endpoint of the connector site."),
      '#required' => TRUE,
    ];
    $form['token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Token'),
      '#maxlength' => 255,
      '#default_value' => $sitedash->getToken(),
      '#description' => $this->t("API token for the site."),
      '#required' => TRUE,
    ];

    // You will need additional form elements for your custom properties.
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $sitedash = $this->entity;
    $status = $sitedash->save();

    if ($status === SAVED_NEW) {
      $this->messenger()->addMessage($this->t('The %label Sitedash Site created.', [
        '%label' => $sitedash->label(),
      ]));
    }
    else {
      $this->messenger()->addMessage($this->t('The %label Sitedash Site updated.', [
        '%label' => $sitedash->label(),
      ]));
    }

    $form_state->setRedirect('entity.sitedash.collection');
  }

  /**
   * Helper function to check whether an Sitedash configuration entity exists.
   */
  public function exist($id) {
    $entity = $this->entityTypeManager->getStorage('sitedash')->getQuery()
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }

}
