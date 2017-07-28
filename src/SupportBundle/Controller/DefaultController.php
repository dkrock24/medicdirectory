<?php

namespace SupportBundle\Controller;

use AppBundle\Entity\SoporteCasos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function crearAction(Request $request)
    {
        if ( $request->getMethod() == 'POST' && $request->request->has('guardarCaso') ) {
            return $this->guardarCaso($request);
        }

        // Obtener los temas
        $em = $this->getDoctrine()->getEntityManager();

        $aCriteria = [];
        $aCriteria['activo'] = 1;
        $oSoporteTemas = $em->getRepository('AppBundle:SoporteTemas')->findBy($aCriteria);

        return $this->render('SupportBundle:Default:crear.html.twig',
            [
                'temas' => $oSoporteTemas
            ]
        );
    }

    private function guardarCaso(Request $request) {
        var_dump($request->request->all());
        $em = $this->getDoctrine()->getEntityManager();

        $oCaso = new SoporteCasos();

        $oCaso->setAsunto($request->get('soporte_asunto'));
        $oCaso->setTema($em->getReference('AppBundle:SoporteTemas', $request->get('soporte_tema')));
        $oCaso->setEstado($em->getReference('AppBundle:SoporteEstados', 1));
        $oCaso->setFechaActualizacion(new \DateTime());
        $oCaso->setFechaCreacion(new \DateTime());
        $oCaso->setUsuarioCreador($em->getReference('AppBundle:ClienteUsuario', $this->get('session')->get('cliUsuCli')));
        $oCaso->setUsuarioAsignado(null);

        var_dump($this->get('session')->get('cliUsuCli'));

        $em->persist($oCaso);
        $em->flush();

        // Redirect
        return $this->redirectToRoute('support_homepage_listar');

    }

    public function listarAction (Request $request) {

        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository('AppBundle:SoporteCasos');
        $query = $repository->createQueryBuilder('sc');
        $query->innerJoin('sc.estado', 'e');
        $query->where('e.cierre = 0');

        $casos = $query->getQuery()->getResult();

        return $this->render('SupportBundle:Default:listar.html.twig',
            [
                'casos' => $casos
            ]
        );
    }
}
