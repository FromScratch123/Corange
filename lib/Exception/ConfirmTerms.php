<?php 

namespace MyApp\Exception;

class ConfirmTerms extends \Exception {
  protected $message = 'Please agree to our terms.';
}