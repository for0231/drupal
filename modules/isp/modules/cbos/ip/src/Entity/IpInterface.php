<?php

namespace Drupal\isp_ip\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining IP entities.
 *
 * @ingroup isp_ip
 */
interface IpInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the IP name.
   *
   * @return string
   *   Name of the IP.
   */
  public function getName();

  /**
   * Sets the IP name.
   *
   * @param string $name
   *   The IP name.
   *
   * @return \Drupal\isp_ip\Entity\IpInterface
   *   The called IP entity.
   */
  public function setName($name);

  /**
   * Gets the IP creation timestamp.
   *
   * @return int
   *   Creation timestamp of the IP.
   */
  public function getCreatedTime();

  /**
   * Sets the IP creation timestamp.
   *
   * @param int $timestamp
   *   The IP creation timestamp.
   *
   * @return \Drupal\isp_ip\Entity\IpInterface
   *   The called IP entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the IP published status indicator.
   *
   * Unpublished IP are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the IP is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a IP.
   *
   * @param bool $published
   *   TRUE to set this IP to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\isp_ip\Entity\IpInterface
   *   The called IP entity.
   */
  public function setPublished($published);

}
