<?php

namespace WebBundle\Controller;

use AppBundle\Entity\ClienteUsuario;
use AppBundle\Entity\UsuarioVistas;
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

        $repository = $this->getDoctrine()->getRepository('AppBundle:ClienteUsuario');

        //$query = $repository->createQueryBuilder('cu')->setMaxResults(30);

        // Raw Query
        $RAW_QUERY  = "select *, group_concat(e.esp_especialidad SEPARATOR ', ') as especialidades from usuario u
                        JOIN cliente_usuario as cu on cu.cli_usu_usu_id=u.usu_id
                        JOIN usuario_especialidad AS es on u.usu_id=es.id_usuario
                        JOIN  especialidad as e on e.esp_id=es.id_especialidad
                        group by u.usu_id";
        $statement  = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();                
        $medicos    = $statement->fetchAll();



        $sBusqueda = $request->query->get('b');

        if (!empty($sBusqueda)) {
            $aRet = $this->get('srv_busqueda')->buscarUsuarios($sBusqueda, 1, 0, 30);

            if ($aRet['total'] > 0) {
                //$query->innerJoin('AppBundle:UsuarioEspecialidad','r','WITH','r.idUsuario=cliUsuUsu.usuId');
                $query->where('cu.cliUsuUsu IN (:usuarios)');
                $query->setParameter('usuarios', $aRet['ids']);
            } else {
                return new Response('Ningún cliente encontrado con' . $sBusqueda, Response::HTTP_OK);
            }

        }

        //$medicos = $query->getQuery()->getResult();

        return $this->render(
                    'WebBundle:Sections:index.html.twig', array(
                    'NombreProyecto' => $NombreProyecto,
                    'medicos' => $medicos
                    )
        );
    }

    public function indexDoctoresAction() {

        $em = $this->getDoctrine()->getManager();
        $em1 = $this->getDoctrine()->getManager()->createQueryBuilder();


        $medicos = $em->getRepository('AppBundle\Entity\Usuario')
                ->getUsuariosMedicos();

       
        
        $esp_service = $this->get('srv_catalogs')->getUsuariosMedicos();
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

        // Validar si la Cookie se ha seteado
        if(!isset($_COOKIE['contador']))
        {        
            // Obtener La Ip del visitante.
            $ip = $this->getRealIP(); 

            $oUser = $em->getRepository("AppBundle:Usuario")->findOneByUsuId($med_id);
            
            $visitas = new UsuarioVistas();
            $visitas->setVisUsuario($oUser);
            $visitas->setVisReferencia($ip);
            $visitas->setVisFechaCrea(new \DateTime("now"));

            $em->persist($visitas);
            $em->flush();
        } 
        else 
        { 
            // Caduca en un año 
            setcookie('contador', 1, time() + 365 * 24 * 60 * 60); 
            $mensaje = 'Bienvenido a nuestra página web'; 
        } 

        $medico = array();
        $em     = $this->getDoctrine()->getManager();
        $em1    = $this->getDoctrine()->getManager()->createQueryBuilder();

        $medico['usuario'] = $em->getRepository('AppBundle:ClienteUsuario')->findOneBy(array("cliUsuId" => $med_id));

        // Obtener especialidades Por Medico
        $medico['especialidad'] = $em1->select('r')
            ->from('AppBundle:Usuario','d')
            ->innerJoin('AppBundle:UsuarioEspecialidad','r','WITH','r.idUsuario=d.usuId')
            ->innerJoin('AppBundle:Especialidad','e','WITH','e.espId=r.idEspecialidad')            
            ->where('d.usuId = :usuarioId')
            ->setParameter('usuarioId',  $med_id)            
            ->getQuery()->getResult();


        $medico['redes']    = $em->getRepository('AppBundle:UsuarioSocial')->findAll(array("idUsuario" => $med_id));

        $medico['cliente']  = $em->getRepository('AppBundle:ClienteUsuario')->findOneBy(array("cliUsuUsu" => $med_id));

        $vistas  = $em->getRepository('AppBundle:UsuarioVistas')->findBy(array("visUsuario" => $med_id));

        $medico['vistas'] = count($vistas);

        return $this->render('WebBundle:Doctores:profile.html.twig', array(
                    "medico" => $medico
                    )
        );
    }

    private function getRealIP()
    {
   
        if ($_SERVER['SERVER_NAME']) 
        {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'] ))
            {
                $sIpAddress = @$_SERVER["HTTP_X_FORWARDED_FOR"];
            }
            elseif (isset($_SERVER["HTTP_CLIENT_IP"] ))
            {
                $sIpAddress = @$_SERVER["HTTP_CLIENT_IP"];
            }
            else
            {
                $sIpAddress = @$_SERVER["REMOTE_ADDR"];
            }
        }    
        return $sIpAddress;
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
