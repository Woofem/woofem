<?php

$app->registerRoute('/', 'GET', function($app) {
    $data = new stdClass();
    $data->foo = 'bar';
    return $app->render('default', $data);
});

$app->registerRoute('/', 'POST', function() {
    return 'POST Index';
});

/**
 * Example structure of how I see route callbacks working.
 */
$app->registerRoute('matches', 'GET', function(){
    $pets = new petController();
    $allpets = $pets->getPets();
    return $response->render('templatefile', $allpets);
});