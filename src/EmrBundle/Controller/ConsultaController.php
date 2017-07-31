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
                $hash_handler = null;
                $modulos = array();
                if(count($oUsuModulos) > 0 )
                {
                    foreach( $oUsuModulos as $kmod => $modulo ){
                        $hash_handler = $modulo->getCliModMod()->getModHashCode();
                        $modulos[] = array(
                                "mod_id" => $modulo->getCliModMod()->getModId(),
                                "mod_hash" => stream_get_contents( $hash_handler ),
                                "modulo" => $modulo->getCliModMod()->getModModulo()
                        );
                        rewind($hash_handler);
                    }
                }
                
                if( count( $oUsuModulosGenerales ) > 0 ){
                    foreach( $oUsuModulosGenerales as $kmod => $modulo ){
                        $hash_handler = $modulo->getModHashCode();
                        $mod_general = array(
                                "mod_id" => $modulo->getModId(),
                                "mod_hash" => stream_get_contents( $hash_handler ),
                                "modulo" => $modulo->getModModulo()
                        );
                        
                        //-- Fix to avoid having a module twice when this is assigned to a client and it's a
                        //-- "general" module at the same time.
                        if( !in_array( $mod_general , $modulos) ){
                            $modulos[] = $mod_general;
                        }
                        rewind($hash_handler);
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
		
		//$oAppointment = $em->getRepository('AppBundle:Agenda')->find( $appointment );
		$prescription = "";
		if( $oAppointment )
		{
			$prescription = $oAppointment->getAgeCit()->getCitReceta();
		}	
		
		$oAppointment->getAgeEstado();
		
		$roles = $this->get('session')->get('userRoles');
		return $this->render("EmrBundle:consulta:new.html.twig", array(
			"locationName"=>$locationName,
			"roles"=>$roles,
			"patient"=>$oPatient,
			"age"=>$patientAge,
            "modulos"=>$modulos,
            "historical"=>$historical, 
			'historialDetail' => $historicalDetail,
			"hours"=>$hours,
			"minutes"=>$minutes,
			"currentMilisecundsDiff"=>$currentMilisecundsDiff,
			'statusAppointment'=>$oAppointment->getAgeEstado(),
			'dateAppointment'=>$oAppointment->getAgeFechaInicio(),
			"prescription"=>$prescription,
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
	
	public function getFullInfoPatientAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$iLocationId = $this->get('session')->get('locationId');
		$patientId = $request->get("id");
		
		$oPatient = $em->getRepository('AppBundle:Paciente')->findBy( array("pacId"=>$patientId, "pacCli"=>$iLocationId ) );
		if( $oPatient )
		{
			$info = $oPatient;
		}
		else
		{
			$info = false;
		}
		
		return $this->render("EmrBundle:consulta:_infoPatient.html.twig", array(
            "info"=>$info
		));
		//exit();
	}
	
	public function setPrescriptionAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$iLocationId = $this->get('session')->get('locationId');
		$patientId = $request->get("patiendId");
		$prescription = $request->get("prescription");
		
		$appointment = $request->get("appointment");
		
		$oPatient = $em->getRepository('AppBundle:Paciente')->findBy( array("pacId"=>$patientId, "pacCli"=>$iLocationId ) );
		if( $oPatient )
		{
			//$info = $oPatient;
			$oAppointment = $em->getRepository('AppBundle:Agenda')->find( $appointment );
			if( $oAppointment )
			{
				$medicalConsultation = $oAppointment->getAgeCit();
				$oReg = $em->getRepository('AppBundle:Cita')->find( $medicalConsultation );
				if($oReg)
				{
					$oReg->setCitReceta($prescription);
					$em->persist( $oReg );
					$em->flush();
					echo 1;
				}
				
			}	
			//$oPatient[0]->setCitReceta($prescription);
			
		}
		
		exit();
	}
	
	
	public function sendEmailPrescriptionAction( Request $request )
	{
		$patientName = $request->get("fullname");
		$patientEmail = $request->get("email");
		$prescription = $request->get("prescription");
		$appointment = $request->get("appointment");
		$this->sendMessage("paciente_receta", $patientName, $prescription, $to=$patientEmail, $trom=false);
		echo 1;
		exit();
	}
	
	public function sendMessage($typeTemplate, $username, $prescription, $to, $trom=false)
	{
		
		//if( $typeMessage )
		//nuevo_usuario
		if( isset($typeTemplate) && !empty($typeTemplate) )
		{
			$srvMail = $this->get('srv_correos');
			$plantilla =$typeTemplate;// "nuevo_usuario";

			$locationName = $this->get('session')->get('locationName');

			$variables['location'] = $locationName;
			$variables['username'] = $username;
			$variables['prescription'] = $prescription;

			//$srvParameter = $this->get('srv_parameters');
			//$link_sistema = $srvParameter->getParametro("link_sistema", $default_return_value = "");

			//$variables['link'] = $link_sistema;

			$res = $srvMail->enviarCorreo ($plantilla, $variables, $to, $de = '') ;
		}
		
		/*
		// Create Transport
        $https['ssl']['verify_peer'] = FALSE;
        $https['ssl']['verify_peer_name'] = FALSE;

        $this->transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls')
           ->setUsername("")
           ->setPassword("")
           ->setStreamOptions($https)
           ;
        // Create Mailer with our Transport.
        $this->mailer = \Swift_Mailer::newInstance($this->transport);
		
		
		$to = "gialvarezlopez@gmail.com";
		$from = "gialvarezlopez@gmail.com";
		$message = \Swift_Message::newInstance()
					->setSubject('Regístro de nuevo usuario')
					->setFrom($from)
					->setTo('gialvarezlopez@gmail.com')
					->setBody(
						$this->renderView(
							'EmrBundle:cliente:mail.html.twig',
							array('location'=>$location, 'link'=>$link, 'username' => $username, "password"=>$password)
						)
					);

		# Send the message
		//$this->get('mailer')->send($message);
		$results = $this->mailer->send($message);
		
		*/
		
	}
	
}
