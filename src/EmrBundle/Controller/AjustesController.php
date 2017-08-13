<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Session\Session;
use \AppBundle\Entity\ClienteAjustes;
#use \AppBundle\Entity\Cita;
#use \AppBundle\Entity\Agenda;

class AjustesController extends Controller
{

	private $session;
    
    public function __construct() {
        $this->session = new Session();
    }
	
	public function showAction( Request $request  )
	{
		$em = $this->getDoctrine()->getManager();

		//$doctor = $request->get("id");
		$idUser =  $this->getUser()->getUsuId();
		
		//==================================================
		//get all user roles logged
		//==================================================
		$userRoles = $this->get('session')->get('userRoles');
		
		//==================================================
		//get all doctors from this establishment
		//==================================================
		$locationId = $this->get('session')->get('locationId');
		$locationName = $this->get('session')->get('locationName');
		if( !$locationId )
		{
			return $this->redirectToRoute("emr_location");
		}
		
		//get the id in table cliente_usuario
		$oClientUser = $em->getRepository("AppBundle:ClienteUsuario")->findBy(array("cliUsuCli"=>$locationId, "cliUsuUsu"=>$idUser, "cliUsuRol"=>array(3, 6) ) ); //3= asistente, 6 = medico
		//$oClientUser = $em->getRepository("AppBundle:ClienteUsuario")->findBy(array("cliUsuCli"=>$locationId, "cliUsuUsu"=>$idUser, "cliUsuRol"=>6 ) ); //6 = medico
		
		if( !$oClientUser )
		{
			throw new AccessDeniedException('Lo sentimos tu no tienes rol de médico/asistente o tu cuenta ya no esta activa.');
		}	
		
		
		$cliUsuId =  $oClientUser[0]->getCliUsuId();
		
		$RAW_QUERY = "SELECT * FROM cliente_ajustes
						where cli_aju_cli_usu_id =:cliUsuId
						and cli_aju_activo = 1";

		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("cliUsuId", $cliUsuId);
		$statement->execute();
		$parameters = $statement->fetchAll();
		
		//var_dump($parameters);
		
		
		//==========================
		//Set the session 
		//==========================
			
		$srvSettings = $this->get('srv_client_settings');
		$aSettings = $srvSettings->getClientSettings( $idUser);
		
		
		//var_dump($res);
		$oDoctorsList = $em->getRepository('AppBundle:ClienteUsuario')->findBy( array("cliUsuRol"=>6, "cliUsuCli"=>$locationId, "cliUsuActivo"=>1) );
		
		return $this->render("EmrBundle:ajustes:settings.html.twig", array(
			"userRoles" => $userRoles,
			"parameters"=> $parameters,
			"locationName"=>$locationName,
			"settings"=>$aSettings,
			"doctorsList"=>$oDoctorsList
		));
		
	}
	
	
	public function updateSystemSettingAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();

		//$doctor = $request->get("id");
		$idUser =  $this->getUser()->getUsuId();
		
		//==================================================
		//get all user roles logged
		//==================================================
		$userRoles = $this->get('session')->get('userRoles');
		
		//==================================================
		//get all doctors from this establishment
		//==================================================
		$locationId = $this->get('session')->get('locationId');
		
		
		//var_dump($logo);
		//exit();
		
		if( $request )
		{
			
			$oClientUserId = $em->getRepository("AppBundle:ClienteUsuario")->findOneBy(array("cliUsuCli"=>$locationId, "cliUsuUsu"=>$idUser, "cliUsuRol"=>6 ) ); //6 = medico
			
			
			$arrParameter = array();
			if($oClientUserId)
			{
				$iClientUserId = $oClientUserId->getCliUsuId();
				$oSettings = $em->getRepository("AppBundle:ClienteAjustes")->findBy(array("cliAjuCliUsu"=>$iClientUserId ) ); 
				if( count($oSettings) > 0 )
				{
					foreach( $oSettings as $value)
					{
						$arrParameter[] = $value->getCliAjuLlave();
					}
				}
				
				//=============================
				//Starts all validations
				//=============================
				$key1 = "minutos_por_evento";
				if (in_array($key1, $arrParameter)) {
					//echo "Existe Irix";
					$RAW_QUERY = "UPDATE  cliente_ajustes SET cli_aju_valor =:value, cli_aju_fecha_mod =:date 
										where cli_aju_cli_usu_id =:cliUsuId AND cli_aju_llave =:key ";

					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->bindValue("key", $key1);
					$statement->bindValue("value", $request->request->get('calMinutes') );
					$statement->bindValue("cliUsuId", $iClientUserId);
					$statement->bindValue("date", date("Y-m-d H:i:s"));
					$statement->execute();
				}
				else
				{
					$oSetting = new ClienteAjustes();
					$oSetting->setCliAjuLlave($key1);
					$oSetting->setCliAjuValor( $request->request->get('calMinutes') );
					$oSetting->setCliAjuCliUsu( $oClientUserId );
					$oSetting->setCliAjuActivo(1);
					$oSetting->setCliAjuFechaCrea( new \DateTime("now"));
					$em->persist($oSetting);
					$flush = $em->flush();
				}
				
				//==============================================================
				$key2 = "mostrar_cronometro_en_consulta";
				if (in_array($key2, $arrParameter)) {
					//echo "Existe Irix";
					$RAW_QUERY = "UPDATE  cliente_ajustes SET cli_aju_valor =:value, cli_aju_fecha_mod =:date 
										where cli_aju_cli_usu_id =:cliUsuId AND cli_aju_llave =:key ";

					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->bindValue("key", $key2);
					$statement->bindValue("value", $request->request->get('appTime') );
					$statement->bindValue("cliUsuId", $iClientUserId);
					$statement->bindValue("date", date("Y-m-d H:i:s"));
					$statement->execute();
				}
				else
				{
					$oSetting = new ClienteAjustes();
					$oSetting->setCliAjuLlave($key2);
					$oSetting->setCliAjuValor( $request->request->get('appTime') );
					$oSetting->setCliAjuCliUsu( $oClientUserId );
					$oSetting->setCliAjuActivo(1);
					$oSetting->setCliAjuFechaCrea( new \DateTime("now"));
					$em->persist($oSetting);
					$flush = $em->flush();
				}
				
				
				//==============================================================
				$key3 = "usar_imagen_de_fondo_en_recetas";
				if (in_array($key3, $arrParameter)) {
					//echo "Existe Irix";
					$RAW_QUERY = "UPDATE  cliente_ajustes SET cli_aju_valor =:value, cli_aju_fecha_mod =:date 
										where cli_aju_cli_usu_id =:cliUsuId AND cli_aju_llave =:key ";

					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->bindValue("key", $key3);
					$statement->bindValue("value", $request->request->get('bgPrescription') );
					$statement->bindValue("cliUsuId", $iClientUserId);
					$statement->bindValue("date", date("Y-m-d H:i:s"));
					$statement->execute();
				}
				else
				{
					$oSetting = new ClienteAjustes();
					$oSetting->setCliAjuLlave($key3);
					$oSetting->setCliAjuValor( $request->request->get('bgPrescription') );
					$oSetting->setCliAjuCliUsu( $oClientUserId );
					$oSetting->setCliAjuActivo(1);
					$oSetting->setCliAjuFechaCrea( new \DateTime("now"));
					$em->persist($oSetting);
					$flush = $em->flush();
				}
				
				
				//==============================================================
				$key4 = "horientacion_pdf_receta";
				if (in_array($key4, $arrParameter)) {
					//echo "Existe Irix";
					$RAW_QUERY = "UPDATE  cliente_ajustes SET cli_aju_valor =:value, cli_aju_fecha_mod =:date 
										where cli_aju_cli_usu_id =:cliUsuId AND cli_aju_llave =:key ";

					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->bindValue("key", $key4);
					$statement->bindValue("value", $request->request->get('viewPrescription') );
					$statement->bindValue("cliUsuId", $iClientUserId);
					$statement->bindValue("date", date("Y-m-d H:i:s"));
					$statement->execute();
				}
				else
				{
					$oSetting = new ClienteAjustes();
					$oSetting->setCliAjuLlave($key4);
					$oSetting->setCliAjuValor( $request->request->get('viewPrescription') );
					$oSetting->setCliAjuCliUsu( $oClientUserId );
					$oSetting->setCliAjuActivo(1);
					$oSetting->setCliAjuFechaCrea( new \DateTime("now"));
					$em->persist($oSetting);
					$flush = $em->flush();
				}
				
				
				//==============================================================
				$key5 = "logo";
				$logoImg = $request->files->get('logo');
				if( isset($logoImg) )
				{	
					$uFile = $this->get('srv_uploadFile');
					$uploadName = $uFile->startUploadFile($logoImg, $path="logos", $pre_fix=false);
					
					
					$RAW_QUERY = "SELECT * FROM cliente_ajustes 
									WHERE cli_aju_cli_usu_id = $iClientUserId
									and cli_aju_llave = '".$key5."'"; 
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->execute();
					$repo = $statement->fetchAll();
					if( count($repo) > 0 )
					{
						$current = $repo[0]['cli_aju_valor'];
						if( $current != "" )
						{
							//$current = $oldLogo;
							$uFile->deleteFile($current, $path="logos", $pre_fix=false);
							//$oUserGallery->setGalHash($upload);
						}	
					}	
					
					
					if( !empty($uploadName) )
					{
						
						if (in_array($key5, $arrParameter)) {
							//echo "Existe Irix";
							$RAW_QUERY = "UPDATE  cliente_ajustes SET cli_aju_valor =:value, cli_aju_fecha_mod =:date 
												where cli_aju_cli_usu_id =:cliUsuId AND cli_aju_llave =:key ";

							$statement = $em->getConnection()->prepare($RAW_QUERY);
							$statement->bindValue("key", $key5);
							$statement->bindValue("value", $uploadName );
							$statement->bindValue("cliUsuId", $iClientUserId);
							$statement->bindValue("date", date("Y-m-d H:i:s"));
							$statement->execute();
						}
						else
						{
							$oSetting = new ClienteAjustes();
							$oSetting->setCliAjuLlave($key5);
							$oSetting->setCliAjuValor( $uploadName );
							$oSetting->setCliAjuCliUsu( $oClientUserId );
							$oSetting->setCliAjuActivo(1);
							$oSetting->setCliAjuFechaCrea( new \DateTime("now"));
							$em->persist($oSetting);
							$flush = $em->flush();
						}
					}
				}
				
				//==============================================================
				$key6 = "vista_calendario";
				if (in_array($key6, $arrParameter)) {
					//echo "Existe Irix";
					$RAW_QUERY = "UPDATE  cliente_ajustes SET cli_aju_valor =:value, cli_aju_fecha_mod =:date 
										where cli_aju_cli_usu_id =:cliUsuId AND cli_aju_llave =:key ";

					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->bindValue("key", $key6);
					$statement->bindValue("value", $request->request->get('viewCalendar') );
					$statement->bindValue("cliUsuId", $iClientUserId);
					$statement->bindValue("date", date("Y-m-d H:i:s"));
					$statement->execute();
				}
				else
				{
					$oSetting = new ClienteAjustes();
					$oSetting->setCliAjuLlave($key6);
					$oSetting->setCliAjuValor( $request->request->get('viewCalendar') );
					$oSetting->setCliAjuCliUsu( $oClientUserId );
					$oSetting->setCliAjuActivo(1);
					$oSetting->setCliAjuFechaCrea( new \DateTime("now"));
					$em->persist($oSetting);
					$flush = $em->flush();
				}
				
				
				//var_dump($arrParameter);
				$msgBox = "Datos fueron guardados exitosamente";
				$type = "success";
			}	
			else
			{
				$msgBox = "Ha ocurrido un error inesperado";
				$type = "error";
			}
			$this->session->getFlashBag()->add($type, $msgBox);
			//$request->request->get('calMinutes');
			
		}
		
		
		return $this->redirectToRoute('ajuste_show');
		//return $this->redirectToRoute('ajuste_show', array('iarId' => $invArea->getIarid()));
		
		exit();
	}
	

}
