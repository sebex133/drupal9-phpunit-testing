<?php

namespace Drupal\example_module\Model;

/**
 * A simple model.
 */
class SimpleModel {

  private $data = [
    'parent1' => [
      'child1',
      'child12' => [
        'children3'
      ]
    ],
    'parent2' => [
      'child2',
      'child22',
    ],
  ];

  public function getData() {
    return $this->data;
  }
}
