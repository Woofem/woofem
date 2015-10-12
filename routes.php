<?php

/**
 * Matches "/" on GET method
 */
$app->registerRoute('/', 'GET', function($app) {
    $data = new stdClass();
    $data->foo = 'bar';
    $app->render('default', $data);
});

/**
 * Matches "/" on POST method
 */
$app->registerRoute('/', 'POST', function() {
    return 'POST Index';
});

/**
 * Matches "/pets/*" on GET method
 */
$app->registerRoute('pet/*', 'GET', function($app){
    $petController = new \Woofem\PetController($app);
    $arg = $app->getUrlPart(1);
    $pet = $petController->getPet($arg);
    $app->render('default', $pet);
});

/**
 * Example structure of how I see route callbacks working.
 */
$app->registerRoute('matches', 'GET', function(){
    $pets = new petController();
    $allpets = $pets->getPets();
    return $response->render('templatefile', $allpets);
});