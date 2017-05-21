<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContabilidadReportesController extends Controller {

    public function indexAction(Request $request) {
        return $this->render('AdminBundle:contabilidad:index.reporte.html.twig', []);
    }

    public function verAction(Request $request) {
        $iTipo = $request->request->get('tipo');

        if (empty($iTipo) || !is_numeric($iTipo)) {
            return new Response('Error en la llamada.', Response::HTTP_BAD_REQUEST);
        }

        // Vemos si el reporte existe en su propia funcion, asi nos evitamos un switch
        $sMethod = 'Reporte' . $iTipo;
        if (method_exists($this, $sMethod)) {
            return $this->$sMethod();
        }

        return new Response("Reporte ID $iTipo no implementado.", Response::HTTP_OK);
    }

    // Grandes totales
    private function Reporte1() {

        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        $aStat = [];
        $aStat['total_vendido_mes'] = 0;
        $aStat['total_vendido_anio'] = 0;
        $aStat['total_vendido'] = 0;

        $aStat['total_pagado_mes'] = 0;
        $aStat['total_pagado_anio'] = 0;
        $aStat['total_pagado'] = 0;

        $aStat['total_clientes'] = 0;
        $aStat['total_usuarios'] = 0;
        $aStat['total_usuarios_x_cliente'] = 0;

        // Total vendido (sin importar estado)
        // Mes
        $sInicio = date('Y-m-01 00:00:00');
        $sFin = date('Y-m-t 23:59:59');
        $sQuery = "SELECT SUM(hp.hpaMontoEsperado) FROM AppBundle:HistorialPago hp WHERE hp.hpaFechaCrea BETWEEN '$sInicio' AND '$sFin'";
        $aStat['total_vendido_mes'] = $em->createQuery($sQuery)->getSingleScalarResult();

        // Año
        $sInicio = date('Y-01-01 00:00:00');
        $sFin = date('Y-12-31 23:59:59');
        $sQuery = "SELECT SUM(hp.hpaMontoEsperado) FROM AppBundle:HistorialPago hp WHERE hp.hpaFechaCrea BETWEEN '$sInicio' AND '$sFin'";
        $aStat['total_vendido_anio'] = $em->createQuery($sQuery)->getSingleScalarResult();

        // Todo
        $sQuery = "SELECT SUM(hp.hpaMontoEsperado) FROM AppBundle:HistorialPago hp";
        $aStat['total_vendido'] = $em->createQuery($sQuery)->getSingleScalarResult();

        // Total pagado
        // Mes
        $sInicio = date('Y-m-01 00:00:00');
        $sFin = date('Y-m-t 23:59:59');
        $sQuery = "SELECT SUM(hp.hpaMontoEsperado) FROM AppBundle:HistorialPago hp WHERE hp.hpaFechaCrea BETWEEN '$sInicio' AND '$sFin' AND hp.hpaEstado = 1";
        $aStat['total_pagado_mes'] = $em->createQuery($sQuery)->getSingleScalarResult();

        // Año
        $sInicio = date('Y-01-01 00:00:00');
        $sFin = date('Y-12-31 23:59:59');
        $sQuery = "SELECT SUM(hp.hpaMontoEsperado) FROM AppBundle:HistorialPago hp WHERE hp.hpaFechaCrea BETWEEN '$sInicio' AND '$sFin' AND hp.hpaEstado = 1";
        $aStat['total_pagado_anio'] = $em->createQuery($sQuery)->getSingleScalarResult();

        // Todo
        $sQuery = "SELECT SUM(hp.hpaMontoEsperado) FROM AppBundle:HistorialPago hp WHERE hp.hpaEstado = 1";
        $aStat['total_pagado'] = $em->createQuery($sQuery)->getSingleScalarResult();

        // Total de clientes
        $sQuery = "SELECT SUM(c.cliId) FROM AppBundle:Cliente c";
        $aStat['total_clientes'] = $em->createQuery($sQuery)->getSingleScalarResult();

        $sQuery = "SELECT SUM(c.cliId) FROM AppBundle:Cliente c WHERE c.cliActivo = 1";
        $aStat['total_clientes_activos'] = $em->createQuery($sQuery)->getSingleScalarResult();

        $sQuery = "SELECT SUM(c.cliId) FROM AppBundle:Cliente c WHERE c.cliActivo = 0";
        $aStat['total_clientes_inactivos'] = $em->createQuery($sQuery)->getSingleScalarResult();

        // Usuarios
        $sQuery = "SELECT TRUNCATE(AVG(tmp.cUsuarios),0) AS promedio FROM (SELECT SUM(cu.cli_usu_cli_id) AS cUsuarios FROM cliente_usuario cu GROUP BY cu.cli_usu_cli_id) AS tmp";
        $statement = $em->getConnection()->prepare($sQuery);
        $statement->execute();

        $aStat['total_usuarios_x_cliente'] = $statement->fetchAll()[0]['promedio'];

        return $this->render('AdminBundle:contabilidad/Reportes:reporte1.html.twig', ['stat' => $aStat]);
    }

    // Vista anual
    private function Reporte2() {
        return new Response('OK. Encontrado: 2', Response::HTTP_OK);
    }

}
