<?php 

namespace MyApp\Exception;

class UnmatchemailOrPassword extends \Exception {
  protected $message = 'Email/Password do not match!';
}