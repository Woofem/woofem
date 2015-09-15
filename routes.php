<?php

$app->registerRoute('/', 'GET', function() {
    return 'GET Index';
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