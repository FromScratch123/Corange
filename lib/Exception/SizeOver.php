<?php 

namespace MyApp\Exception;

class SizeOver extends \Exception {
  protected $message = 'The file size  of one tried to upload is too large!';
}