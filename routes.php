<?php

$app->registerRoute('/', 'GET', function() use ($app) {
    echo 'GET Index';
});

$app->registerRoute('/', 'POST', function() use ($app) {
    echo 'POST Index';
});