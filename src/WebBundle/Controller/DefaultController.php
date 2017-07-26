<?php

namespace WebBundle\Controller;

use AppBundle\Entity\ClienteUsuario;
use AppBundle\Entity\UsuarioVistas;
use AppBundle\Entity\Cliente;
use \AppBundle\Entity\SolicitudContacto;
use \AppBundle\Entity\Contactanos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller {


    public function indexAction(Request $request) {
        /* @var $sParametros AppBundle\Services\servicioParametros */
        //$sParametros = $this->get('parametros');

        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getDoctrine()->getManager();

        //$NombreProyecto = $sParametros->getParametro("nombreProyecto");

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
                        JOIN usuario_galeria as ug on ug.gal_usu_id=cu.cli_usu_usu_id
                        WHERE ug.gal_modulo_id is null and ug.gal_tipo=1 and cu.cli_usu_rol_id=6
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
                    //'NombreProyecto' => $NombreProyecto,
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

        $medico['usuario'] = $em->getRepository('AppBundle:ClienteUsuario')->findOneBy(array("cliUsuUsu" => $med_id,"cliUsuRol"=>6));

        $medico['galeria'] = $em->getRepository('AppBundle:UsuarioGaleria')->findOneBy(array("galUsuario"=>$med_id,"galTipo"=>1,"galModulo"=>null));

        // Obtener especialidades Por Medico
        
        $medico['especialidad'] = $em1->select('r')
            ->from('AppBundle:Usuario','d')
            ->innerJoin('AppBundle:UsuarioEspecialidad','r','WITH','r.idUsuario=d.usuId')
            ->innerJoin('AppBundle:Especialidad','e','WITH','e.espId=r.idEspecialidad')            
            ->where('d.usuId = :usuarioId')
            ->setParameter('usuarioId',  $med_id)            
            ->getQuery()->getResult();


        $medico['redes']    = $em->getRepository('AppBundle:UsuarioSocial')->findBy(array("idUsuario" => $medico['usuario']->getCliUsuId()));

        $medico['cliente']  = $em->getRepository('AppBundle:ClienteUsuario')->findOneBy(array("cliUsuUsu" => $med_id,"cliUsuRol"=>6));

        $vistas  = $em->getRepository('AppBundle:UsuarioVistas')->findBy(array("visUsuario" => $med_id));

        $medico['vistas'] = count($vistas);
        //\Doctrine\Common\Util\Debug::dump($medico['cliente']);
        //var_dump($medico['cliente']->getCliUsuDiasTrabajo());
        $horaDias = array();
        $hoy = "";
        if($medico['cliente']->getCliUsuDiasTrabajo()!=""){
            $arr = unserialize($medico['cliente']->getCliUsuDiasTrabajo());
            //var_dump($arr);

            $num = 1;
            
            $horaDias = array();
            $dias = array(1 => "Mon", 2 => "Mar", 3 => "Mie", 4 => "Jue", 5 => "Vie", 6 => "Sab", 7 => "Dom");
            $hoy = $dias[date("N")];

            foreach ($arr as $key => $value) 
            {
                if ( count($value) > 0 )
                {
                    $hd = "";
                    $cadena = $this->rangos($value);
                    $hd .= $cadena;
                    $horaDias[$key] = $hd;
                }

                $num++; 
            }

            //var_dump($horaDias);

        }
        

        return $this->render('WebBundle:Doctores:profile.html.twig', array(
                    "medico" => $medico,
                    "horario" => $horaDias,
                    "hoy" => $hoy
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

    public function indexPrivacidadAction() {
        return $this->render('WebBundle:Terminos:privacidad.html.twig');
    }

    public function indexSolicitarAction(){

        // Guardar Solicitud de Cita
        $em = $this->getDoctrine()->getManager();
        
        //Cliente
        $id_cliente     =  $_POST['idCliente'];
        $client_repo    = $em->getRepository('AppBundle:Cliente')->find($id_cliente);

        //Usuario
        $id_usuario     = $_POST['idUsuario'];
        $usuario_repo   = $em->getRepository('AppBundle:Usuario')->find($id_usuario);

        //Obteniendo correo del establecimiento.
        $emailClinica   = $em->getRepository('AppBundle:ClienteUsuario')->findOneBy(array("cliUsuCli" => $id_cliente));

        // Dates
        $fecha      = $_POST['fecha'];
        $hora       = $_POST['hora'];
        $nombre     = $_POST['nombre'];
        $telefono   = $_POST['telefono'];
        $correo     = $_POST['correo'];
        $comentario = $_POST['comentario'];
        $strHora    = $fecha." ".substr($hora,0,-2);
        //$fecha_string = $strHora;

        $ip = $this->getRealIP();            

        $oSolicitud = new SolicitudContacto();

        $oSolicitud->setScCliente( $client_repo );
        $oSolicitud->setScUsuario( $usuario_repo );
        $oSolicitud->setIp( $ip );
        $oSolicitud->setScNombre( $nombre );
        $oSolicitud->setTelefono( $telefono );
        $oSolicitud->setCorreo( $correo );
        $oSolicitud->setComentario( $comentario );
        $oSolicitud->setEstado(1);
        $oSolicitud->setFechaContacto(new \DateTime($strHora));
        
        $em->persist($oSolicitud);
        $flush = $em->flush();

        $msg = "Registro creado con Exito";

        //Notificar a la clinica de solicitud de cita
        $this->sendMessage("solicitar_cita", $nombre, $telefono, $correo, $comentario,$strHora, $to=$emailClinica[0]->getCliUsuCorreo,$trom=false);

        return  $response = new JsonResponse(($msg));
    }

    public function indexContactanosAction(){
        return $this->render('WebBundle:Contactanos:index.html.twig');
    }

    public function indexContactosAction()
    {
        // Guardar Contactanos
        $em = $this->getDoctrine()->getManager();

        $date = date("Y-m-d h:m:s");

        // Dates
        $nombre     = $_POST['nombre'];
        $email      = $_POST['email'];
        $tipo       = $_POST['tipo'];
        $mensaje    = $_POST['mensaje'];
        $ip         = $this->getRealIP();            

        $oContactanos = new Contactanos();

        $oContactanos->setConNombre( $nombre );
        $oContactanos->setConEmail( $email );
        $oContactanos->setConIp( $ip );
        $oContactanos->setConTipo( $tipo );
        $oContactanos->setConMensaje( $mensaje );      
        $oContactanos->setConActivo(1);
        $oContactanos->setConFechaCrea(new \Datetime());

        $em->persist($oContactanos);
        $flush = $em->flush();        

        $msg = "Información Enviada Con Exito";

        $medicosSV = "medicoselsalvador@gmail.com";

        $this->sendMessage("contactanos", $nombre, $email,$tipo,$mensaje,$ip, $to=$medicosSV,$trom=false);
        

        return  $response = new JsonResponse(($msg));
    }

    public function sendMessage($typeTemplate, $nombre, $email,$tipo,$mensaje,$ip, $to, $trom=false)
    {
        //solicitar_cita
        if( isset($typeTemplate) && !empty($typeTemplate) )
        {
            $srvMail = $this->get('srv_correos');
            $plantilla =$typeTemplate;// "contactanos";

            $variables['nombre_usuario '] = $nombre;
            $variables['email']     = $email;
            $variables['tipo']      = $tipo;
            $variables['mensaje']   = $mensaje;
            $variables['ip']        = $ip;

            $srvParameter = $this->get('srv_parameters');
            //$link_sistema = $srvParameter->getParametro("link_sistema", $default_return_value = "");
            //$variables['link'] = $link_sistema;

            $res = $srvMail->enviarCorreo ($plantilla, $variables, $to, $de = '') ;
        }
    }

    public function sendMessageCliente($typeTemplate, $nombre, $telefono,$correo,$comentario,$strHora, $to, $trom=false)
    {
        //solicitar_cita
        if( isset($typeTemplate) && !empty($typeTemplate) )
        {
            $srvMail = $this->get('srv_correos');
            $plantilla =$typeTemplate;// "solicitar_cita";

            $variables['nombre_usuario '] = $nombre;
            $variables['telefono']      = $telefono;
            $variables['email']         = $correo;
            $variables['mensaje']       = $comentario;
            $variables['fecha']         = $strHora;

            $srvParameter = $this->get('srv_parameters');
            //$link_sistema = $srvParameter->getParametro("link_sistema", $default_return_value = "");
            //$variables['link'] = $link_sistema;

            $res = $srvMail->enviarCorreo ($plantilla, $variables, $to, $de = '') ;
        }
    }

    public function calcular_tiempo_trasnc($hora1,$hora2)
    {
        $separar[1]=explode(':',$hora1);
        $separar[2]=explode(':',$hora2);

        $total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1];
        $total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1];
        $total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2];
        if($total_minutos_trasncurridos<=59){
            //return($total_minutos_trasncurridos.' Minutos');
            return($total_minutos_trasncurridos);   
        } 
        else if($total_minutos_trasncurridos>59)
        {
            $HORA_TRANSCURRIDA = round($total_minutos_trasncurridos/60);
            if($HORA_TRANSCURRIDA<=9)
            {
                $HORA_TRANSCURRIDA='0'.$HORA_TRANSCURRIDA;
            }
            $MINUITOS_TRANSCURRIDOS = $total_minutos_trasncurridos%60;
            if($MINUITOS_TRANSCURRIDOS<=9) 
            {
                $MINUITOS_TRANSCURRIDOS='0'.$MINUITOS_TRANSCURRIDOS;
            }   
            //return ($HORA_TRANSCURRIDA.':'.$MINUITOS_TRANSCURRIDOS.' Horas');
            return $Minutos = ($HORA_TRANSCURRIDA * 60)+$MINUITOS_TRANSCURRIDOS;

        } 
    }

    public function rangos($arr)
    {
        $pros = 1;
        $total = count($arr);
        $cadena = "";
        $block = false;
        for($i=0; $i < count($arr); $i++)
        {
            if($pros < $total)
            {
                $res = abs( $this->calcular_tiempo_trasnc($hora1=$arr[$i],$hora2=$arr[$i+1]) );
                if( $pros == 1 )
                {
                    $cadena .= date('ga', strtotime($arr[$i]));
                }
                else
                {
                    if( $res != 60 )
                    {
                        $cadena .= " <i>a</i> ". date('ga', strtotime($arr[$i]));
                        $block=true;
                    }
                    else
                    {
                        if( $block )
                        {
                            $cadena .= "<br /> ". date('ga', strtotime($arr[$i]));
                            $block = false;
                        }   
                    }
                }
            }
            else
            {
                $cadena .= " <i>a</i> " .date('ga', strtotime($arr[$i]));
            }
            $pros++;

        }
        return $cadena;
    }

}
