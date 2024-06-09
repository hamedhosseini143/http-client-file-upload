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
  public function upload(string $entityTypeId, string $bundle, string $fieldName, string $filePath): array {
    $baseUrl = 'https://srdr10.ddev.site';
    $url = "{$baseUrl}/file/upload/{$entityTypeId}/{$bundle}/{$fieldName}";
    $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQyMmRkOGVmMWFmNzRlY2JjNDI2ZmQ5NmQ5YzBiYjMzNjlkNjY2ZmVkNjQ0ZWYwYTQ2OWM0NTRhOGI3M2U5NGUwN2NhMGI4NWRjNGRiNTM2In0.eyJhdWQiOiJiWFVZSWh2NU9FUktKM0paeDJIcjl6eC0yam9kTkk3bF90VlB3TjhyeXpzIiwianRpIjoiNDIyZGQ4ZWYxYWY3NGVjYmM0MjZmZDk2ZDljMGJiMzM2OWQ2NjZmZWQ2NDRlZjBhNDY5YzQ1NGE4YjczZTk0ZTA3Y2EwYjg1ZGM0ZGI1MzYiLCJpYXQiOjE3MTc0ODk1ODgsIm5iZiI6MTcxNzQ4OTU4OCwiZXhwIjoxNzE3NDg5ODg4LjMyMzE2Mywic3ViIjoiMSIsInNjb3BlIjpbImF1dGhlbnRpY2F0ZWQiLCJjb250ZW50X2VkaXRvciJdfQ.cmrvfkl6lcnDRgA1lIqmnPN3YdyQvLagjvAii6RInaEoDR5Sr0FV3RGBbWzS6yf449gn8o2lLeSNSNUshxAuigfh33Q4WO0gwVowrQmw4mCWi11rUZo8TmA9wBl6_8xU-a_TNDChnVOb7j6msfBLw-5VSuK_AaX6g1OUIOks1MjSw406VQGeguRoCbrAassrJZC_xF4nVPxtJ8jRG7HvQf0gZ3jquzTR8lsq1YQsPqhac12NXPiA6FazANfx8rwkDkxL_6GchU0Q1z3BhdxgIG8xNBaX6hd-O7k4_sRZhcQUOVl5N5WTmodgqYfhoqCK8YU3EhvCu3HWEZCnaaOCbY5014kOOnll72njPooCKhx_WrBY92d89JCEDCTeNCVpOoj29WbcByX4I9PgErIMLsJEwBATF9RFqSjVAE1Tc1sY8gKpgSyh2yILvwjz4spj-QFxaKWXJVRGQ01yfL1ibyfNgEjo4iRivsBm4QyAUfuA2V2YTEIvR8PbfJJCOTHpstGckI4hGVFF6ijJMSzQvFCIcE9Dsb_WAVngXJhjHsWa9zgB5FP17ONEvPpdralIYXM-Vk9cgBgq8apKjXMLJjpVssmJwIlfcI51wver-F3i8pay81GiZBBpOXYiYMxwEOHBI9X57ScLHpHDdnGIZAW3bs_23PAH2va8c2Z_iTQ';
    $fileStream = Utils::tryFopen($filePath, 'r');
    $stream = Utils::streamFor($fileStream);
    try {
      $response = $this->httpClient->request('POST', $url, [
        'headers' => [
          'Content-Type' => 'application/octet-stream',
          'Content-Disposition' => 'file; filename="1.jpg"',
          'Authorization' => 'Bearer ' . $token,
        ],
        'body' => $stream,
      ]);
      return json_decode($response->getBody()->getContents(), TRUE);
    }
    catch (GuzzleException $e) {
      Drupal::logger('http_client_file_upload')->error($e->getMessage());
      return [];
    }
  }

}
