<?php

namespace Drupal\tc_webform\Controller;

use \Drupal\Core\Controller\ControllerBase;

/**
 * Class TCWebformConfirmation
 *
 * @package Drupal\tc_webform\Controller
 */
class TCWebformConfirmation extends ControllerBase {

  /**
   * @param $webform_submission_token
   *
   * @return array
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function render($webform_submission_token) {

    if (!empty($webform_submission_token)) {
      $webform = \Drupal::entityTypeManager()
        ->getStorage('webform_submission')
        ->loadByProperties(['token' => $webform_submission_token]);
      $content = $this->processedContent($webform);
      $ff = 0;
    }
    else {
      $content = 'WELL ODNE!';
    }

    return [
      '#theme' => $content['theme'],
      '#content' => $content,
    ];
  }


  private function processedContent($webform) {
    $webform = array_shift($webform);
    $webform_data = $webform->getData();
    $tithe_percentage = $webform_data['tithe_percentage'];
    $frequency = $webform_data['how_often_do_you_get_paid'];
    $income = $webform_data['how_much_do_you_get_paid'];

    $tithe_amount = $this->titheCalculations($tithe_percentage, $income);
    $year_tithe = $this->yearlyTithe($tithe_amount);
    $theme = $this->getTheme($frequency);

    return [
      'tithe_percentage' => $tithe_percentage,
      'frequency' => $frequency,
      'income' => $income,
      'monthly_tithe' => '',
      'yearly_tithe' => $year_tithe,
      'theme' => $theme,
    ];
  }

  /**
   * @param $frequency
   *
   * @return string
   */
  private function getTheme($frequency) {
    switch ($frequency) {
      case 'weekly':
        $theme = 'tc-webform-result-weekly';
        break;
      case 'monthly':
        $theme = 'tc-webform-result-monthly';
        break;
    }

    return $theme;
  }

  /**
   * @param $tithe_percentage
   * @param $income
   *
   * @return float|int
   */
  private function titheCalculations($tithe_percentage, $income) {
    if (!empty($tithe_percentage) && !empty($income)) {
      $value_one = $income / 100;

      $tithe_amount = $value_one * $tithe_percentage;
      return $tithe_amount;
    }
  }

  /**
   * @param $tithe_amount
   *
   * @return float|int
   */
  private function yearlyTithe($tithe_amount) {
    return $tithe_amount * 12;
  }
}
