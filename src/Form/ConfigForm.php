<?php

namespace Drupal\hugs\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase {
  public function getFormId() {
    return 'hug_config';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hugs.settings');

    $form['default_count'] = [
      '#type' => 'number',
      '#title' => $this->t('Default hug count'),
      '#default_value' => $config->get('default_count'),
    ];

    $form['extra_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Extra message'),
      '#default_value' => $config->get('extra_message'),
      '#description' => $this->t('Optionally provide an additional message that will be shown when someone gets hugged.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $config = $this->config('hugs.settings');
    $config
      ->set('default_count', $form_state->getValue('default_count'))
      ->set('extra_message', $form_state->getValue('extra_message'))
      ->save();
  }

  public function getEditableConfigNames() {
    return ['hugs.settings'];
  }
}
