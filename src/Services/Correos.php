<?php

namespace Services;

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

    public function enviarCorreo($plantilla, array $variables, $para, $de = '') {
        return false;
    }

}
