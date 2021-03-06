<?php

use App\Kernel;
use App\Controller\UserController;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};



/*$request = Request::createFromGlobals();

// the URI being requested (e.g. /about) minus any query parameters
$url = $request->getPathInfo();

switch ($url) {
    case '/':
        break;
    case '/list':
        echo (new UserController())->list();
        break;
    case (bool)preg_match('/\/update\/[0-9]{1,10}/', $url):
        echo (new UserController())->edit(str_replace('/update/', '', $url));
        break;

    case (bool)preg_match('/\/delete\/[0-9]{1,10}/', $url):
        echo (new UserController())->delete(str_replace('/delete/', '', $url));
        break;
}*/
