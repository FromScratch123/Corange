<?php 

namespace MyApp\Exception;

class FaildIssuePass extends \Exception {
  protected $message = 'Faild to issue password!';
}