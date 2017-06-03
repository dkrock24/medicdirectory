<?php

namespace Services;

use Symfony\Component\HttpFoundation\Request;

class Correos {
    /* @var $em \Doctrine\ORM\EntityManager */

    private $em;
    private $session;
    private $mailer;

    public function __construct($em, $session, $mailer) {
        $this->em = $em;
        $this->session = $session;
        $this->mailer = $mailer;
    }

    public function enviarCorreo(Request $request, $plantilla, array $variables, $para, $de = '') {
        $message = \Swift_Message ::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('elsalvadormedicos@gmail.com')
            ->setTo($request->request->get('destino'))
            ->setBody('You should see me from the profiler!')
        ;

        $this->mailer->send($message);
    }

}
