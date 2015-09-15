<?php

try {
    session_start();
    require_once __DIR__ . '/../autoload.php';

    $app = new Woofem\Bootstrap();

    require_once __DIR__ . '/../routes.php';

    $app->run();
    var_dump($app->routes);
}
catch (Exception $e) {
    echo '<h1>Exception: ' . $e->getMessage() . '</h1>';
    echo '<pre>';
    print_r($e->getTrace());
    echo '</pre>';
    exit;
}