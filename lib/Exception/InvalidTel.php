<?php 

namespace MyApp\Exception;

class InvalidTel extends \Exception {
  protected $message = "It's not a valid telephone number form!";
}