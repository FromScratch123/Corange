<?php 

namespace MyApp\Exception;

class HalfPassword extends \Exception {
  protected $message = 'Please enter in half-whith characters!';
}