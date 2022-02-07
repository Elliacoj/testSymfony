<?php

/*use App\Kernel;*/

require_once dirname(__DIR__).'/vendor/autoload.php';

/*return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};*/

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

// the URI being requested (e.g. /about) minus any query parameters
$url = $request->getPathInfo();

switch ($url) {
    case '/':
        break;
    case '/list':
        echo (new \App\Controller\UserController())->list();
        break;
    case (bool)preg_match('/\/update\/[0-9]{1,10}/', $url):
        echo (new \App\Controller\UserController())->edit(str_replace('/update/', '', $url));
        break;

    case (bool)preg_match('/\/delete\/[0-9]{1,10}/', $url):
        echo (new \App\Controller\UserController())->delete(str_replace('/delete/', '', $url));
        break;
}
