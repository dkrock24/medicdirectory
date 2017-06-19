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

    public function enviarCorreo ($plantilla, array $variables, $para, $de = '') {
        $oPlantilla = $this->em->getRepository('AppBundle:PlantillaCorreo')->findOneBy(['nombre' => $plantilla]);

        if (!$oPlantilla) {
            return false;
        }

        $asunto = $oPlantilla->getAsunto();
        $cuerpo = $oPlantilla->getPlantilla();

        foreach ($variables as $variable => $valor) {
            $asunto = str_replace('{{'.$variable.'}}',$valor,$asunto);
            $cuerpo = str_replace('{{'.$variable.'}}',$valor,$cuerpo);
        }
		
		$https['ssl']['verify_peer'] = FALSE;
        $https['ssl']['verify_peer_name'] = FALSE;

        $this->transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls')
           ->setUsername("gialvarezlopez@gmail.com")
           ->setPassword("")
           ->setStreamOptions($https)
           ;
        // Create Mailer with our Transport.
        $this->mailer = \Swift_Mailer::newInstance($this->transport);

        $message = \Swift_Message ::newInstance()
            ->setContentType('text/html')
            ->setSubject($asunto)
            ->setFrom('elsalvadormedicos@gmail.com')
            ->setTo($para)
            ->setBody($cuerpo)
        ;

        return $this->mailer->send($message);
    }

}
