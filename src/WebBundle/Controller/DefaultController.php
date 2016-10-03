<?php

namespace WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WebBundle:Sections:index.html.twig');
    }
    
    public function indexDoctoresAction()
    {
        return $this->render('WebBundle:Doctores:index.html.twig');
    }
    
    public function indexProfileAction()
    {
        return $this->render('WebBundle:Doctores:profile.html.twig');
    }
 
    public function indexHospitalesAction()
    {
        return $this->render('WebBundle:Hospitales:index.html.twig');
    }

    public function indexFarmaciasAction()
    {
        return $this->render('WebBundle:Farmacias:index.html.twig');
    }
}
