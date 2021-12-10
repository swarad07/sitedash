<?php

namespace Drupal\sitedash;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Contact entity.
 * @ingroup sitedash
 */
interface SitedashInterface extends ContentEntityInterface, EntityOwnerInterface {

}
