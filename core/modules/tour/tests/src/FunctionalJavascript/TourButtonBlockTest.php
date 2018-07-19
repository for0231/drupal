<?php

namespace Drupal\Tests\tour\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\JavascriptTestBase;
use Drupal\user\RoleInterface;

/**
 * Tests that tours can be started through the tour button block.
 *
 * @group tour
 */
class TourButtonBlockTest extends JavascriptTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['block', 'tour', 'tour_test'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // Place the tour button block in the sidebar.
    $this->drupalPlaceBlock('tour_button_block');

    // Grant permission to view tours to anonymous users.
    user_role_grant_permissions(RoleInterface::ANONYMOUS_ID, ['access tour']);
  }

  /**
   * Tests that tours can be started using the tour button block.
   */
  public function testTourButtonBlock() {
    // Check that the tour button is not visible on a page that does not offer a
    // tour.
    $this->drupalGet('user');
    $this->assertFalse($this->getTourButton()->isVisible());

    // Check that tours can be started by anonymous users if they have the
    // relevant permission and the block with the tour button is present.
    $this->drupalGet('tour-test-1');

    // The tour button should be visible.
    $this->assertTrue($this->getTourButton()->isVisible());
    $this->assertEquals($this->getTourButton()->getText(), 'Take a tour');

    // The tour should not yet have been started, so the first tour tip should
    // not be visible.
    $tour_tip = $this->getSession()->getPage()->find('css', '.tip-tour-test-1');
    $this->assertFalse($tour_tip->isVisible());

    // Click the button. Now the tour tip should become visible.
    $this->getTourButton()->click();
    $this->assertJsCondition("jQuery('.tip-tour-test-1').is(':visible')", 10000);

    // When the user doesn't have permission to view tours, the button should
    // not be present.
    user_role_revoke_permissions(RoleInterface::ANONYMOUS_ID, ['access tour']);
    $this->getSession()->getDriver()->reload();
    $this->assertFalse($this->getTourButton());
  }

  /**
   * Returns the tour button that is present in the page.
   *
   * @return \Behat\Mink\Element\NodeElement|FALSE
   *   The tour button, or FALSE if there is no tour button.
   */
  protected function getTourButton() {
    /** @var \Behat\Mink\Element\NodeElement[] $elements */
    $elements = $this->cssSelect('.block-tour-button-block button');
    if (empty($elements)) {
      return FALSE;
    }
    return reset($elements);
  }

}
