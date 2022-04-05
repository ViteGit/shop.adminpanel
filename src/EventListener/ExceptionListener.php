<?php

namespace App\EventListener;

use App\Service\MailSender;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Twig\Environment;

class ExceptionListener
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var MailSender
     */
    private $mailSender;

    /**
     * @var string
     */
    private $adminEmail;

    /**
     * @param Environment $twig
     * @param MailSender  $mailSender
     * @param string      $adminEmail
     */
    public function __construct(Environment $twig, MailSender $mailSender, string $adminEmail)
    {
        $this->twig = $twig;
        $this->mailSender = $mailSender;
        $this->adminEmail = $adminEmail;
    }
//
//    /**
//     * @param GetResponseForExceptionEvent $event
//     *
//     * @return void
//     *
//     * @throws Swift_IoException
//     */
    public function onKernelException(ExceptionEvent $event): void
    {
//        $exception = $event->getException();
//
//        $body = "page {$event->getRequest()->getUri()}\n";
//        $body .= "{$exception->getMessage()}\n";
//
////        $this->mailSender->sendEmail(
////            "Error: {$exception->getCode()}",
////            $body,
////            [$this->adminEmail]
////        );
    }
}
