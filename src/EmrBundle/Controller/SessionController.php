<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends Controller
{
	
	public function loginAction( Request $request )
    {
        return $this->render('EmrBundle:Session:login.html.twig', array());
    }
}
