<?php

namespace Drupal\tour\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block containing a Tour button.
 *
 * @Block(
 *   id = "tour_button_block",
 *   admin_label = @Translation("Tour button")
 * )
 */
class TourButtonBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [
      'button' => [
        '#type' => 'html_tag',
        '#tag' => 'button',
        '#value' => $this->t('Take a tour'),
        '#attributes' => [
          'aria-pressed' => 'false',
          'type' => 'button',
          'class' => ['tour-button'],
        ],
      ],
      '#attributes' => [
        'class' => ['hidden'],
      ],
      '#attached' => [
        'library' => [
          'tour/tour',
          'tour/tour-styling',
        ],
      ],
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'label_display' => FALSE,
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access tour');
  }

}
