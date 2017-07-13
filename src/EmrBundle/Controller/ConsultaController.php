<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



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
//                $modulos = array();
                if(count($oUsuModulosGenerales) > 0 )
                {
                    foreach( $oUsuModulosGenerales as $kmod => $modulo ){
                        $modulos[] = array(
                                "mod_id" => $modulo->getModId(),
                                "mod_hash" => stream_get_contents( $modulo->getModHashCode() ),
                                "modulo" => $modulo->getModModulo()
                        );
                    }
                }
                
                if( count( $oUsuModulosGenerales ) > 0 ){
                    foreach( $oUsuModulos as $kmod => $modulo ){
                        $modulos[] = array(
                                "mod_id" => $modulo->getCliModMod()->getModId(),
                                "mod_hash" => stream_get_contents( $modulo->getCliModMod()->getModHashCode() ),
                                "modulo" => $modulo->getCliModMod()->getModModulo()
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
		
                
		return $this->render("EmrBundle:consulta:new.html.twig", array(
			"patient"=>$oPatient,
			"age"=>$patientAge,
            "modulos"=>$modulos,
            "historical"=>$historical,        
            'usu_id' => $doctor,
            'cit_id' => $oAppointment->getAgeCit()->getCitId(),
            'cli_id' => $iLocationId
		));
		
	}
	

}
