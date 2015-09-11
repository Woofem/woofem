<?php

foreach (glob(__DIR__ . '/controllers/*.php') as $filename) {
    include_once($filename);
}
foreach (glob(__DIR__ . '/classes/*.php') as $filename) {
    include_once($filename);
}