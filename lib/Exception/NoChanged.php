<?php 

namespace MyApp\Exception;

class NoChanged extends \Exception {
  protected $message = "It's the same password as current password";
}