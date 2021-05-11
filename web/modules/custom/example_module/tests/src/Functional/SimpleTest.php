<?php

namespace Drupal\Tests\example_module\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test basic functionality of example_module
 *
 * @group example_module
 */
class SimpleTest extends BrowserTestBase {

  //Drupal default theme
  protected $defaultTheme = 'seven';

  //const expected JSON array max depth
  const JSON_MAX_DEPTH_EXPECTED = 2;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    // Module(s) for core functionality.
    'node',
    'views',

    // This custom module.
    'example_module',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
  }

  /**
   * Test pageSimpleJson method in SimpleController
   */
  public function testSimpleJson() {
    $this->drupalGet('api/simple-json');
    $this->assertSession()->statusCodeEquals(200);

    $content = $this->getSession()->getPage()->getContent();
    $contentJsonArray = json_decode($content, true);
    $this->assertIsArray($contentJsonArray);

    $maxDepth = $this->getArrayDepth($contentJsonArray);

    $jsonMaxDepthExpected = static::JSON_MAX_DEPTH_EXPECTED;
    $jsonDepthErrorMessage = 'JSON response is not depth size ' . $jsonMaxDepthExpected;
    $this->assertEquals($jsonMaxDepthExpected, $maxDepth, $jsonDepthErrorMessage);

  }

  /**
   * Test pageSimpleJson method in SimpleController
   */
  public function testSimpleContent(){
    $this->drupalGet('page/simple-content');
    $this->assertSession()->statusCodeEquals(200);

    $this->assertSession()->pageTextContains('here is some simple content');
    $this->assertSession()->pageTextNotContains('error');
  }

  /**
   * method used to get array max depth
   */
  private function getArrayDepth($arrayElement, $depth = 0){
    $maxDepth = $depth;

    if(is_array($arrayElement)){
      foreach($arrayElement as $children){
        $resultDepth = $this->getArrayDepth($children, $depth++);
        if($resultDepth > $maxDepth){
          $maxDepth = $resultDepth;
        }
      }
    }

    return $maxDepth;
  }

}
