<?php

declare(strict_types=1);

namespace Drupal\http_client_file_upload\Controller;

use Drupal;
use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for http client file upload routes.
 */
final class HttpClientFileUploadController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {
    // file on local
    $filePath = 'https://srdr10.ddev.site/sites/default/files/2024-06/images.jpeg';

    // upload file by php service
    $fileUploadBase64 = Drupal::service('http_client_file_upload.base64')->base64();
    //    $fileUpload = Drupal::service('http_client_file_upload.upload')
    //      ->upload('node', 'article', 'field_image', 'https://srdr10.ddev.site/sites/default/files/2024-06/1.jpg');
    //
    // file upload by http client manager service
    $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZjNWUwY2FiNDQ5NjhkMDQ1MWZmZTRiOGQ0MzhiYmRiYTE5ZmNiZGVjN2Y1NTBmMWViYTg2NDcxMjZkN2MwYmRiOGZlNTZmYzAxNTc4NGIwIn0.eyJhdWQiOiJiWFVZSWh2NU9FUktKM0paeDJIcjl6eC0yam9kTkk3bF90VlB3TjhyeXpzIiwianRpIjoiNmM1ZTBjYWI0NDk2OGQwNDUxZmZlNGI4ZDQzOGJiZGJhMTlmY2JkZWM3ZjU1MGYxZWJhODY0NzEyNmQ3YzBiZGI4ZmU1NmZjMDE1Nzg0YjAiLCJpYXQiOjE3MTc4NDcyMjAsIm5iZiI6MTcxNzg0NzIyMCwiZXhwIjoxNzE3OTMzMjIwLjE1NDA4MSwic3ViIjoiMSIsInNjb3BlIjpbImF1dGhlbnRpY2F0ZWQiLCJjb250ZW50X2VkaXRvciJdfQ.w1yd2Hg8en28JLfMRMvBr-j8Q2MN3GZ75tEW3tNYpc1V5kJmHiK7SGWXvT8Jhd8EC2TZVar5HyvzaNHMwDrVttKrq8O02AJsSYN7uTrjnyFKmc2mzysG0gIZY6qd3xJZY9SSFHBKi9YErzI876lApVp6lP7M0mZ-SG8cFOebd-rFa6EdTjbnjuKBcrscyRHnW6df94i9jkUVBWpYb4jlJP6QdrMlVo9rjkOslUgNeCBr1oYLl2D6VGPDLiiX4071x-S9dzmGiOp53OL7uOeCo9qAtuxsoOefsyS3Or8u-ibx1VcuROUUt0A3ZcNP60GJxC_W4gItRw45SGhfHxgN3QyqWM-cFgUxrdv0giOmSChwAy-AjdgJtJoXfJ54D-DpszYKXhqJgNWNXbpQH9oL13IYe2EXLZX8SSnZRcfv2pkkQP6YS-0P8Ankx8oszoAmLpeo17l0LkLLD63_lkuY1-OwQorERH9ugibcuPEl5UsJLWXXuFf8ijkBfvK6koWJ-NZgq_fMwZl2b086QwNdC0Oc4RLA6OtdzyM0JoItj3vFmcNEYr4Yoxia8bJiP_2z1cmRG3aM8FcgvBefk_s1nH6l_hgVgSVejuBzD5baiiuQ-U5_nYf8hzu47p1Tzxb9WnC7UCm3SMBgEl5LDSi_R931EUL8qlWsZ8OXrJyVt6A';
    $fileUpload = Drupal::service('http_client_manager.factory')
      ->get('api_file_upload_service');
    $fileUpload->call(
      'upload', [
        'content-type' => 'application/octet-stream',
        'Authorization' => $token,
        'Content-Disposition' => 'file; filename="001.png"',
        'file' => $filePath,
      ]
    );

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
