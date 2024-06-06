<?php

declare(strict_types=1);

namespace Drupal\http_client_file_upload;

/**
 * @todo Add class description.
 */
final class FileUploadBase64 {

  public function base64(): string {
    $file_path = '/var/www/html/mortezashop.zip';
    if (file_exists($file_path)) {
      $file_content = file_get_contents($file_path);
      return base64_encode($file_content);
    }
    else {
      return '';
    }
  }

}
