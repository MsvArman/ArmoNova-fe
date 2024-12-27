<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// load composer dependencies
require 'vendor/autoload.php';
// Load our helpers
require_once 'app/helpers.php';
// Load our custom routes
require_once 'routes/web.php';
// Load error handler
require_once 'error_handler.php';

use Pecee\SimpleRouter\SimpleRouter;
SimpleRouter::enableMultiRouteRendering(false);
SimpleRouter::setDefaultNamespace('\Panel\Controllers');

// Start the routing
echo SimpleRouter::start();