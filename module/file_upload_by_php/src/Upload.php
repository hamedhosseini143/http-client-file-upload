<?php

declare(strict_types=1);

namespace Drupal\file_upload_by_php;

use Drupal;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;

/**
 * @todo Add class description.
 */
final class Upload {

  /**
   * @var \GuzzleHttp\Client
   */
  private Client $httpClient;

  /**
   * @param \GuzzleHttp\Client $httpClient
   */
  public function __construct(Client $httpClient) {
    $this->httpClient = $httpClient;
  }

  /**
   * @param string $entityTypeId
   * @param string $bundle
   * @param string $fieldName
   * @param string $filePath
   *
   * @return array
   */
  public function upload(string $filePath, string $fileName): array {
    $url = "https://srdr10.ddev.site/api/rest-file-upload";
    $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ0NDBhMTNmMWQxOWVlNDM4ZTgzOTQzZTc1ZmY3ZDgyYTg0ZDc5MTQ3YzI3MDNmYzNiODZhMTZmZWE0ZDMzYzE3MzI1OGMzNmIwNTUyZGQxIn0.eyJhdWQiOiJiWFVZSWh2NU9FUktKM0paeDJIcjl6eC0yam9kTkk3bF90VlB3TjhyeXpzIiwianRpIjoiZDQ0MGExM2YxZDE5ZWU0MzhlODM5NDNlNzVmZjdkODJhODRkNzkxNDdjMjcwM2ZjM2I4NmExNmZlYTRkMzNjMTczMjU4YzM2YjA1NTJkZDEiLCJpYXQiOjE3MTc5MzMyOTcsIm5iZiI6MTcxNzkzMzI5NywiZXhwIjoxNzE4MDE5Mjk3LjEyODIxNiwic3ViIjoiMSIsInNjb3BlIjpbImF1dGhlbnRpY2F0ZWQiLCJjb250ZW50X2VkaXRvciJdfQ.eT22U54FnsUUCl3rdtjwJOKnOPWyrcmASVPjDqxln_k1hMpPQqF-AHubzH9EQxNZRp1w9w1EYojcjKiUIoqKEOxj2Wyd7XsY63ForBjJa92qWa9PPw48gNFPz8KwviHO0gSeuhHIfmDaOcJq15Yu204jyZth9Jd8XJuDn9LIA3-Urw5BGK56_tIYrA5pKiFgyRP5PTDPP-07Ff9UDfM1dI7TzRkTAek-4Tjpd1fivY7erOU3UnR2LRiM9qCpZR8V-egOnU1B_kroWTVUnu2tiTbu5UI0QMNhfwI_7mZ6Pb5KzPahvZBRPJOBCeibIx0gqT-KIHIHiWkcVjTihinYO-s3Kzv73AtcDOm0CnkMEgDpA3ZZU9OVeapCYQwsLuSiDYWXPmsUVSeKEj17EJ6uwUsJeMxFMobkrftdOX5eTjMGtZciIOm12EYXJKq5LyCd-2ruxgZ1Qz7a20tW-4zt1H_ZP-H2qRNB15ZhQm4zXZir6mRYpdpx3nojPaK0rAhb07uRBe_aeqXd86AdZ_UnVn0rcB-IXxN77t-HsMwRTC8EwN9HGiqkZhDV-lD6Fth7QBZkjFMpwV4EofozrhtsPJkEuNh_0y-dLwqy2MrpGzwmpaid8NQBJU97oiyFsX2Kw9rrfZsEYTlMrsi4Zo5PD1b0bkJCJjv9JGo0HjPEgvs";
    $fileBase64 = Drupal::service('convert_base64.convert')
      ->convertFileToBase64($filePath);
    try {
      $response = $this->httpClient->request('POST', $url, [
        'headers' => [
          'Authorization' => 'Bearer ' . $token,
        ],
        'body' => [
          'file' => $fileBase64,
          'filename' => $fileName,
        ],
      ]);
      return json_decode($response->getBody()->getContents(), TRUE);
    }
    catch (GuzzleException $e) {
      Drupal::logger('http_client_file_upload')->error($e->getMessage());
      return [];
    }
  }

}
