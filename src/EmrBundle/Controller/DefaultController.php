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
}
