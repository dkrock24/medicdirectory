<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\PlantillaCorreo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CorreosController extends Controller
{
    public function indexAction()
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        $oPlantillas = $em->getRepository('AppBundle:PlantillaCorreo')->findAll();

        return $this->render('AdminBundle:correos:index.html.twig', ['plantillas' => $oPlantillas]);
    }

    public function guardarAction(Request $request){
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        $sNombre = $request->request->get('nombre');

        if (empty($sNombre)) {
            return new Response('Error en la llamada.', Response::HTTP_BAD_REQUEST);
        }

        $oPlantilla = $em->getRepository('AppBundle:PlantillaCorreo')->findOneBy(['nombre' => $sNombre]);

        if (!$oPlantilla) {
            $oPlantilla = new PlantillaCorreo();
        }

        $oPlantilla->setActivo(true);
        $oPlantilla->setNombre($sNombre);
        $oPlantilla->setAsunto($request->request->get('asunto'));
        $oPlantilla->setPlantilla($request->request->get('plantilla'));

        $em->persist($oPlantilla);
        $em->flush();

        return new Response('Plantilla guardada exitosamente');
    }

    public function cargarAction(Request $request){
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        $iID = $request->request->get('id');

        if (empty($iID) || !is_numeric($iID)) {
            return new Response('Error en la llamada.', Response::HTTP_BAD_REQUEST);
        }

        $oPlantilla = $em->getRepository('AppBundle:PlantillaCorreo')->find($iID);

        if (!$oPlantilla) {
            return new Response('No se encontró la información solicitada.', Response::HTTP_BAD_REQUEST);
        }

        $json = [];
        $json['id'] = $oPlantilla->getId();
        $json['titulo'] = $oPlantilla->getNombre();
        $json['asunto'] = $oPlantilla->getAsunto();
        $json['plantilla'] = $oPlantilla->getPlantilla();

        return new JsonResponse($json);
    }

    public function probarAction(){
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        $oPlantillas = $em->getRepository('AppBundle:PlantillaCorreo')->findAll();

        return $this->render('AdminBundle:correos:probar.html.twig', ['plantillas' => $oPlantillas]);
    }

    public function probarEnviarAction(Request $request){
        $this->get('srv_correos')->enviarCorreo('registro.reiniciar_clave',[],'vladimiroski@gmail.com');

        return new Response('Correo enviado');
    }
}
