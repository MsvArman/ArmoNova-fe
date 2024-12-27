<?php

use Panel\Middlewares\RedirectToHomeIfAuthorized;
use Panel\Middlewares\RedirectToLoginIfUnauthorized;
use Pecee\SimpleRouter\SimpleRouter;
use Route\AuthRoutes;

use Route\ErrorRoutes;



SimpleRouter::group([
//    'middleware' => [RedirectToHomeIfAuthorized::class]
], function () {
    AuthRoutes::init();
});

SimpleRouter::group([
    'middleware' => [RedirectToLoginIfUnauthorized::class]
], function () {
SimpleRouter::get('/', function () {
    view('dashboard', 'Dashboard', '', '<script src="assets/js/dashboard.js"></script>');
});
    // ServicesRoutes::init();
    // WebsitesRoutes::init();
    // CheckOutRoutes::init();
    // PackageRoutes::init();
    // TransactionStatusRoutes::init();
    // ApiDocsRoutes::init();
});

ErrorRoutes::init();
