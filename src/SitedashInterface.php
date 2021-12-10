<?php

namespace Drupal\sitedash;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining an Example entity.
 */
interface SitedashInterface extends ConfigEntityInterface {
// Add get/set methods for your configuration properties here.
  public function getSiteUrl();
  public function getToken();
  public function getSiteAPIUrl();
}
