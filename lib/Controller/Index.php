<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      header('Location:' . SITE_URL . '/public_html/login.php');
      exit;
    }
  }
}