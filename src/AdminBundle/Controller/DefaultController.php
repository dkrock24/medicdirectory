<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	
	public function indexAction( Request $request )
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('AppBundle:Session:login.html.twig', array(
        ));
    }
}
