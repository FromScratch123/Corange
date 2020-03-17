<?php 

namespace MyApp\Exception;

class UnmatchPassword extends \Exception {
  protected $message = 'Password do not match!';
}