<?php

require_once(__DIR__ . '/../config/config.php');
trackingStart();

$app = new MyApp\Controller\AskBeFriend
();
$app->run();


?>
