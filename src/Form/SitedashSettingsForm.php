<?php

namespace Drupal\sitedash\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SitedashSettingsForm.
 * @package Drupal\sitedash\Form
 * @ingroup sitedash
 */
class SitedashSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'sitedash_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Define the form used for Sitedash Entity settings.
   * @return array
   *   Form definition array.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['sitedash_settings']['#markup'] = 'Settings form for Sitedash Entity. Manage field settings here.';
    return $form;
  }
}
