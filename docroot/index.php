<?php

require_once __DIR__ . '/../autoload.php';

$app = new Woofem\Bootstrap();

require_once __DIR__ . '/../routes.php';

$app->run();
var_dump($app);