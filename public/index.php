<?php

require_once '../vendor/autoload.php';

if (!empty($_GET['r'])) {
    require_once 'routes.php';
} else {
    require_once 'template.php';
}

function router(string $route, string $pattern, callable $callable)
{
    if (preg_match($pattern, $route)) {
        $callable();
    }
}

function response(array $response)
{
    exit(json_encode($response));
}
