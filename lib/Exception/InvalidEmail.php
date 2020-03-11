<?php 

namespace MyApp\Exception;

class InvalidEmail extends \Exception {
  protected $message = "It's not a vavlid Email form!";
}