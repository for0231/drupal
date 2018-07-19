<?php

namespace Drupal\isp_ip\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the IP type entity.
 *
 * @ConfigEntityType(
 *   id = "isp_ip_type",
 *   label = @Translation("IP type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\isp_ip\IpTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\isp_ip\Form\IpTypeForm",
 *       "edit" = "Drupal\isp_ip\Form\IpTypeForm",
 *       "delete" = "Drupal\isp_ip\Form\IpTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\isp_ip\IpTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "type",
 *   admin_permission = "administer ip entities",
 *   bundle_of = "isp_ip",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/isp/ip/type/{isp_ip_type}",
 *     "add-form" = "/admin/isp/ip/type/add",
 *     "edit-form" = "/admin/isp/ip/type/{isp_ip_type}/edit",
 *     "delete-form" = "/admin/isp/ip/type/{isp_ip_type}/delete",
 *     "collection" = "/admin/isp/ip/type"
 *   }
 * )
 */
class IpType extends ConfigEntityBundleBase implements IpTypeInterface {

  /**
   * The IP type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The IP type label.
   *
   * @var string
   */
  protected $label;

}
