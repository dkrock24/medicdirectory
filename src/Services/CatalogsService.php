<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Services;

/**
 * Description of CatalogsService
 *
 * @author slacker
 */
class CatalogsService {
    
    /* @var $em \Doctrine\ORM\EntityManager */
    private $em;
    
    function __construct( $em ){
        $this->em = $em;
    }
    
    public function getEspecialidades()
    {
        $esp = $this->em->getRepository('AppBundle:Especialidad')
                ->findBy(array( 'espActivo' => 1 ))
                ;
        
        $result = array("Seleccionar Especialidad");
        
        foreach( $esp as $esp_ ){
            $result[] = $esp_->getEspEspecialidad();
        }

        return $result;
        
    }
    
    
}
