<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class KernelEventSubscriber implements EventSubscriberInterface {
    public static function getSubscribedEvents():array {
        return [
            KernelEvents::EXCEPTION => [
                ['displayKernelExceptionTriggered', 255],
                ['onKernelExceptionTriggered', 254],
                ['logKernelExceptionTriggered', 1]
            ]
        ];
    }

    public function displayKernelExceptionTriggered(ExceptionEvent $event) {
        $response = new Response();
        $response->setContent("
            <h1>Une erreur est survenue!</h1>
        ");

        $event->setResponse($response);
    }

    public function onKernelExceptionTriggered(ExceptionEvent $event) {

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

    public function logKernelExceptionTriggered(ExceptionEvent $event) {
        $message = $event->getThrowable()->getMessage();
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/var/log/test.log', $message, FILE_APPEND);
    }
}
