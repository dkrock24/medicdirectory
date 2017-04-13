<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	
	public function redirectMenuAction( $route  )
    {
		
		// redirect to the route example paciente_
		return $this->redirectToRoute($route);
		
		//return $this->render("ErmBundle:".$folder.":".$pagina.".html.twig");
        
    }
	
	
	public function establecimientoAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$idUser =  $this->getUser()->getUsuId();
		//echo $this->get('security.token_storage')->getToken()->getUser()->getUsuId();
		$user_repo = $em->getRepository("AppBundle:ClienteUsuario")->findByCliUsuUsu($idUser);
		//return $this->redirectToRoute("");
		return $this->render("EmrBundle:Default:location.html.twig", array('data' => $user_repo));
	}

}
