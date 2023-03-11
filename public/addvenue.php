<?php

require_once('../vendor/autoload.php');

use App\Controllers\AddVenueController;

$addvenue = new AddVenueController();
$addvenue->init();
$addvenue->process();