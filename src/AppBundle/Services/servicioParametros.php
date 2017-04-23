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
    /** @var $em \Doctrine\ORM\EntityManager */
    private $em;
    
    /** @var $log_service \AppBundle\Services\servicioLogs */
    private $log_service;
    
    public $oUser;

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
                $this->log_service->logEvent(servicioLogs::_INSERT_ACTION_, "parametros", null,  $par_valor, null, "Added new parameter {$par_llave} : {$par_valor}");
                

            }catch( \Doctrine\ORM\OptimisticLockException $e ){
                throw new \Exception( "Could not set value to parameter {$par_llave} : " . $e->getMessage() );
            }
            
        }
    }
    
    /* TODO: Registrar en el servicio de logs cuando se sirva un parametro que no exista */
    
    public function getParametro($par_llave_lookup, $default_return_value = "") {
        //-- Find parameter by its key value
        
        /* @var $parametro \AppBundle\Entity\Parametros */
        $parametro = $this->em->getRepository(Parametros::class)
                ->findOneBy(array('parLlave' => $par_llave_lookup));
        
        if( $parametro === null ){
            // log event
            $this->log_service->logEvent(servicioLogs::_SELECT_ACTION_ , "parametros", "par_llave",  null, null, "Failed to fetch parameter by name '{$par_llave_lookup}'");
            
            return $default_return_value;
        }
        
        return $parametro->getParValor();
    }

    
    public function getParametroByValue( $par_valor_lookup, $default_return_value = "" ){
        //-- Find parameter by its key value
        
        /* @var $parametro \AppBundle\Entity\Parametros */
        $parametro = $this->em->getRepository(Parametros::class)
                ->findOneBy(array('parValor' => $par_valor_lookup));
        
        if( $parametro === null ){
            // log event
            $this->log_service->logEvent(servicioLogs::_SELECT_ACTION_ , "parametros", "par_valor",  null, null, "Failed to fetch parameter by value '{$par_valor_lookup}'");
            
            return $default_return_value;
        }
        
        return $parametro->getParValor();
    }

    
    public function setParametro( $par_llave_lookup, $par_valor ){
        
        try{
            //-- Find parameter by its key value
            
            /* @var $parametro \AppBundle\Entity\Parametros */
            $parametro = $this->em->getRepository(Parametros::class)
                    ->findOneBy(array('parLlave' => $par_llave_lookup));


            if (null === $parametro) {
                // log event
                $this->log_service->logEvent(servicioLogs::_SELECT_ACTION_ , "parametros", "",  $par_llave_lookup, null, "Failed to fetch parameter by key '{$par_llave_lookup}'");
                
            } else {
                //-- Set new value for parameter
                $parametro->setParValor( $par_valor );

                //-- Flush
                $this->em->flush();
            }
            
        }catch( \Doctrine\ORM\OptimisticLockException $e ){

                throw new \Exception( "Could not set value to parameter {$par_llave_lookup} : " . $e->getMessage() );

        }
        
    }
    
}
