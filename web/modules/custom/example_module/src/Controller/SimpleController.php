<?php

namespace Drupal\example_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\example_module\Model\SimpleModel;
use Drupal\example_module\View\SimpleView;

/**
 * An simple controller.
 */
class SimpleController extends ControllerBase {

  /**
   * Returns a JSON response array
   */
  public function apiSimpleJson() {
    $model = new SimpleModel;
    $simpleView = new SimpleView();
    return $simpleView->view($model->getData());
  }

  /**
   * Returns a render-able array for a test page.
   */
  public function pageSimpleContent() {
    return [
      '#markup' => $this->t('Hello World! here is some simple content'),
    ];
  }

}
