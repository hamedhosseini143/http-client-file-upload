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
    $filePath = 'https://srdr10.ddev.site/sites/default/files/test01.jpeg';
    $fileBase64 = Drupal::service('convert_base64.convert')
      ->convertFileToBase64($filePath);
    $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ0NDBhMTNmMWQxOWVlNDM4ZTgzOTQzZTc1ZmY3ZDgyYTg0ZDc5MTQ3YzI3MDNmYzNiODZhMTZmZWE0ZDMzYzE3MzI1OGMzNmIwNTUyZGQxIn0.eyJhdWQiOiJiWFVZSWh2NU9FUktKM0paeDJIcjl6eC0yam9kTkk3bF90VlB3TjhyeXpzIiwianRpIjoiZDQ0MGExM2YxZDE5ZWU0MzhlODM5NDNlNzVmZjdkODJhODRkNzkxNDdjMjcwM2ZjM2I4NmExNmZlYTRkMzNjMTczMjU4YzM2YjA1NTJkZDEiLCJpYXQiOjE3MTc5MzMyOTcsIm5iZiI6MTcxNzkzMzI5NywiZXhwIjoxNzE4MDE5Mjk3LjEyODIxNiwic3ViIjoiMSIsInNjb3BlIjpbImF1dGhlbnRpY2F0ZWQiLCJjb250ZW50X2VkaXRvciJdfQ.eT22U54FnsUUCl3rdtjwJOKnOPWyrcmASVPjDqxln_k1hMpPQqF-AHubzH9EQxNZRp1w9w1EYojcjKiUIoqKEOxj2Wyd7XsY63ForBjJa92qWa9PPw48gNFPz8KwviHO0gSeuhHIfmDaOcJq15Yu204jyZth9Jd8XJuDn9LIA3-Urw5BGK56_tIYrA5pKiFgyRP5PTDPP-07Ff9UDfM1dI7TzRkTAek-4Tjpd1fivY7erOU3UnR2LRiM9qCpZR8V-egOnU1B_kroWTVUnu2tiTbu5UI0QMNhfwI_7mZ6Pb5KzPahvZBRPJOBCeibIx0gqT-KIHIHiWkcVjTihinYO-s3Kzv73AtcDOm0CnkMEgDpA3ZZU9OVeapCYQwsLuSiDYWXPmsUVSeKEj17EJ6uwUsJeMxFMobkrftdOX5eTjMGtZciIOm12EYXJKq5LyCd-2ruxgZ1Qz7a20tW-4zt1H_ZP-H2qRNB15ZhQm4zXZir6mRYpdpx3nojPaK0rAhb07uRBe_aeqXd86AdZ_UnVn0rcB-IXxN77t-HsMwRTC8EwN9HGiqkZhDV-lD6Fth7QBZkjFMpwV4EofozrhtsPJkEuNh_0y-dLwqy2MrpGzwmpaid8NQBJU97oiyFsX2Kw9rrfZsEYTlMrsi4Zo5PD1b0bkJCJjv9JGo0HjPEgvs";
    $fileUpload = Drupal::service('http_client_manager.factory')
      ->get('api_file_upload_service');
    $fileUpload->call(
      'upload', [
        "Authorization" => $token,
        'fileName' => 'hamedTest.jpeg',
        'file' => $fileBase64,
      ]
    );

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
