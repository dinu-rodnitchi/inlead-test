<?php

namespace Drupal\inlead\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Sows a React component as a block.
 *
 * This can be improved by adding validation, chaching and other stuff.
 * For now, it's just a simple example. Let me know if we want to improve it.
 *
 * @Block(
 *   id = "react_link_block",
 *   admin_label = @Translation("React Link Block"),
 * )
 */
class ReactLinkBlock extends BlockBase {

  /**
   * The default link.
   */
  const DEFAULT_LINK = 'https://www.drupal.org';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'react_link' => self::DEFAULT_LINK,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['react_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your link please?'),
      '#description' => $this->t('The link that will be displayed in the React component.'),
      '#default_value' => $this->configuration['react_link'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->configuration['react_link'] = $values['react_link'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    // Get the link from the block configuration.
    $link = $this->configuration['react_link'];

    // Pass the link to the library.
    $settings = [
      'react_link' => $link,
    ];

    // Attach the library and pass the settings.
    $build = [
      '#markup' => '<div id="react-app"></div>',
      '#attached' => [
        'library' => [
          'inlead/react_link',
        ],
        'drupalSettings' => $settings,
      ],
    ];

    return $build;
  }

}
