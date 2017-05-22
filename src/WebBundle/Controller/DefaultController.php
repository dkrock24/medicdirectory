<?php

namespace WebBundle\Controller;

use AppBundle\Entity\ClienteUsuario;
use AppBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        /* @var $sParametros AppBundle\Services\servicioParametros */
        $sParametros = $this->get('parametros');

        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        $NombreProyecto = $sParametros->getParametro("nombreProyecto");

        // Cambié el repository por un DQL para controlar el filtro y limite
        // Rafa, si te enfocaras estas cosas no pasaran
        // $medicos = $em->getRepository("AppBundle:ClienteUsuario")->findAll();

        $repository = $this->getDoctrine()
                ->getRepository('AppBundle:ClienteUsuario');


        $query = $repository->createQueryBuilder('cu')
                ->setMaxResults(30)
                ;

        $sBusqueda = $request->query->get('b');

        if (!empty($sBusqueda)) {
            $aRet = $this->get('srv_busqueda')->buscarUsuarios($sBusqueda, 1, 0, 30);

            if ($aRet['total'] > 0) {
                $query->where('cu.cliUsuUsu IN (:usuarios)');
                $query->setParameter('usuarios', $aRet['ids']);
            } else {
                return new Response('Ningún cliente encontrado con' . $sBusqueda, Response::HTTP_OK);
            }

        }

        $medicos = $query->getQuery()->getResult();

        return $this->render(
                        'WebBundle:Sections:index.html.twig', array(
                    'NombreProyecto' => $NombreProyecto,
                    'medicos' => $medicos
                        )
        );
    }

    public function indexDoctoresAction() {
        $em = $this->getDoctrine()->getManager();
        $medicos = $em->getRepository('AppBundle\Entity\Usuario')
<<<<<<< HEAD
                ->getUsuariosMedicos();

        $esp_service = $this->get('catalogs');
=======
            ->getUsuariosMedicos();
        
        $esp_service = $this->get('srv_catalogs');
>>>>>>> db81caf6e8951c8ef07c12c5df025112c0a20372
        $esp = $esp_service->getEspecialidades();

        return $this->render('WebBundle:Doctores:index.html.twig', array(
                    'medicos' => $medicos,
                    'esp' => $esp
                        )
        );
    }

    public function indexProfileAction($med_id) {
        if ($med_id === null) {
            return $this->redirect($this->generateUrl('web_homepage'));
        }

        $em = $this->getDoctrine()->getManager();
        //$medico = $em->getRepository('AppBundle\Entity\Usuario')->getMedicoById( $med_id );
        $medico = $em->getRepository('AppBundle:Usuario')->findOneBy(array("usuId" => $med_id));


        return $this->render('WebBundle:Doctores:profile.html.twig', array(
                    "medico" => $medico
                        )
        );
    }

    public function indexHospitalesAction() {
        /* @var $em \Doctrine\ORM\EntityManager  */
        $em = $this->getDoctrine()->getManager();
        $hospitales = $em->getRepository('AppBundle\Entity\Usuario')
                ->getHospitales();

        return $this->render('WebBundle:Hospitales:index.html.twig', array('hospitales' => $hospitales)
        );
    }

    public function indexFarmaciasAction() {
        return $this->render('WebBundle:Farmacias:index.html.twig');
    }

    public function indexPreciosAction() {
        return $this->render('WebBundle:Precios:index.html.twig');
    }

    public function indexTerminosAction() {
        return $this->render('WebBundle:Terminos:index.html.twig');
    }

}
