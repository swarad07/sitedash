<?php

namespace Drupal\sitedash\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class SiteDashController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    return [
      '#markup' => '<div id="site-dashboard"></div>',
      '#attached' => [
        'library' => [
          'sitedash/react_app',
        ],
      ],
    ];
  }

}
