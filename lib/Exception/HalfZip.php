<?php 

namespace MyApp\Exception;

class HalfZip extends \Exception {
  protected $message = 'Please enter in half-whith characters!';
}