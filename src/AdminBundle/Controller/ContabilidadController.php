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

        $indexesToSearch = array('Clientes');
        $options = array(
            'result_offset' => 0,
            'result_limit' => 1,
        );
        $sphinxSearch = $this->get('search.sphinxsearch.search');
        $sphinxSearch->setMatchMode(SPH_MATCH_EXTENDED);
        $sphinxSearch->setFilter('cli_activo', array(1), false);
        $searchResults = $sphinxSearch->search($request->request->get('texto'), $indexesToSearch, $options);

        $data = [];
        $data['total'] = $searchResults['total_found'];
        $data['sphinx'] = @$searchResults['matches'];
        return new \Symfony\Component\HttpFoundation\JsonResponse($data);
    }

}
