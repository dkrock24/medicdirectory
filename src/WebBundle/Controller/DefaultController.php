<?php

namespace WebBundle\Controller;

use AppBundle\Entity\ClienteUsuario;
use AppBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /* @var $sParametros AppBundle\Services\servicioParametros */
        $sParametros = $this->get('parametros');

        $NombreProyecto = $sParametros->getParametro("nombreProyecto");

        $em = $this->getDoctrine()->getManager();
        //$em->getRepository("AppBundle:ClienteUsuario")->findAll();
        $medicos = $em->getRepository("AppBundle:ClienteUsuario")->findAll();
        
        //var_dump($medicos[0]->getCliUsuUsu()->getUsuUsuario());
        
        return $this->render(
            'WebBundle:Sections:index.html.twig', 
            array(
                'NombreProyecto' => $NombreProyecto,
                'medicos' => $medicos
            )
                
        );
    }
    
    public function indexDoctoresAction()
    {
        $em = $this->getDoctrine()->getManager();
        $medicos = $em->getRepository('AppBundle\Entity\Usuario')
            ->getUsuariosMedicos();
        
        $esp_service = $this->get('srv_catalogs');
        $esp = $esp_service->getEspecialidades();
        
        return $this->render('WebBundle:Doctores:index.html.twig',
                array(
                    'medicos' => $medicos,
                    'esp' => $esp
                )
        );
    }
    
    public function indexProfileAction( $med_id )
    {
        if( $med_id === null ){
            return $this->redirect($this->generateUrl('web_homepage'));
        }
        
        $em = $this->getDoctrine()->getManager();        
        //$medico = $em->getRepository('AppBundle\Entity\Usuario')->getMedicoById( $med_id );
        $medico = $em->getRepository('AppBundle:Usuario')->findOneBy(array("usuId"=>$med_id) );
        
        
        return $this->render('WebBundle:Doctores:profile.html.twig',
                array(
                    "medico" => $medico
                )
        );
    }
 
    public function indexHospitalesAction()
    {
        /* @var $em \Doctrine\ORM\EntityManager  */
        $em = $this->getDoctrine()->getManager();
        $hospitales = $em->getRepository('AppBundle\Entity\Usuario')
                ->getHospitales();
        
        return $this->render('WebBundle:Hospitales:index.html.twig',
                array('hospitales' => $hospitales)
                );
    }

    public function indexFarmaciasAction()
    {
        return $this->render('WebBundle:Farmacias:index.html.twig');
    }

    public function indexPreciosAction()
    {
        return $this->render('WebBundle:Precios:index.html.twig');
    }
    public function indexTerminosAction()
    {
        return $this->render('WebBundle:Terminos:index.html.twig');
    }
}
