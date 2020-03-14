<?php 

namespace MyApp\Exception;

class NoSelected extends \Exception {
  protected $message = 'No file is selected!';
}