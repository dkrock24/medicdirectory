<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CorreosController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:correos:index.html.twig', []);
    }
}
