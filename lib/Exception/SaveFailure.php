<?php 

namespace MyApp\Exception;

class SaveFailure extends \Exception {
  protected $message = 'Faild to save the file...';
}