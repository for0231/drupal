<?php

namespace Drupal\isp_ip\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class IpTypeForm.
 */
class IpTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $isp_ip_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $isp_ip_type->label(),
      '#description' => $this->t("Label for the IP type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $isp_ip_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\isp_ip\Entity\IpType::load',
      ],
      '#disabled' => !$isp_ip_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $isp_ip_type = $this->entity;
    $status = $isp_ip_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label IP type.', [
          '%label' => $isp_ip_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label IP type.', [
          '%label' => $isp_ip_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($isp_ip_type->toUrl('collection'));
  }

}
