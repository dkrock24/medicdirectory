<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller
{
	
	public function dashboardAction( Request $request )
    {
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
		{
			$em = $this->getDoctrine()->getManager();
			
			$roles = $this->get('session')->get('userRoles');
			
			$locationId = $this->get('session')->get('locationId');
			$idUser =  $this->getUser()->getUsuId();
			
			$oUser = $em->getRepository('AppBundle:Usuario')->find( $idUser );
			/*
			$RAW_QUERY = "SELECT * FROM usuario u 
							left join usuario_galeria ug ON u.usu_id = ug.gal_usu_id
							WHERE ug.gal_cliente_id =:client
							AND cu.cli_usu_rol_id = 2 "; //5 = Cliente( Representante )
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("client", $cliente->getCliId() );
			$statement->execute();
			$getUserRepresenter = $statement->fetchAll();
			*/
			//==================================================================
			//Get appointment
			//==================================================================
			//$filter = "";
			/*
				if (isset($doctorId) && $doctorId > 0) {
					$filter = " AND a.age_usu_id = " . $doctorId;
				}
			*/
			//----------------------------------
			//Events type
			//1 = Cita Médica
            //2 = Evento Personal
            //3 = Ausente
            //4 = Receso
            //5 = Otros
			//-----------------------------------
			if( $locationId != "" )
			{
				/*
					$start = date("Y-m-d");
					$end = date("Y-m-d");
					$filter = " AND a.age_usu_id = " . $idUser;
					$RAW_QUERY = "SELECT a.age_id as id, a.age_fecha_inicio as start, a.age_fecha_fin as end, a.age_tipo_evento as tipo_evento, p.pac_id,  p.pac_nombre, p.pac_seg_nombre, p.pac_apellido, p.pac_seg_apellido,p.pac_dui, a.age_estado
										FROM agenda a
										LEFT JOIN cita c on c.cit_id = a.age_cit_id
										LEFT JOIN paciente p ON c.cit_pac_id = p.pac_id
										AND c.cit_activo = 1
										WHERE a.age_activo = 1
										AND a.age_cli_id = $locationId "
							. " AND  (date(a.age_fecha_inicio) >= '" . $start . "' AND date(a.age_fecha_inicio) <= '" . $end . "') "
							. $filter;


					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->execute();
					$appointments = $statement->fetchAll();
				*/
				$appointments = $this->getCurrentAppointment($locationId, $idUser);
			}else{
				$appointments = array();
			}
			//$appointments = "";
			$profilephoto = "";
			$oProfileImage = $em->getRepository('AppBundle:UsuarioGaleria')->findOneBy( array("galUsuario"=>$idUser, "galCliente"=>$locationId, "galTipo"=>1) );
			if( $oProfileImage )
			{
				$hashImg = $oProfileImage->getGalHash();
				$srvImage = $this->get('srv_uploadFile');
				$res = $srvImage->fileExist("perfil/".$hashImg);
				if( $res )
				{
					$profilephoto = $hashImg;
				}
			}
			
			
			//Get unread messages
			//$roles = $this->get('session')->get('userRoles');	
			//$locationId = $this->get('session')->get('locationId');
			//$idUser =  $this->getUser()->getUsuId();
			//$em = $this->getDoctrine()->getManager();	

			$unread = 0;
			
			if( $locationId != "" )
			{
				$oUnReadMessage = $em->getRepository('AppBundle:SolicitudContacto')->findBy( array("scUsuario"=>$idUser, "scCliente"=>$locationId, "estado"=>0) );
			
				if( count($oUnReadMessage) > 0 )
				{
					$unread = count($oUnReadMessage);
				}
				
				$RAW_QUERY = "SELECT * FROM solicitud_contacto WHERE sc_cli_id = $locationId AND sc_usu_id = $idUser ORDER BY fecha_contacto DESC LIMIT 20"; 
				$statement = $em->getConnection()->prepare($RAW_QUERY);
					//$statement->bindValue("idUser", $idUser );
				$statement->execute();
				$oMessages = $statement->fetchAll();
				
			
			}
			else
			{
				$oMessages = array();
			}
			

			
		}

		
		$oDoctorsList = $em->getRepository('AppBundle:ClienteUsuario')->findBy( array("cliUsuRol"=>6, "cliUsuCli"=>$locationId, "cliUsuActivo"=>1) );
		
		
		$aMedicalAppointmentCanceled = $this->getAppointmentStatus($locationId, $idUser, $date=false, 0, $all = false, $eventType=1);
		
		$aNoMedicalAppointmentCanceled = $this->getAppointmentStatus($locationId, $idUser, $date=false, 0, $all = false, $eventType=false);
		//var_dump($aNoMedicalAppointmentCanceled);
		$aAppointemntDone = $this->getAppointmentStatus($locationId, $idUser, $date=false, 1, $all = false, $eventType=1, "t");
		
        //$em = $this->getDoctrine()->getManager();
        return $this->render('EmrBundle:Dashboard:dashboard.html.twig', array(
			"profilephoto"=>$profilephoto,
			"userInfo"=> $oUser,
			"roles"=>$roles,
			"messages"=>$oMessages,
			'unReadMessage'=>$unread,
			"appointments"=>$appointments,
			"appointmentsMedicalCanceled"=>$aMedicalAppointmentCanceled,
			"otherAppointmentCanceled" => $aNoMedicalAppointmentCanceled,
			"appointmentDone" => $aAppointemntDone,
			"doctorsList"=>$oDoctorsList
        ));
    }
	
	
	public function getCurrentAppointment($locationId, $idUser, $date=false)
	{
		//$locationId = $this->get('session')->get('locationId');
		//$idUser =  $this->getUser()->getUsuId();
		$em = $this->getDoctrine()->getManager();
		
		$start = date("Y-m-d");
		$end = date("Y-m-d");
		if( ($date) && !empty($date) )
		{
			$start = $date;
			$end = $date;
		}
		
		$filter = " AND a.age_usu_id = " . $idUser;
		$RAW_QUERY = "SELECT a.age_id as id, a.age_fecha_inicio as start, a.age_fecha_fin as end, a.age_tipo_evento as tipo_evento, p.pac_id,  p.pac_nombre, p.pac_seg_nombre, p.pac_apellido, p.pac_seg_apellido,p.pac_dui, a.age_estado
									FROM agenda a
									LEFT JOIN cita c on c.cit_id = a.age_cit_id
									LEFT JOIN paciente p ON c.cit_pac_id = p.pac_id
									AND c.cit_activo = 1
									WHERE a.age_activo = 1
									AND a.age_cli_id = $locationId "
				. " AND  (date(a.age_fecha_inicio) >= '" . $start . "' AND date(a.age_fecha_inicio) <= '" . $end . "') "
				. $filter.
				" ORDER BY (date(a.age_fecha_inicio)) ASC ";


		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		$appointments = $statement->fetchAll();
		
		return $appointments;
	}
	
	
	
	public function getAppointmentStatus($locationId, $idUser, $date=false, $active=0, $all = false, $eventType=false, $ageStatus=false)
	{
		//$locationId = $this->get('session')->get('locationId');
		//$idUser =  $this->getUser()->getUsuId();
		$em = $this->getDoctrine()->getManager();
		
		$start = date("Y-m-d");
		$end = date("Y-m-d");
		
		$filterDate = "";
		if( ($date) && !empty($date) )
		{
			$start = $date;
			$end = $date;
			$filterDate =  " AND  (date(a.age_fecha_inicio) >= '" . $start . "' AND date(a.age_fecha_inicio) <= '" . $end . "') ";
		}
		
		if( $eventType == 1 && isset($eventType))
		{
			$filterEvent = " AND a.age_tipo_evento = 1";
		}else{
			$filterEvent = " AND a.age_tipo_evento <> 1";
		}	
		
		if( !$all )
		{
			$filerFields = " count(*) AS  total ";
		}
		else
		{
			$filerFields = " a.age_id as id, a.age_fecha_inicio as start, a.age_fecha_fin as end, a.age_tipo_evento as tipo_evento, p.pac_id,  p.pac_nombre, p.pac_seg_nombre, p.pac_apellido, p.pac_seg_apellido,p.pac_dui, a.age_estado ";
		}
		
		if( $active == 0 )
		{
			$filterActivo = " a.age_activo = 0 ";
		}else{
			$filterActivo = " a.age_activo = 1 ";
		}
		
		if( $ageStatus )
		{
			$filterStatus = " AND age_estado = 't' ";
		}	
		else{
			$filterStatus = "";
		}
		$filter = " AND a.age_usu_id = " . $idUser;
		$RAW_QUERY = "SELECT $filerFields
									FROM agenda a
									LEFT JOIN cita c on c.cit_id = a.age_cit_id
									LEFT JOIN paciente p ON c.cit_pac_id = p.pac_id
									AND c.cit_activo = 1
									WHERE $filterActivo
									AND a.age_cli_id = $locationId ".$filterEvent
				. $filterDate
				. $filter.$filterStatus.
				" ORDER BY (date(a.age_fecha_inicio)) ASC ";


		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		$appointments = $statement->fetchAll();
		
		return $appointments;
	}
	
	public function showAppointmentAction( Request $request )
	{
		$idUser = $request->get("userId");
		$date = $request->get("date");
		$locationId = $this->get('session')->get('locationId');
		$appointments = $this->getCurrentAppointment($locationId, $idUser, $date);
		
		return  $response = new JsonResponse($appointments);
		exit();
	}
}
