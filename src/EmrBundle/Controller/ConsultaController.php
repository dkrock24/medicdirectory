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
					$prescription = trim( nl2br(@$prescription) );
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
	
	
	public function printPrescriptionAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$userId = $this->getUser()->getUsuId();
		$locationId = $this->get('session')->get('locationId');
		$locationName = $this->get('session')->get('locationName');
		
		$patientId = $request->get("p");
		$medicalConsulation = $request->get("c");
		
		$oRepo = $em->getRepository('AppBundle:Agenda')->findBy( array("ageId"=>$medicalConsulation, "ageCli"=>$locationId ) );
		
		if( !$oRepo )
		{
			throw $this->createNotFoundException('Consulta no válida para el establecimiento: '.$locationName );
		}	
		//$oRepo[0]->getAgeCit()->getCitId();
		
		//$oRepo[0]->getAgeCit()->getCitReceta();
		/*
		$oPatient = $em->getRepository('AppBundle:Paciente')->findBy( array("pacId"=>$patientId, "pacCli"=>$locationId ) );
		if( !$oPatient )
		{
			throw $this->createNotFoundException('El paciente no fue encontrado en el establecimiento: '.$locationName );
		}	
		*/
		
		$html = $this->renderView(
				'EmrBundle:consulta:_prescriptionDetail.html.twig',
				array(
				 'appointment' => $oRepo
				)
		    );
		
		//echo $html;
		//exit();
		$RAW_QUERY = "SELECT u.usu_id, CONCAT_WS(' ', u.usu_nombre, u.usu_segundo_nombre, u.usu_tercer_nombre, u.usu_primer_apellido, u.usu_segundo_apellido) as usu_nombre, 
						cu.cli_usu_titulo AS usu_titulo,
						cu.cli_usu_direccion as usu_direccion,
						cu.cli_usu_jvpm as usu_jvpm,
						cu.cli_usu_telefono as usu_telefono,
						c.cli_nombre as usu_establecimiento,
						GROUP_CONCAT(
								   e.esp_especialidad
								) as usu_especialidades
					    FROM cliente_usuario cu
					    INNER JOIN usuario u ON cu.cli_usu_usu_id = u.usu_id
					    LEFT JOIN usuario_especialidad ue ON ue.id_usuario = u.usu_id
					    LEFT JOIN especialidad e ON ue.id_especialidad = e.esp_id
						LEFT JOIN cliente c ON cu.cli_usu_cli_id = c.cli_id
					    WHERE cli_usu_cli_id =:locationId AND cu.cli_usu_rol_id = 6 AND u.usu_id =:userId
					    ORDER BY u.usu_nombre ASC";
		
		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("locationId", $locationId);
		$statement->bindValue("userId", $userId);
		$statement->execute();
		$aDoctor = $statement->fetchAll();
		if( count($aDoctor) > 0 )
		{
			//$html = "Ok esta es la receta";
			
			$html = $this->renderView(
				'EmrBundle:consulta:_prescriptionDetail.html.twig',
				array(
				 'appointment' => $oRepo
				)
		    );
			
			
			$this->returnPDF($aDoctor, $html);
		}	
		//var_dump($aDoctor);
		
		//$this->returnPDF($html);
		exit();
	}
	
	public function returnPDF($aDoctor, $html)
    {
        $mpdfService = $this->get('tfox.mpdfport');
        $mpdf = $mpdfService->getMpdf();
        
        $img_file = __DIR__ . '/../../../web/bundles/emr/images/bg-prescription.jpg';
        //$mpdf->Image($img_file,0,0,210,297,'jpg','',true, false);
        //$mpdf->watermarkImg(true);
        
        $url_logo = __DIR__. '/../../../web/logo.png';
        
        $img_logo = "";  //"<img src='".$url_logo."' style='width:75px; max-hight:auto; '>";
        
		$name = $aDoctor[0]['usu_titulo']." ".  ucwords($aDoctor[0]['usu_nombre']);
		$specialities = $aDoctor[0]['usu_especialidades'];
		$address = $aDoctor[0]['usu_direccion'];
		$locationName = $aDoctor[0]['usu_establecimiento'];
		
		
        $title = "<div style='text-align:center font-weight: bold; '><p style='text-align: center; font-weight: bold; font-size:18px'>".$name." </p><br>";
        $title .= "<p style='text-align: center; font-weight: bold;'>Especialista en : ".$specialities."<br><br></p>";
        $title .= " <h3>".$locationName."</h3>";
        $title .= "</div>";
        
        
        $header = "<table width='100%' style='vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;'><tr>";
        $header .= "<td width='9%'><span style='font-weight: bold; font-style: italic; vertical-align:center'>$img_logo</span></td>";
        $header .= "<td width='80%' align='center' style='font-weight: bold; font-style: italic; vertical-align:middle'>$title</td>";
        $header .= "<td width='9%' style='text-align: right; '></td>";
        $header .= "</tr></table>";
		
		
		
		
		$phone = "Tel: ".$aDoctor[0]['usu_telefono'];
		$email = $aDoctor[0]['usua_email'];
		if( $email != "" )
		{
			$email = "<br>".$email;
		}else{
			$email = "";
		}	
		
		
		$sign = "Firma: <span style='border-bottom: solid 1px #000; width:100px; display:block'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
        
        $mpdf->SetHeader($header);
        //$mpdf->SetHeader("$img_logo|$title|{PAGENO}");
        $mpdf->SetTopMargin(35);
		//$mpdf->SetBottomMargin(35);
        //$mpdf->SetHeader('Document Title|Center Text|{PAGENO}');
        $mpdf->SetFooter("<br><br>$sign|<br><br>$phone.$email|<br><br>Dirección: $address");
        $mpdf->defaultheaderfontsize=10;
        $mpdf->defaultheaderfontstyle='B';
        $mpdf->defaultheaderline=0;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='BI';
        $mpdf->defaultfooterline=0;
		$mpdf->AddPage('L','','','','',50,50,50,50,10,10);
		
		/*
		$mpdf->fonttrans = array(
				'trebuchet' => 'trebuchetms'
		);
        */
        $mpdf->SetWatermarkImage($img_file, 0.1, '', array(0,38));    
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output();


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
