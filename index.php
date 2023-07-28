<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use CatPHP\Application;
use CatPHP\Http\Request;
use CatPHP\Http\Response;
use CatPHP\View\ViewFacade;
use CatPHP\Routing\RouteFacade;

require './routes/web.php';

$dotenv = Dotenv::createImmutable(base_path());
$dotenv->load();

RouteFacade::run(
    new Application(
        Request::createFromGlobals(),
        new Response(),
        ViewFacade::create(base_path('views')),
    )
);