<?php 

namespace MyApp\Exception;

class OverLength extends \Exception {
  protected $message = "Please enter within the limit characters";
}