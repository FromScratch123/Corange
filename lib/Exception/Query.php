<?php 

namespace MyApp\Exception;

class Query extends \Exception {
  protected $message = 'We are having trouble with connecting database. Please try it later.';
}