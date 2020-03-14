<?php 

namespace MyApp\Exception;

class UploadError extends \Exception {
  protected $message = 'Faild to upload the file';
}