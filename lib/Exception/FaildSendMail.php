<?php 

namespace MyApp\Exception;

class FaildSendMail extends \Exception {
  protected $message = 'Faild to send a email...';
}