<?php 

namespace MyApp\Exception;

class UnmatchConfirmation extends \Exception {
  protected $message = 'Please maek sure email again!';
}