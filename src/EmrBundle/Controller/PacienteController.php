<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class PacienteController extends Controller
{
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	
	public function indexAction(){
		/*
		$em = $this->getDoctrine()->getManager();
		$girl_repo = $em->getRepository("LipsBundle:Girl");
		$girls = $girl_repo->findAll();
		
		return $this->render("LipsBundle:Girl:index.html.twig", array(
			"girls" => $girls
		));
		*/
	}
	
	public function newAction(Request $request)
	{			
		if ( $request->getMethod() == 'POST')
		{
			$em = $this->getDoctrine()->getEntityManager();
			$cita = new SysCita();
			$cita->setSysInstTieneArea( $request->get("name") );
			$cita->setSysUsuarioMedico($form->get("username")->getData());
			$cita->setSysUsuarioPaciente($form->get("age")->getData());
			$cita->setFechaCitaSysCita($form->get("price")->getData());
			$cita->setComentario($request->get("comentario_cita")->getData());
			$cita->setFechaCita($form->get("phone")->getData());

			$em->persist($cita);
			$flush = $em->flush();

			if ($flush == null) {
				$status = "Cita creada con éxito";
			} else {
				$status = "No se pudo crear el la cita ";
			}

			$this->session->getFlashBag()->add("status",$status);
			return $this->redirectToRoute("emr_cita_add");
		}

		return $this->render("EmrBundle:Cita:add.html.twig", array(
			//"form" => $form->createView()
		));
	}
	
}
