<?php

$directories = array(
    'controllers',
    'classes'
);

foreach ($directories as $directory) {
    foreach (glob(__DIR__ . '/' . $directory . '/*.php') as $filename) {
        include_once($filename);
    }
}