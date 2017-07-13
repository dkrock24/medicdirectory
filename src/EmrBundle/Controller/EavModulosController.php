<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Response as Response;
use \AppBundle\Entity\EavModDatos;

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
    
    public function crearFormModuloAction( $mod_hash, $usu_id, $pac_id, $cli_id, $cit_id )
    {
        
        $mod_props = $this->get('srv_eav')->getPropModulo($mod_hash);
        
        $mod_form = $this->get('srv_eav')->buildModuleForm( $mod_hash, $usu_id, $pac_id, $cli_id, $cit_id, $mod_props );
        
        return $this->render('EmrBundle:Default:vistaModulo.html.twig', 
                    array( 'form_modulo' => $mod_form )
                );

    }
    
    public function guardarValorFormAction( 
            $val_usu_id, 
            $val_pac_id, 
            $val_cli_id, 
            $val_cit_id, 
            $val_camp_id, 
            $value ){
        
        try{
        
        $em = $this->getDoctrine()->getManager();
        
        $iValId = $em->getRepository('AppBundle:EavModDatos')->findOneBy(
                    array(
                        'modDatUsuId' => $val_usu_id,
                        'modDatPacId' => $val_pac_id,
                        'modDatCliId' => $val_cli_id,
                        'modDatCitId' => $val_cit_id,
                        'modDatModCampId' => $val_camp_id
                    )
                );
        
        if( $value == "value_holder" ){
            $final_value = null;
        }else{
            $final_value = $value;
        }
        
        if( !is_null( $iValId ) ){
            $iValId->setModDatDatoValor( $final_value );
            $iValId->setModDatFechaMod( new \DateTime );
            $em->persist($iValId);
            $em->flush();
        }else{
            $iValId = new EavModDatos();
            
            $usu_id = $em->getRepository('AppBundle:Usuario')->findOneBy(array( 'usuId' => $val_usu_id ));
            $iValId->setUsuarioDato( $usu_id );
            
            $pac_id = $em->getRepository('AppBundle:Paciente')->findOneBy(array( 'pacId' => $val_pac_id ));
            $iValId->setPacienteDato( $pac_id );
            
            $cli_id = $em->getRepository('AppBundle:Cliente')->findOneBy(array( 'cliId' => $val_cli_id ));
            $iValId->setClienteDato( $cli_id );
            
            $cit_id = $em->getRepository('AppBundle:Cita')->findOneBy(array( 'citId' => $val_cit_id ));
            $iValId->setCitaDato( $cit_id );
            
            $camp_id = $em->getRepository('AppBundle:EavModCampos')->findOneBy(array( 'modCampId' => $val_camp_id ));
            $iValId->setCampoDato( $camp_id );
            
            $iValId->setModDatDatoValor( $final_value );
            $iValId->setModDatFechaCrea( new \DateTime );
            
            $em->persist($iValId);
            $em->flush();
        }
        
        return new Response('1', Response::HTTP_OK);
        
        }catch( \Exception $e ){
            echo $e->getMessage().' ';
             return new Response('0', Response::HTTP_BAD_REQUEST);
        }
        
    }
    
}
