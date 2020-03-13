<?php 

namespace MyApp\Exception;

class HalfAddress extends \Exception {
  protected $message = 'Please enter in half-whith characters!';
}