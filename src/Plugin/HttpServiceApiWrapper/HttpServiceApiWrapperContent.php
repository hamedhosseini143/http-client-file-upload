<?php

use Drupal\http_client_file_upload\api\Commands\ApiCommands;
use Drupal\http_client_manager\Plugin\HttpServiceApiWrapper\HttpServiceApiWrapperBase;

class HttpServiceApiWrapperContent extends HttpServiceApiWrapperBase {

  /**
   *
   */
  public function getHttpClient() {
    return $this->httpClientFactory->get('api_file_upload_service');
  }

  public function fileUpload(string $file, string $fileName, $authorization): array {
    $data = [
      'Authorization'=>$authorization,
      'fileName' => $fileName,
      'file' => $file,
    ];

    return $this->call(ApiCommands::FILE_UPLOAD->value, $data)->toArray();
  }

}
