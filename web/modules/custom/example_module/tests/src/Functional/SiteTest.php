<?php

namespace Drupal\Tests\example_module\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test basic functionality of My Module.
 *
 * @group mymodule
 */
class SiteTest extends BrowserTestBase {

  protected $defaultTheme = 'seven';

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
    // Make sure to complete the normal setup steps first.
    parent::setUp();

    // Set the front page to "node".
    \Drupal::configFactory()
      ->getEditable('system.site')
      ->set('page.front', '/admin')
      ->save(TRUE);
  }

  /**
   * Make sure the site still works. For now just check the front page.
   */
  public function testTheSiteStillWorks() {
    // Load the front page.
    $this->drupalGet('<front>');

    // Confirm that the site didn't throw a server error or something else.
    $this->assertSession()->statusCodeEquals(403);
//    $this->assertSession()->statusCodeEquals(403);

    // Confirm that the front page contains the standard text.
    $this->assertText('Welcome to Drupal');

//    $this->assert('');
  }

}
