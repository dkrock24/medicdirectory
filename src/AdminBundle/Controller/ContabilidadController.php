<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContabilidadController extends Controller {

    public function indexAction(Request $request) {
        return $this->render('AdminBundle:contabilidad:index.html.twig', array());
    }

    public function buscarAction(Request $request) {

        $aRet = $this->get('srv_busqueda')->buscarClientes($request->request->get('texto'), 1);

        $aJson = $aRet;


        return new \Symfony\Component\HttpFoundation\JsonResponse($aJson);
    }

}
