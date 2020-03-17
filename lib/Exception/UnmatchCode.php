'<?php 

namespace MyApp\Exception;

class UnmatchCode extends \Exception {
  protected $message = 'The code is wrong';
}