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
    
    /* @var $log_service \AppBundle\Services\servicioLogs */
    private $log_service;

    function __construct($em, $log_service) {
        $this->em = $em;
        $this->log_service = $log_service;
    }

    public function addParametro( $par_llave, $par_valor ){
        if( is_null( $par_llave ) ){
            
            throw new \InvalidArgumentException( "Parameter key cannot be null" );
            
        }else if(is_null( $par_valor ) ){
            
            throw new \InvalidArgumentException( "Parameter value cannot be null" );
            
        }else{
            
            try{
                // Build new parametro object
                $parametro = new Parametros();

                // set values
                $parametro->setParLlave( $par_llave );
                $parametro->setParValor( $par_valor );

                // persist and flush
                $this->em->persist( $parametro );
                $this->em->flush();
                
                // log event
                //$this->log_service->logEvent(servicioLogs::_INSERT_ACTION_, "parametros", "", $log_user, $log_new_value)
                

            }catch( \Doctrine\ORM\OptimisticLockException $e ){
                throw new \Exception( "Could not set value to parameter {$par_llave_lookup} : " . $e->getMessage() );
            }
            
        }
    }
    
    public function getParametro($par_llave_lookup) {
        //-- Find parameter by its key value
        
        /* @var $parametro \AppBundle\Entity\Parametros */
        $parametro = $this->em->getRepository(Parametros::class)
                ->findOneBy(array('parLlave' => $par_llave_lookup));
        
        return $parametro;
    }
    
    public function getParametroByValue( $par_valor_lookup ){
        //-- Find parameter by its key value
        
        /* @var $parametro \AppBundle\Entity\Parametros */
        $parametro = $this->em->getRepository(Parametros::class)
                ->findOneBy(array('parValor' => $par_valor_lookup));
        
        return $parametro;
    }
    
    public function setParametro( $par_llave_lookup, $par_valor ){
        try{
            //-- Find parameter by its key value
            
            /* @var $parametro \AppBundle\Entity\Parametros */
            $parametro = $this->em->getRepository(Parametros::class)
                    ->findOneBy(array('parLlave' => $par_llave_lookup));

            //-- Set new value for parameter
            $parametro->setParValor( $par_valor );

            //-- Flush
            $this->em->flush();
        }catch( \Doctrine\ORM\OptimisticLockException $e ){
            
            throw new \Exception( "Could not set value to parameter {$par_llave_lookup} : " . $e->getMessage() );
            
        }
    }
    
}
