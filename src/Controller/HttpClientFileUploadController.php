<?php

declare(strict_types=1);

namespace Drupal\http_client_file_upload\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for http client file upload routes.
 */
final class HttpClientFileUploadController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $fileUpload = \Drupal::service('http_client_file_upload.upload')->upload('node', 'article', 'field_image', 'https://srdr10.ddev.site/sites/default/files/2024-06/1.jpg');
    dump($fileUpload);

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
