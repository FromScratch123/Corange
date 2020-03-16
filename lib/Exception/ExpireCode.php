<?php 

namespace MyApp\Exception;

class ExpireCode extends \Exception {
  protected $message = 'The code is already expired!';
}