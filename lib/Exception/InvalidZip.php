<?php 

namespace MyApp\Exception;

class InvalidZip extends \Exception {
  protected $message = "It's not a valid Zip code!";
}