<?php 

namespace MyApp\Exception;

class ConfirmTerms extends \Exception {
  protected $message = 'Duplicate Email!';
}