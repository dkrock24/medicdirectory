<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use \AppBundle\Entity\Cita;
use \AppBundle\Entity\Agenda;

class ReportesController extends Controller
{
	
	
	public function indexAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$locationId = $this->get('session')->get('locationId');
		$userRoles = $this->get('session')->get('userRoles');
		$userId = $this->getUser()->getUsuId();
		
		
		$RAW_QUERY = "SELECT u.* , cu.cli_usu_titulo as usu_titulo  FROM cliente_usuario cu
						
						INNER JOIN usuario u on cu.cli_usu_usu_id = u.usu_id 
						where cli_usu_cli_id =:locationId
						and cu.cli_usu_rol_id = 6 ORDER BY u.usu_nombre asc ";

		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("locationId", $locationId);
		$statement->execute();
		$doctorList = $statement->fetchAll();
		
		return $this->render("EmrBundle:reportes:index.html.twig", array(
			"userRoles" => $userRoles,
			"doctorList"=> $doctorList,
			//"patientName"=>$patientName,
			//"settings"=>$aSettings
		));
		
	}
	
	
	public function showAction( Request $request )
	{
		$iLocationId = $this->get('session')->get('locationId');
		$doctorId = $request->get('doctorId');
		$status = $request->get('status');
		$from = $request->get('from');
		$to = $request->get('to');
		$patientId = $request->get('patientId');
		
		if( isset($from) && $from != "" && isset($to) && $to != "")
		{
			$filterDate = " AND date(a.age_fecha_inicio) BETWEEN '".$from."' AND  '".$to."' ";
		}else if( isset($from) && $from != "" && !isset($to) && $to == "" )
		{
			$filterDate = " AND date(a.age_fecha_inicio) = '".$from."'";
		}else if( isset($to) && $to!= "" && !isset($from) && $from =="" )
		{
			$filterDate = " AND date(a.age_fecha_inicio) = '".$to."'";
		}else{
			$filterDate = " AND a.age_fecha_inicio BETWEEN DATE_SUB(NOW(), INTERVAL 3 MONTH) AND NOW()";
		}	
		
		if( isset($status) && $status != "")
		{
			$filterStatus = " AND a.age_estado = '".$status."' ";
		}else{
			$filterStatus = "";
		}
		
		if( isset($patientId) && $patientId != "" )
		{
			$filterPatiendId = " AND c.cit_pac_id = $patientId ";
		}else{
			$filterPatiendId = "";
		}	
		
		if( isset($doctorId) && !empty($doctorId) )
		{
			//$espacio = " ";
			//$q = $sSearch;
			//$q = str_replace($espacio, "(.*)", $q);

			
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
		exit();
	}		
	
}
