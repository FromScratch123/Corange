<?php 

namespace MyApp\Exception;

class InvalidAge extends \Exception {
  protected $message = 'It should be less than 3 characters.';
}