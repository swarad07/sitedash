<?php

namespace Drupal\sitedash\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Sitedash.
 */
class SitedashListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Sitedash');
    $header['id'] = $this->t('Machine name');
    $header['siteUrl'] = $this->t('Site URL');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['siteUrl'] = $entity->siteUrl;

    // You probably want a few more properties here...

    return $row + parent::buildRow($entity);
  }

}
