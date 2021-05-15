<?php

namespace Drupal\example_module\View;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * A simple view.
 */
class SimpleView {

  /**
   * Returns a JSON response array
   */
  public function view($data) {
    return new JsonResponse($data);
  }

}
