<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EavModulosController extends Controller
{
    public function crearMenuModulosAction( $modulos = array() ){
        
        if( empty( $modulos ) ){
            $modulos = $this->get('srv_catalogs')->getModulos();
        }
        
        
        return $this->render('EmrBundle:Default:menuModulos.html.twig', 
                    array( 'modulos' => $modulos )
                );
    }
    
    public function crearFormModuloAction( $mod_id )
    {
        $mod_props = $this->get('srv_eav')->getPropModulo($mod_id);
        
        $mod_form = $this->get('srv_eav')->buildModuleForm( $mod_props );
        
        return $this->render('EmrBundle:Default:vistaModulo.html.twig', 
                    array( 'form_modulo' => $mod_form )
                );

    }
    
}
