<?php

namespace Drupal\sitedash\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\sitedash\SitedashInterface;

/**
 * Defines the Sitedash entity.
 *
 * @ConfigEntityType(
 *   id = "sitedash",
 *   label = @Translation("Sitedash"),
 *   handlers = {
 *     "list_builder" = "Drupal\sitedash\Controller\SitedashListBuilder",
 *     "form" = {
 *       "add" = "Drupal\sitedash\Form\SitedashForm",
 *       "edit" = "Drupal\sitedash\Form\SitedashForm",
 *       "delete" = "Drupal\sitedash\Form\SitedashDeleteForm",
 *     }
 *   },
 *   config_prefix = "sitedash",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "siteUrl",
 *     "siteAPIUrl",
 *     "token"
 *   },
 *   links = {
 *     "edit-form" = "/admin/config/system/sitedash/{sitedash}",
 *     "delete-form" = "/admin/config/system/sitedash/{sitedash}/delete",
 *   }
 * )
 */
class Sitedash extends ConfigEntityBase implements SitedashInterface {

  /**
   * The Sitedash ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Sitedash label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Sitedash Site URL.
   *
   * @var string
   */
  public $siteUrl;

  /**
   * The Sitedash Site API Endpoint URL.
   *
   * @var string
   */
  public $siteAPIUrl;

  /**
   * The Sitedash Site API token.
   *
   * @var string
   */
  public $token;

  // Your specific configuration property get/set methods go here,
  // implementing the interface.
  /**
   * {@inheritdoc}
   */
  public function getSiteUrl() {
    return $this->siteUrl;
  }

  /**
   * {@inheritdoc}
   */
  public function getSiteAPIUrl() {
    return $this->siteAPIUrl;
  }

  /**
   * {@inheritdoc}
   */
  public function getToken() {
    return $this->token;
  }

}
