<?php

namespace Drupal\sitedash;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for sitedash_entity entity.
 *
 * @ingroup sitedash
 */
class SitedashListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = [
      '#markup' => $this->t('These sitedash entities are fieldable. You can manage the fields on the <a href="@adminlink">Sitedash admin page</a>.', [
        '@adminlink' => \Drupal::urlGenerator()
          ->generateFromRoute('sitedash.sitedash_settings'),
      ]),
    ];

    $build += parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the sitedash list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {
    $header['id'] = $this->t('SitedashID');
    $header['name'] = $this->t('Name');
    $header['siteUrl'] = $this->t('Site URL');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\sitedash\Entity\Sitedash */
    $row['id'] = $entity->id();
    $row['name'] = $entity->link();
    $row['siteUrl'] = $entity->siteUrl->value;
    return $row + parent::buildRow($entity);
  }

}
