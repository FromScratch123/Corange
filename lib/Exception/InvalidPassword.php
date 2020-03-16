<?php 

namespace MyApp\Exception;

class InvalidPassword extends \Exception {
  protected $message = "It's not a vavlid password form!";
}