<?php

$app->registerRoute('/', 'GET', function($app) {
    $data = new stdClass();
    $data->foo = 'bar';
    $app->render('default', $data);
});

$app->registerRoute('/', 'POST', function() {
    return 'POST Index';
});

$app->registerRoute('pet', 'GET', function($app){
    $pet = new \Woofem\PetController($app);
    $data = $pet->getPet('1');
    $app->render('default', $data);
});

/**
 * Example structure of how I see route callbacks working.
 */
$app->registerRoute('matches', 'GET', function(){
    $pets = new petController();
    $allpets = $pets->getPets();
    return $response->render('templatefile', $allpets);
});