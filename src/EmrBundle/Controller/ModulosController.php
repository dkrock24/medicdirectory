<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
#use \AppBundle\Entity\Cita;
#use \AppBundle\Entity\Agenda;

class ModulosController extends Controller
{
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	
	public function indexAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$locationId = $this->get('session')->get('locationId');
		
		$idUser = $this->getUser()->getUsuId();
		
		//$locationId = $request->get("id");
		$location_repo = $em->getRepository("AppBundle:ClienteUsuario")->findBy( array("cliUsuCli"=>$request->get("id"), "cliUsuUsu"=>$idUser, "cliUsuRol"=>2) );
		if( !$location_repo )
		{
			throw new AccessDeniedException('Acceso denegado');
		}
		
		
		if( !$locationId )
		{
			$srvSession = $this->get('srv_session');
			$res = $srvSession->setSessionLocation( $idUser, $request->get("id") );
			if( $res )
			{
				//return $this->redirectToRoute("emr_dashboard");
				$userRoles = $this->get('session')->get('userRoles');
			}
		}else{
			$userRoles = $this->get('session')->get('userRoles');
		}
		
		/*
		if( !array_key_exists(2, $userRoles) )
		{
			throw new AccessDeniedException('Acceso denegado.');
		}
		*/
	
		$arrCurrentModules = array();
		$oMyModules = $em->getRepository("AppBundle:ClienteModulo")->findBy(array("cliModCli"=>$locationId ) );
		foreach($oMyModules as $item)
		{
			$arrCurrentModules[ $item->getCliModMod()->getModId() ][] = /*$item->getCliModMod()->getModId();//*/($item->getCliModActivo())?1:0;
		}	
	
		
		$oAllModules = $em->getRepository("AppBundle:Modulo")->findBy(array("modActivo"=>1 ) );
		
		return $this->render("EmrBundle:modulos:index.html.twig", array(
			//"userRoles" => $userRoles,
			"currentModules"=>$arrCurrentModules,
			"allModules"=>$oAllModules
		));
		
	}
	
	
	public function showAction( Request $request )
	{
		$iLocationId = $this->get('session')->get('locationId');
		echo $id = $request->get('id');
		
		/*
		if( isset($doctorId) && !empty($doctorId) )
		{
			$em = $this->getDoctrine()->getManager();
			$RAW_QUERY = "
							SELECT 
							c.cit_notas, concat_ws(' ', p.pac_nombre, p.pac_seg_nombre, p.pac_apellido, p.pac_seg_apellido ) AS paciente,
							concat_ws(' ', u.usu_nombre, u.usu_segundo_nombre, u.usu_tercer_nombre, u.usu_primer_apellido, u.usu_segundo_apellido ) AS medico,
							 CASE a.age_estado WHEN 'c' THEN 'En curso' WHEN 't' THEN 'Finilizada' WHEN 'a' THEN 'Anulada' WHEN 'p' THEN 'Pendiente' END  AS estatus,
							 a.age_fecha_inicio, c.cit_pac_id, a.age_id 
							FROM agenda a
							INNER JOIN cita c ON a.age_cit_id = c.cit_id
							INNER JOIN paciente p ON c.cit_pac_id = p.pac_id
							INNER JOIN usuario u ON c.cit_usu_id = u.usu_id
							WHERE c.cit_cli_id = $iLocationId AND u.usu_id = $doctorId $filterDate $filterStatus $filterPatiendId
					     ";
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->execute();

			$result = $statement->fetchAll();
			
			//var_dump( $result );
		}
		return  $response = new JsonResponse($result);
		*/
		exit();
	}		
	
}
