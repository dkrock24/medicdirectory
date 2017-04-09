<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Services;

/**
 * Description of servicioParametros
 *
 * @author vladimir
 */
use \AppBundle\Entity\Parametros;

class servicioParametros {
    /* @var $em \Doctrine\ORM\EntityManager */

    private $em;

    function __construct($em) {
        $this->em = $em;
    }

    public function setParametro($llave, $valor) {
        $this->em->getRepository(Parametros::class)->findOneBy(array('parLlave' => $llave));
    }

    public function getParametro($llave, $valor = '') {
        /* @var $parametro \AppBundle\Entity\Parametros */
        $parametro = $this->em->getRepository(Parametros::class)->findOneBy(array('parLlave' => $llave));

        if (null === $parametro) {
            return $valor;
        } else {
            return $parametro->getParValor();
            /* TODO: Registrar en el servicio de logs cuando se sirva un parametro que no exista */
        }
    }

}
