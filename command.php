<?php
require 'vendor/autoload.php';

//check if running in CLI mode
if (! isset($argv)) {
    echo 'This can only be run in CLI.';
    return;
}

//bootstrap
$controller = new YasirMansoor\Controllers\MainController($argv);