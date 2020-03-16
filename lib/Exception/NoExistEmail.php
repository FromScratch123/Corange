<?php 

namespace MyApp\Exception;

class NoExistEmail extends \Exception {
  protected $message = 'The email dose not connect to our systems';
}