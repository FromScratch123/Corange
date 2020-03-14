<?php 

namespace MyApp\Exception;

class IncompatibleType extends \Exception {
  protected $message = 'The type of the file is not acceptable!';
}