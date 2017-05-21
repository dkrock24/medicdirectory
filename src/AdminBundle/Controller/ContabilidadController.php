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
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        /* @var $oCliente \AppBundle\Entity\Cliente */
        $oCliente = NULL;

        /* @var $oHistorialPago \AppBundle\Entity\HistorialPago */
        $oHistorialPago = NULL;

        $aRet = $this->get('srv_busqueda')->buscarClientes($request->request->get('texto'), 1);

        if ($aRet['total'] > 0) {

            $oCliente = $em->getRepository(\AppBundle\Entity\Cliente::class)->find($aRet['ids'][0]);
        } else {
            return new Response('Ningún cliente encontrado', Response::HTTP_OK);
        }

        if (null !== $oCliente) {
            $oHistorialPago = $em->getRepository(\AppBundle\Entity\HistorialPago::class)->findBy(['hpaCliente' => $oCliente->getCliId()]);
        }

        return $this->render('AdminBundle:contabilidad:ajax.lista.html.twig', ['sphinx' => $aRet, 'cliente' => $oCliente, 'pagos' => $oHistorialPago]);
    }

    public function verPagoAction(Request $request) {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        /* @var $oHistorialPago \AppBundle\Entity\HistorialPago */
        $oHistorialPago = NULL;

        $iID = $request->request->get('id');
        
        if (empty($iID) || !is_numeric($iID)) {
            return new Response('Error en la llamada.', Response::HTTP_BAD_REQUEST);
        }

        $oHistorialPago = $em->getRepository(\AppBundle\Entity\HistorialPago::class)->find($iID);

        if (!$oHistorialPago){
            return new Response('No se encontró la información del pago solicitado.', Response::HTTP_BAD_REQUEST);
        }

        return $this->render('AdminBundle:contabilidad:ajax.ver.pago.html.twig', ['pago' => $oHistorialPago]);
    }

    public function procesarPagoAction(Request $request) {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        /* @var $oHistorialPago \AppBundle\Entity\HistorialPago */
        $oHistorialPago = NULL;

        $iID = $request->request->get('id');
        $iEstado = $request->request->get('estado');

        if (empty($iID) || !is_numeric($iID) || empty($iEstado) || !is_numeric($iEstado)) {
            return new Response('Error en la llamada.', Response::HTTP_BAD_REQUEST);
        }

        $oHistorialPago = $em->getRepository(\AppBundle\Entity\HistorialPago::class)->find($iID);

        if (!$oHistorialPago){
            return new Response('No se encontró la información del pago solicitado.', Response::HTTP_BAD_REQUEST);
        }

        // Pasó todas las validaciones, guardar confirmación de estado
        $oHistorialPago->setHpaMontoPagado($oHistorialPago->getHpaMontoEsperado());
        $oHistorialPago->setHpaFechaPago (new \DateTime());
        $oHistorialPago->setHpaUsuVerificado ($this->getUser());
        $oHistorialPago->setHpaEstado ($iEstado);

        $em->persist($oHistorialPago);
        $em->flush();

        return new Response('OK.', Response::HTTP_OK);
    }

    public function pagosPendientesAction(Request $request) {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        /* @var $oHistorialPago \AppBundle\Entity\HistorialPago */
        $oHistorialPago = NULL;

        $oHistorialPago = $em->getRepository(\AppBundle\Entity\HistorialPago::class)->findBy(['hpaEstado' => [0, 2]]);

        return $this->render('AdminBundle:contabilidad:index.lista.pendientes.html.twig', ['pagos' => $oHistorialPago]);
    }
}
