<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
	
	public function dashboardAction( Request $request )
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('EmrBundle:Dashboard:dashboard.html.twig', array(
        ));
    }
}
