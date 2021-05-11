<?php

namespace Drupal\example_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * An simple controller.
 */
class SimpleController extends ControllerBase {

  /**
   * Returns a JSON response array
   */
  public function apiSimpleJson() {
    //2 level depth array for unit test
    return new JsonResponse([
      'parent1' => [
        'child1',
        'child12',
      ],
      'parent2' => [
        'child2',
        'child22',
      ],
    ]);
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
