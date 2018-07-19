<?php

namespace Drupal\isp_server\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Server entities.
 *
 * @ingroup isp_server
 */
interface ServerInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Server name.
   *
   * @return string
   *   Name of the Server.
   */
  public function getName();

  /**
   * Sets the Server name.
   *
   * @param string $name
   *   The Server name.
   *
   * @return \Drupal\isp_server\Entity\ServerInterface
   *   The called Server entity.
   */
  public function setName($name);

  /**
   * Gets the Server creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Server.
   */
  public function getCreatedTime();

  /**
   * Sets the Server creation timestamp.
   *
   * @param int $timestamp
   *   The Server creation timestamp.
   *
   * @return \Drupal\isp_server\Entity\ServerInterface
   *   The called Server entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Server published status indicator.
   *
   * Unpublished Server are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Server is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Server.
   *
   * @param bool $published
   *   TRUE to set this Server to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\isp_server\Entity\ServerInterface
   *   The called Server entity.
   */
  public function setPublished($published);

}
