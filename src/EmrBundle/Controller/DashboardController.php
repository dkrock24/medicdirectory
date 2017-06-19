<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
	
	public function dashboardAction( Request $request )
    {
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
		{
			$em = $this->getDoctrine()->getManager();
			
			$locationId = $this->get('session')->get('locationId');
			$idUser =  $this->getUser()->getUsuId();
			
			$oUser = $em->getRepository('AppBundle:ClienteUsuario')->findOneBy( array("cliUsuUsu"=>$idUser, "cliUsuCli"=>$locationId) );
			
			//echo count($oUser);
		}

        $em = $this->getDoctrine()->getManager();
        return $this->render('EmrBundle:Dashboard:dashboard.html.twig', array(
        ));
    }
}
