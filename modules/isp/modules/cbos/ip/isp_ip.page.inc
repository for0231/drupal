<?php

/**
 * @file
 * Contains isp_ip.page.inc.
 *
 * Page callback for IP entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for IP templates.
 *
 * Default template: isp_ip.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_isp_ip(array &$variables) {
  // Fetch Ip Entity Object.
  $isp_ip = $variables['elements']['#isp_ip'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
