<?php

namespace Drupal\sitedash;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a Contact entity.
 * @ingroup sitedash
 */
interface SitedashInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
