<?php 

namespace MyApp\Exception;

class InvalidCharacters extends \Exception {
  protected $message = 'Please enter in half-whith characters!';
}