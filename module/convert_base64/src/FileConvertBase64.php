<?php

declare(strict_types=1);

namespace Drupal\convert_base64;

use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\file\FileInterface;

/**
 * @todo Add class description.
 */
final class FileConvertBase64 {

  protected $fileSystem;
  protected $entityTypeManager;

  public function __construct(FileSystemInterface $file_system, EntityTypeManagerInterface $entity_type_manager) {
    $this->fileSystem = $file_system;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * Converts a file to a base64 string.
   *
   * @param string $file_path
   *   The path to the file.
   *
   * @return string
   *   The base64 encoded string.
   */
  public function convertFileToBase64(string $file_path): string {
    $file_contents = file_get_contents($file_path);
    return base64_encode($file_contents);
  }

  /**
   * Saves a file from a base64 string.
   *
   * @param string $base64_string
   *   The base64 encoded string.
   * @param string $destination
   *   The destination path.
   *
   *   The saved file entity or FALSE on failure.
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function saveBase64File(string $base64_string, string $destination) {
    $file_data = base64_decode($base64_string);
    $file_uri = $this->fileSystem->saveData($file_data, $destination, FileSystemInterface::EXISTS_RENAME);

    if ($file_uri) {
      $file = $this->entityTypeManager->getStorage('file')->create([
        'uri' => $file_uri,
        'status' => 1,
      ]);
      $file->save();
      return $file;
    }

    return FALSE;
  }

}
