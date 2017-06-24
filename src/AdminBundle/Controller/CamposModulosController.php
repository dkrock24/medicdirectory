<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CamposModulosController extends Controller
{
    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modulos = $em->getRepository('AppBundle:Modulo')->findBy(array( 'modActivo' => 1 ))
                ;
        return $this->render('AdminBundle:CamposModulos:index.html.twig', array(
            'modulos' => $modulos
        ));
    }

    public function editAction()
    {
        return $this->render('AdminBundle:CamposModulos:edit.html.twig', array(
            // ...
        ));
    }

    public function deleteAction()
    {
        return $this->render('AdminBundle:CamposModulos:delete.html.twig', array(
            // ...
        ));
    }

    public function newAction()
    {
        return $this->render('AdminBundle:CamposModulos:new.html.twig', array(
            // ...
        ));
    }
    
    public function getSeccionesModuloAction( Request $request ){
        
        $id_mod = $request->request->get('id_mod');
        
        $em = $this->getDoctrine()->getManager();

        
        $secciones = $em->getRepository('AppBundle:EavModSeccion')
                ->findBy( array( 'modSeccModId' => $id_mod ) )
                ;
        
        $seccion_array = array();
        
        foreach( $secciones as $seccion ){
            $seccion_array[] = array(
                'id' => $seccion->getModSeccId(),
                'text' => $seccion->getModSeccSeccion()
            );
        }
        
        return new Response(
            json_encode($seccion_array)
        );
        
        ;
        
    }
    
    public function tableList( Request $request ){
        
    }

}
