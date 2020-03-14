<?php 

namespace MyApp\Exception;

class NoSelected extends \Exception {
  protected $message = 'Please select a file!';
}