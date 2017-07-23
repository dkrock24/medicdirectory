<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use \AppBundle\Entity\Cita;
use \AppBundle\Entity\Agenda;

class AgendaController extends Controller
{
	
	public function newAction( Request $request  )
    {
		$em = $this->getDoctrine()->getManager();
		
		
		$doctor = $request->get("d");
		
		$patient = $request->get("p");
		
		//==================================================
		//get all user roles logged
		//==================================================
		$userRoles = $this->get('session')->get('userRoles');
		
		//==================================================
		//get all doctors from this establishment
		//==================================================
		
		$locationId = $this->get('session')->get('locationId');
		if( !$locationId )
		{
			return $this->redirectToRoute("emr_location");
		}
		
		$RAW_QUERY = "SELECT u.* FROM cliente_usuario cu
						
						INNER JOIN usuario u on cu.cli_usu_usu_id = u.usu_id 
						where cli_usu_cli_id =:locationId
						and cu.cli_usu_rol_id = 6 ORDER BY u.usu_nombre asc ";

		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("locationId", $locationId);
		$statement->execute();
		$doctorList = $statement->fetchAll();
		
		/*
		$arr = array();
		$con = 0;
		foreach($doctorList as $value )
		{
			$arr[] =
					
					
		}
		*/
		
		//================================================
		//Check if the doctor exists in the location
		//================================================
		$is_available = false;
		if( isset($doctor) )
		{
			
			foreach($doctorList as $value )
			{
				if($doctor == $value['usu_id'])
				{
					$is_available = true;
				}
			}
			
			if( !$is_available )
			{
				return $this->redirectToRoute("agenda_new");
			}
		}
		
		//================================================
		//Check if the patient exists in the location
		//================================================
		//echo $patient;
		$patientName = "";
		if( isset($patient) )
		{
			$patient_available = false;
			//select * from paciente
			$patient_repo = $em->getRepository("AppBundle:Paciente")->findBy(array("pacCli"=>$locationId, "pacId"=>$patient ));
			if(!$patient_repo)
			{
				//check if exists the variable doctor
				if( $is_available )
				{
					return $this->redirect( $this->generateUrl('agenda_new', array(
						'd' => $doctor
					)));
				}
				else
				{
					return $this->redirectToRoute("agenda_new");
				}
			}
			else
			{
				
				$patientName = $patient_repo[0]->getPacNombre()." ".$patient_repo[0]->getPacSegNombre()." ".$patient_repo[0]->getPacApellido()." ".$patient_repo[0]->getPacSegApellido();
			}
			
			
			//exit();
		}
		
		return $this->render("EmrBundle:agenda:new.html.twig", array(
			"userRoles" => $userRoles,
			"doctorList"=> $doctorList,
			"patientName"=>$patientName
		));
        
    }
	
	
	public function validAppointmentAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		
		
		//Options
		$action = $request->get("action");
		$view = $request->get("view");
		
		//Calendar
		$title = $request->get("title");
		$start = $request->get("start");
		$end = $request->get("end");
		
		//Doctor
		$doctorId = $request->get("doctor");
		
		//Patient
		$patientId = $request->get("patient");
		
		//Room
		$room = $request->get("room");
		//Event Type
		$eventType = $request->get("eventType");
		
		//reason
		$reason_delete = $request->get("reason");
		
		$locationId = $this->get('session')->get('locationId');
		$client_repo = $em->getRepository("AppBundle:Cliente")->find($locationId);
		
		//=========================
		//if it a update o delete
		//=========================
		$id = $request->get("id");
		
		if (isset($action) or isset($view))
		{
			//show all events
			if (isset($view))
			{

				header("Content-Type: application/json");

				$filter = "";
				if( isset($doctorId) && $doctorId > 0 )
				{
					$filter = " AND a.age_usu_id = ".$doctorId;
				}
				$RAW_QUERY = "SELECT a.age_id as id, a.age_fecha_inicio as start, a.age_fecha_fin as end, a.age_tipo_evento as tipo_evento,
								p.pac_nombre, p.pac_seg_nombre, p.pac_apellido, p.pac_seg_apellido
								FROM agenda a
								LEFT JOIN cita c on c.cit_id = a.age_cit_id
								
								AND c.cit_activo = 1
								LEFT JOIN paciente p ON c.cit_pac_id = p.pac_id
								WHERE a.age_activo = 1
								AND a.age_cli_id = $locationId "
								
							. " AND  (date(a.age_fecha_inicio) >= '".$start."' AND date(a.age_fecha_inicio) <= '".$end."') "
							. $filter ;
							

				$statement = $em->getConnection()->prepare($RAW_QUERY);
				//$statement->bindValue("username", $sUsername);
				$statement->execute();
				$rs = $statement->fetchAll();
				
				//var_dump($events);
				
				$events = array();
				foreach( $rs as $key)
				{
					$ar = array();
					$ar['id'] = $key['id'];
					$ar['start'] = $key['start'];
					$ar['end'] = $key['end'];
					
					
					switch ( $key['tipo_evento'] )
					{
						case 1:
							$color = "#0E77AE";
							$event = " Cita médica: ".$key['pac_nombre']." ".$key['pac_seg_nombre']." ".$key['pac_apellido']." ".$key['pac_seg_apellido'] ;
							break;
						case 2:
							$color = "#26A69A";
							$event = " Evento Personal ";
							break;
						case 3:
							$color = "#3a3a3a";
							$event = " Ausente ";
							break;
						case 4:
							$color = "#93c54b";
							$event = "Receso";	
						default:
							$color = "#FF7043";
							$event = "Otros";
							break;
					}
					
					$ar['title'] = $event;
					$ar['color'] = $color;
					//$ar['rendering'] = "background";
					array_push($events, $ar);
				}

				echo json_encode($events);

				exit;
			}
			else if ( $action == "add") 
			{ 
				// add new event
				$doctor_repo = $em->getRepository("AppBundle:Usuario")->find($doctorId);
				$em->getConnection()->beginTransaction(); // suspend auto-commit
				try
				{
					if( isset($patientId) && !empty($patientId) )
					{
						$patientId_repo = $em->getRepository("AppBundle:Paciente")->find($patientId);

						$obAppointment= new Cita();
						//$obAppointment->setCitHoraInicioCita( new \DateTime( date("Y-m-d H:i:s",strtotime($start) ) ) ) ; //setUsuRolUsuarios(  $representer_repo );
						//$obAppointment->setCitHoraFinCita(new \DateTime( date("Y-m-d H:i:s",strtotime($end) ) ) );
						$obAppointment->setCitUsu( $doctor_repo );
						$obAppointment->setCitNotas($title);
						$obAppointment->setCitPac( $patientId_repo );
						$obAppointment->setCitCli( $client_repo );
						if( isset($room) && !empty($room) )
						{
							$obAppointment->setCitSala($room);
						}
						$obAppointment->setCitFechaCrea( new \DateTime() );
						$em->persist($obAppointment);
						$flush = $em->flush();
						$lastAppointment = $obAppointment->getCitId();
					}
				
				
					$oDiary = new Agenda();
					if( isset($lastAppointment) && !empty($lastAppointment) )
					{
						$appointment_repo = $em->getRepository("AppBundle:Cita")->find($lastAppointment);
						$oDiary->setAgeCit( $appointment_repo );
						
					}else{
						$oDiary->setAgeNotas($title);
					}
					$oDiary->setAgeTipoEventor($eventType);
					$oDiary->setAgeCli( $client_repo );
					$oDiary->setAgeUsu( $doctor_repo );
					$oDiary->setAgeEstado("p");
					$oDiary->setAgeFechaInicio( new \DateTime( date("Y-m-d H:i:s",strtotime($start) ) ) );
					$oDiary->setAgeFechaFin( new \DateTime( date("Y-m-d H:i:s",strtotime($end) ) ) );
					$oDiary->setAgeFechaCrea( new \DateTime() );
					$em->persist($oDiary);
					$flush = $em->flush();
					$lastDiary = $oDiary->getAgeId();
					
					$em->getConnection()->commit();
					
					header("Content-Type: application/json");
					//echo "{'id':$lastDiary}";
					$jsondata['id'] = $lastDiary;
					echo json_encode($jsondata);
					//echo $lastDiary;
					exit;
				}
				catch (Exception $e) {
					$em->getConnection()->rollBack();
					throw $e;
				}
			} 
			else if ( $action == "update") 
			{  // update event
				//exit("sali");
				$oDiary = $em->getRepository("AppBundle:Agenda")->find($id);
				$oDiary->setAgeFechaInicio( new \DateTime( date("Y-m-d H:i:s",strtotime($start) ) ) );
				$oDiary->setAgeFechaFin( new \DateTime( date("Y-m-d H:i:s",strtotime($end) ) ) );
				$oDiary->setAgeFechaMod( new \DateTime() );
				$em->persist($oDiary);
				$flush = $em->flush();

				exit;
			} 
			else if ( $action == "delete") 
			{  // remove event

				$em->getConnection()->beginTransaction(); // suspend auto-commit
				try
				{
					$oDiary_repo = $em->getRepository('AppBundle:Agenda')->find($id);
				
					$appointment = $oDiary_repo->getAgeCit();
					
					if( empty($appointment) )
					{
						//$em->remove($oDiary_repo);
						$oDiary_repo->setAgeActivo(0);
						$oDiary_repo->setAgeEstado("a");
						$oDiary_repo->setAgeFechaMod(new \Datetime("now"));
						if( isset($reason_delete) && !empty($reason_delete) )
						{	
							$oDiary_repo->setAgeNotas($reason_delete);
						}
						$em->flush(); 
					}
					else
					{
						if( isset($reason_delete) && $reason_delete != "" )
						{
							$oDiary_repo->setAgeNotas($reason_delete);
						}
						
						$oDiary_repo->setAgeActivo(0);
						$oDiary_repo->setAgeEstado("a");
						$oDiary_repo->setAgeFechaMod(new \Datetime("now"));
						if( isset($reason_delete) && !empty($reason_delete) )
						{	
							$oDiary_repo->setAgeNotas($reason_delete);
						}
						$em->persist( $oDiary_repo );
						$em->flush(); 
					}
					

					/*
					$em->remove($oDiary_repo);
					$em->flush(); 
					if( !empty($appointment) )
					{
						$oAppointment_repo = $em->getRepository('AppBundle:Cita')->find($appointment);
						$em->remove($oAppointment_repo);
						$em->flush(); 
					}
					*/
					
					$em->getConnection()->commit();
					echo "1";
				}
				catch (Exception $e) {
					$em->getConnection()->rollBack();
					throw $e;
				}
				exit;
			}
		}
	}
	
	
	public function getDetailAppointmentAction( Request $request )
	{
		$appointment = $request->get("id");
		
		$locationId = $this->get('session')->get('locationId');
		$em = $this->getDoctrine()->getManager();
		
		$data = array();
		
		
		$fullName = "";
		$dui = "";
		$email="";
		$room = "";
		$res = 0;
		if( isset($appointment) && !empty($appointment) )
		{
			
			$diary_repo = $em->getRepository("AppBundle:Agenda")->find($appointment);
			if( $diary_repo )
			{
				$is_appointment = $diary_repo->getAgeCit();
				//var_dump($is_appointment);
				if( !empty($is_appointment) )
				{
					$name1 = $diary_repo->getAgeCit()->getCitPac()->getPacNombre();
					$name2 = $diary_repo->getAgeCit()->getCitPac()->getPacSegNombre();
					$lastName1 = $diary_repo->getAgeCit()->getCitPac()->getPacApellido();
					$lastName2 = $diary_repo->getAgeCit()->getCitPac()->getPacSegApellido();
					$fullName = $name1." ".$name2." ".$lastName1." ".$lastName2;
					
					$data['patient_id'] = $diary_repo->getAgeCit()->getCitPac()->getPacId();
					$data['fullname'] = trim($fullName);
					$data['email'] = $diary_repo->getAgeCit()->getCitPac()->getPacEmail();
					$data['dui'] = $diary_repo->getAgeCit()->getCitPac()->getPacDui();
					$data['notes'] = $diary_repo->getAgeCit()->getCitNotas();
					$data['room'] = $diary_repo->getAgeCit()->getCitSala();
					$data['appointment'] = 1;
					
				}else{
					//echo "xxxxxxxxx";
					$data['patient_id'] = "";
					$data['fullname'] = "";
					$data['email'] = "";
					$data['dui'] = "";
					$data['notes'] = $diary_repo->getAgeNotas();
					$data['room'] = "";
					$data['appointment'] = 0;
				}
				
				$res = 1;
			}
		}
		$data['res'] = $res;
		
		header("Content-Type: application/json");
		echo json_encode($data);
		
		//echo "<hr>";
		
		//echo "{'res':$res, 'is_appointment':$appointment,'fullname':$fullName,'dui':$dui,'email':$email,'room',$room, 'notes':$notes }";
				
		exit;
	}
	
	
	public function validConsulationAction( Request $request )
	{
		$appointment = $request->get("id");
		
		$locationId = $this->get('session')->get('locationId');
		$em = $this->getDoctrine()->getManager();
		
		$diary_repo = $em->getRepository("AppBundle:Agenda")->find($appointment);
		
		
		$data = $diary_repo->getAgeCit()->getCitPac()->getPacId();
		
		header("Content-Type: application/json");
		
		if( empty($data) )
		{
			echo json_encode(0);
		}
		else
		{
			echo json_encode($data);
		}

				
		exit;
	}
}
