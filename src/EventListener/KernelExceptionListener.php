<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class KernelExceptionListener {
    public function onKernelException(ExceptionEvent $event) {

        $exception = $event->getRequest()->getRealMethod();

        if($exception !== "POST") {
            $message = sprintf(
                'Code d\'erreur: %s',
                "403"
            );

            $response = new Response();
            $response->setContent("
            <h1>Une erreur est survenue!</h1>
            <p>$message</p>
        ");

            $event->setResponse($response);
        }

    }
}