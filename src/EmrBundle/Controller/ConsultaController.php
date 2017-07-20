<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;


class ConsultaController extends Controller
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
		/*
		$locationId = $this->get('session')->get('locationId');
		if( !$locationId )
		{
			return $this->redirectToRoute("emr_location");
		}
		*/
		
		$RAW_QUERY = "SELECT u.* FROM cliente_usuario cu
						
						INNER JOIN usuario u on cu.cli_usu_usu_id = u.usu_id 
						where cli_usu_cli_id =:locationId
						and cu.cli_usu_rol_id = 6 ORDER BY u.usu_nombre asc ";

		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("locationId", $locationId);
		$statement->execute();
		$doctorList = $statement->fetchAll();
		
		
		
		return $this->render("EmrBundle:agenda:new.html.twig", array(
                    
		));
        
    }
	
	
	
	
	public function medicalConsultationAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();

        $doctor = $this->getUser()->getUsuId();
        
		$iLocationId = $this->get('session')->get('locationId');
		
		$patientId = $request->get('id');
		$diaryId = $request->get('cm');
		
		if( !$diaryId )
		{
			throw $this->createNotFoundException('Cita no valida');
		}
		
		$oAppointment = $em->getRepository('AppBundle:Agenda')->find( $diaryId );
		if( !$oAppointment )
		{
			throw $this->createNotFoundException('No existe la cita');
		}
		else if( $oAppointment->getAgeCit() == "" )
		{
			throw $this->createNotFoundException('No hay una cita programada en la agenda ');
		}
		else if( $oAppointment->getAgeCli()->getCliId() != $iLocationId )
		{
			throw $this->createNotFoundException('Cita no permitida para este establecimiento: '.$oAppointment->getAgeCli() );
		}
		
		
		
		
		
		$locationName = $this->get('session')->get('locationName');
		
        $oPatient = $em->getRepository('AppBundle:Paciente')->findBy( array("pacId"=>$patientId, "pacCli"=>$iLocationId ) );
        
            //-- Get all the modules which the user has access to.
                $oUsuModulos = $em->getRepository('AppBundle:ClienteModulo')
                        ->findBy(
                                array( 'cliModCli' => $iLocationId, 'cliModActivo' => 1 ), 
                                array('cliModFechaCrea' => 'ASC')
                        )
                        ;
                
                $oUsuModulosGenerales = $em->getRepository('AppBundle:Modulo')
                        ->findBy( 
                            array( 'modGeneral' => 1, 'modActivo' => 1 ),
                            array( 'modFechaCrea' => 'ASC' )
                        )
                        ;
//                echo '<pre>';
//                        \Doctrine\Common\Util\Debug::dump( $oUsuModulosGenerales );
//                echo '</pre>';
//                
                $modulos = array();
                if(count($oUsuModulos) > 0 )
                {
                    foreach( $oUsuModulos as $kmod => $modulo ){
                        $modulos[] = array(
                                "mod_id" => $modulo->getCliModMod()->getModId(),
                                "mod_hash" => stream_get_contents( $modulo->getCliModMod()->getModHashCode() ),
                                "modulo" => $modulo->getCliModMod()->getModModulo()
                        );
                    }
                }
                
                if( count( $oUsuModulosGenerales ) > 0 ){
                    foreach( $oUsuModulosGenerales as $kmod => $modulo ){
                        $modulos[] = array(
                                "mod_id" => $modulo->getModId(),
                                "mod_hash" => stream_get_contents( $modulo->getModHashCode() ),
                                "modulo" => $modulo->getModModulo()
                        );
                    }
                }
                
		
		if( !isset($patientId) || empty($patientId) )
		{
			throw $this->createNotFoundException('Debe de iniciar la consulta con un paciente válido');
		}else if( !$oPatient )
		{
			throw $this->createNotFoundException('El paciente no fue encontrado en el establecimiento: '.$locationName );
		}
		
		$patientAge = "";
		if( !empty($oPatient[0]->getPacFechaNacimiento()) )
		{
			$age = date( 'Y/m/d', strtotime( $oPatient[0]->getPacFechaNacimiento()->format('Y-m-d') ) );
			$servPatient = $this->get('srv_patient');
			$patientAge = $servPatient->getAge( $age );
		}
		

		//Historico
		$RAW_QUERY = "SELECT a.age_id AS id, a.age_fecha_inicio AS start, a.age_fecha_fin AS end, a.age_tipo_evento AS tipo_evento,  a.age_estado
					FROM agenda a
					LEFT JOIN cita c ON c.cit_id = a.age_cit_id AND c.cit_activo = 1
					LEFT JOIN paciente p ON c.cit_pac_id = p.pac_id
					WHERE a.age_activo = 1 AND a.age_cli_id =:locationId AND c.cit_pac_id =:patientId";

		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("locationId", $iLocationId);
		$statement->bindValue("patientId", $patientId);
		$statement->execute();
		$historical  = $statement->fetchAll();
		
        
		$historicalDetail = $this->patientHistory($iLocationId, $patientId);
		
		
		//$appStart = $oAppointment->getAgeFechaInicio()->format('Y-m-d :H:i:s');
		//$appEnd = $oAppointment->getAgeFechaFin()->format('Y-m-d :H:i:s');
		
		$appStart = new \DateTime( $oAppointment->getAgeFechaInicio()->format('Y-m-d H:i:s') );
		$appEnd = new \DateTime( $oAppointment->getAgeFechaFin()->format('Y-m-d H:i:s') );
		$fecha = $appStart->diff($appEnd);
		//printf('%d años, %d meses, %d días, %d horas, %d minutos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);
		$hours =  $fecha->h;
		$minutes = $fecha->i;
		
		
		//echo $diaryId."-";
		//echo $oAppointment->getAgeFechaCapturaDatos();
		
		//echo $data;
		//var_dump($data);
		//echo $oAppointment->getAgeFechaCapturaDatos()->format('Y-m-d H:i:s');
		//=====================
		//Count up
		//====================
		$currentMilisecundsDiff = 0;
		if( $oAppointment->getAgeFechaCapturaDatos() != "" )
		{	
			$dateStartInfo = $oAppointment->getAgeFechaCapturaDatos()->format('Y-m-d H:i:s');
			$dateEndInfo = date("Y-m-d H:i:s");
			$currentMilisecundsDiff = ( strtotime($dateEndInfo) - strtotime($dateStartInfo) ) * 100;
		}
		
		//End
		//=====================
		
		
		$oAppointment->getAgeEstado();
		
		return $this->render("EmrBundle:consulta:new.html.twig", array(
			"patient"=>$oPatient,
			"age"=>$patientAge,
            "modulos"=>$modulos,
            "historical"=>$historical, 
			'historialDetail' => $historicalDetail,
			"hours"=>$hours,
			"minutes"=>$minutes,
			"currentMilisecundsDiff"=>$currentMilisecundsDiff,
			'statusAppointment'=>$oAppointment->getAgeEstado(),
            'usu_id' => $doctor,
            'cit_id' => $oAppointment->getAgeCit()->getCitId(),
            'cli_id' => $iLocationId
		));
		
	}
	
	public function patientHistory($iLocationId, $patientId)
	{
		$em = $this->getDoctrine()->getManager();
		$arr = array();
		if( isset($patientId) && is_numeric($patientId) )
		{
			//================================================
			//cancelated
			//================================================
			$RAW_QUERY = "SELECT count(*) as total
					FROM agenda a
					LEFT JOIN cita c ON c.cit_id = a.age_cit_id
					WHERE a.age_tipo_evento=1 and a.age_cli_id =:locationId and c.cit_pac_id =:patientId and ( a.age_activo = 0 OR a.age_estado = 'a')"; //a= anulada
			
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("locationId", $iLocationId);
			$statement->bindValue("patientId", $patientId);
			$statement->execute();
			$historical  = $statement->fetchAll();
			
			$arr['cancelated'] = $historical[0]['total'];
			
			
			//================================================
			//Already processed
			//================================================
			$RAW_QUERY = "SELECT count(*) as total
					FROM agenda a
					LEFT JOIN cita c ON c.cit_id = a.age_cit_id
					WHERE a.age_tipo_evento=1 and a.age_cli_id =:locationId and c.cit_pac_id =:patientId and a.age_activo = 1 and a.age_estado = 't'"; //Finalizada
			
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("locationId", $iLocationId);
			$statement->bindValue("patientId", $patientId);
			$statement->execute();
			$historical  = $statement->fetchAll();
			
			$arr['processed'] = $historical[0]['total'];
			
			
			//================================================
			//Pending
			//================================================
			$RAW_QUERY = "SELECT count(*) as total
					FROM agenda a
					LEFT JOIN cita c ON c.cit_id = a.age_cit_id
					WHERE a.age_tipo_evento=1 and a.age_cli_id =:locationId and c.cit_pac_id =:patientId and a.age_activo = 1 and a.age_estado = 'P'"; //Pendiente
			
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("locationId", $iLocationId);
			$statement->bindValue("patientId", $patientId);
			$statement->execute();
			$historical  = $statement->fetchAll();
			
			$arr['pending'] = $historical[0]['total'];
			
		}
		return $arr;
		
	}
	
	
	public function processAppointmentAction( Request $request )
	{
		header("Content-Type: application/json");
		
		$em = $this->getDoctrine()->getManager();

        $doctor = $this->getUser()->getUsuId();
        
		$iLocationId = $this->get('session')->get('locationId');
		
		$diaryId = $request->get('cm');
		
		$action = $request->get('action');
		
		$oAppointment = $em->getRepository('AppBundle:Agenda')->findBy( array("ageId"=>$diaryId, "ageCli"=>$iLocationId ) );
		//$oAppointment = $em->getRepository('AppBundle:Agenda')->find( 28  );
		if( $oAppointment )
		{
			if( $action == "add" )
			{	
				$oAppointment[0]->setAgeFechaCapturaDatos( new \DateTime("now") );
				$oAppointment[0]->setAgeEstado( 'c' ); //c= en curso
			}
			else
			{
				$oAppointment[0]->setAgeEstado( 't' ); //t=terminada, finalizada
			}
			$em->persist( $oAppointment[0] );
			$em->flush();
			echo 1;
		}
		//echo count($oAppointment);
		//$oAppointment->setAgeFechaCapturaDatos( new \DateTime("now") );
		//echo $oAppointment->getAgeFechaCapturaDatos()->format("Y-m-d")."xxxxxxxx";
		exit();
	}
	

	public function isRunningAppointmentAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();

        $doctor = $this->getUser()->getUsuId();
        
		$iLocationId = $this->get('session')->get('locationId');
		if( $iLocationId )
		{	

			$userRoles = $this->get('session')->get('userRoles');

			$oAppointment = $em->getRepository('AppBundle:Agenda')->findBy( array("ageUsu"=>$doctor, "ageCli"=>$iLocationId,"ageEstado"=>"c" ) );
			$appointmentActived = 0;
			$id = "";
			$cm = "";
			$patientId = "";
			if( $oAppointment )
			{
				$appointmentActived = 1;
				$cm = $oAppointment[0]->getAgeId();

				$patientId = $oAppointment[0]->getAgeCit()->getCitPac()->getPacId();
			}

			return $this->render("EmrBundle:consulta:_appointmentStatus.html.twig", array(
				'appointmentActived' => $appointmentActived,
				"cm"=>$cm,
				"patientId"	=> $patientId,
				"roles"=>$userRoles
			));
		}
	}
	
}
