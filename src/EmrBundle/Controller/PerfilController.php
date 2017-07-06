<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\Paciente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

use Symfony\Component\HttpFoundation\Session\Session;

use \AppBundle\Entity\UsuarioEspecialidad;
use \AppBundle\Entity\UsuarioSocial;

use \AppBundle\Entity\UsuarioGaleria;
/**
 * Paciente controller.
 *
 */
class PerfilController extends Controller
{
	
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	

    /**
     * Finds and displays a paciente entity.
     *
     */
    public function showAction(Request $request)
    {		
		
		//$ext = $this->get('app.file.twig.extension');
		//echo $ext->prueba();
		//echo "servicio";
		/*
		
		$em = $this->getDoctrine()->getManager();
		*/
		
		$roles = $this->get('session')->get('userRoles');
		
		$locationId = $this->get('session')->get('locationId');
		//echo $locationId."---";
		//exit();
		$em = $this->getDoctrine()->getManager();
		$userId = $this->getUser()->getUsuId();
		//$listAppointment 
		$patient = $this->get('srv_patient');
		//$listAppointment = $patient->getAppointments( $paciente->getPacId() );
		//$doctorstList = $patient->getDoctorsPerPatient( $paciente->getPacId() );
		//$medicalConsultation = $patient->getMedicalConsultation( $paciente->getPacId() );
		//$totalMedicalConsultation = $medicalConsultation[0]['total'];
		
		$specialities = $em->getRepository('AppBundle:Especialidad')->findBy( array("espActivo"=>1) );
		
		$oUserSpeciality = $em->getRepository('AppBundle:UsuarioEspecialidad')->findBy( array("idUsuario"=>$userId) );
		
		$specialitiesSelected = array();
		if ( count($oUserSpeciality) )
		{
			foreach( $oUserSpeciality as $esp )
			{
				$specialitiesSelected[] = $esp->getIdEspecialidad()->getEspId();
				//echo $esp->getIdEspecialidad()->getEspId();
			}
		}		
		$socials = $em->getRepository('AppBundle:SocialRedes')->findBy( array("socRedActivo"=>1) );
		
		//ECHO $locationId;
		
		$oClientUser = $em->getRepository('AppBundle:ClienteUsuario')->findBy( array( "cliUsuUsu"=> $userId, "cliUsuCli"=>$locationId, "cliUsuActivo"=>1,"cliUsuRol"=>array(3,6) ) ); //6=medico
		if( !$oClientUser )
		{
			$msg = "Para editar tú perfil antes debes de inicar la administración de un establecimiento";
			$this->session->getFlashBag()->add("error", $msg);
			return $this->redirectToRoute('emr_location');
		}
		$networkSelected = $em->getRepository('AppBundle:UsuarioSocial')->findBy( array("idUsuario"=>$oClientUser[0]->getCliUsuId() ) );
		
		//ECHO $oClientUser[0]->getCliUsuId()."--";
		//ECHO COUNT($networkSelected);
		//$oUser = $em->getRepository('AppBundle:Usuario')->find( $userId );
		
		//$oClientUser = $em->getRepository('AppBundle:ClienteUsuario')->findBy( array("cliUsuCli"=>$locationId, "cliUsuUsu"=>$userId) );
		
		//$orderBy = " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."";
		$RAW_QUERY = "SELECT * FROM cliente_usuario cu INNER JOIN usuario u ON cu.cli_usu_usu_id = u.usu_id WHERE cu.cli_usu_cli_id = $locationId AND cu.cli_usu_usu_id = $userId and cu.cli_usu_rol_id IN (3,6) AND cu.cli_usu_activo = 1 ";
		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		$oUser = $statement->fetchAll();
		
		if( count($oUser) == 0 )
		{
			throw new AccessDeniedException('Lo sentimos tu no tienes rol de médico y/o asistente o tu cuenta ya no esta activa.');
		}
		
		//var_dump($oUser);
		
		$week = array("Lun"=>"Lun","Mar"=>"Mar","Mie"=>"Mie","Jue"=>"Jue","Vie"=>"Vie","Sab"=>"Sab","Dom"=>"Dom");
		
		$daysSelected = array();
		//if( $oClientUser[0]->getCliUsuDiasTrabajo() != "" )
		if( $oUser[0]['cli_usu_dias_trabajos'] != "" )	
		{
			$daysSelected = explode(",", $oUser[0]['cli_usu_dias_trabajos']/*$oClientUser[0]->getCliUsuDiasTrabajo()*/ );
		}
		
		
		$oImageType = $em->getRepository('AppBundle:UsuarioGaleriaTipo')->findBy( array("usuGalTipActivo"=>1) );
		
		$schedule = unserialize($oUser[0]['cli_usu_dias_trabajos']/*$oClientUser[0]->getCliUsuDiasTrabajo()*/);
		
		
		$oUserGallery = $em->getRepository('AppBundle:UsuarioGaleria')->findBy( array( "galUsuario"=> $userId,"galCliente"=> $locationId), array(
                'galTipo' => 'ASC'
            ) );
		//var_dump($schedule);
		//echo "<hr>";
		//{{ user.UsuCorreo }}
		
		
		/*
		$days = array();
		foreach($schedule as $item => $value)
		{

			echo $item;
			for($h=0; $h < count($value); $h++)
			{
				echo $value[$h]."<br>";
			}
			echo "<hr>";
			
		}
		*/
		
        return $this->render('EmrBundle:perfil:show.html.twig', array(
            'specialities' => $specialities,
			"specialitiesSelected"=>$specialitiesSelected,
			'socials'=>$socials,
			"networkSelected"=>$networkSelected,
			"week"=>$week,
			"schedule"=>$schedule,
			"daysDelected"=>$daysSelected,
			"user"=>$oUser,
			"userGallery"=>$oUserGallery,
			"imageType"=>$oImageType,
			"roles"=>$roles
        ));
    }

	
	
	
	public function formPerfilAction( Request $request )
	{
		$locationId = $this->get('session')->get('locationId');
		//exit();
		//$id = $request->get('id');
		$address = $request->get('address');
		$email = $request->get('email');
		$password = $request->get('password');
		$title = $request->get("title");
		//$days = $request->get('day');
		$schedule = $request->get("schedule");
		$social_network = $request->get('social_network');
		$specialitiesList = $request->get("specialitiesList");
		$profile = $request->get('profile');
		$phone = $request->get('phone');
		$typeImage = $request->get("typeImage");
		$img = $request->get('img');
		
		$galleryDeleteList = $request->get("galleryDeleteList");
		$galleryDeleteList = json_decode($galleryDeleteList, true);
		//var_dump($galleryDeleteList);
		
		$file1 = $request->files->get('file1');
		$file2 = $request->files->get('file2');
		$file3 = $request->files->get('file3');
		$file4 = $request->files->get('file4');
		$file5 = $request->files->get('file5');
		
		//echo "imagen.".$file1;
		
		$arrImages = array();
		$arrImages[] = $file1;
		$arrImages[] = $file2;
		$arrImages[] = $file3;
		$arrImages[] = $file4;
		$arrImages[] = $file5;
		//var_dump($schedule);
		
		//exit();
		$em = $this->getDoctrine()->getManager();
		$userId = $this->getUser()->getUsuId();
		
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
		{

			$em->getConnection()->beginTransaction(); // suspend auto-commit
			$status = 0;
			try
			{
				$oUser = $em->getRepository('AppBundle:Usuario')->find( $userId );
				
				$oClientUser = $em->getRepository('AppBundle:ClienteUsuario')->findBy( array( "cliUsuUsu"=> $userId, "cliUsuCli"=>$locationId, "cliUsuRol"=>array(3,6) ) );
				//================
				//Social Network
				//================
				$RAW_QUERY = "delete from usuario_social where id_usuario = ".$oClientUser[0]->getCliUsuId()." "; //2 = Cliente( Representante )
				$statement = $em->getConnection()->prepare($RAW_QUERY);
				$statement->execute();
				
				$social_network = json_decode($social_network, true);
				if( count($social_network) > 0 )
				{
					foreach( $social_network as $sn)
					{

						//$socials = $em->getRepository('AppBundle:UsuarioSocial')->findBy( array("socRedActivo"=>1) );
						//echo $sn['id']." - ".$sn['url'];
						$network = new UsuarioSocial();
						$orepoClientUser = $em->getRepository('AppBundle:ClienteUsuario')->find( $oClientUser[0]->getCliUsuId() );
						$network->setIdUsuario( $orepoClientUser );
						$oSocialNetwork = $em->getRepository('AppBundle:SocialRedes')->find( $sn['id'] );
						$network->setIdSocialRed($oSocialNetwork);
						$network->setUsuSocUrl($sn['url']);
						$em->persist($network);			
						$flush = $em->flush();
					}
				}
				if( $oClientUser )
				{
					$oClientUser[0]->setCliUsuCorreo($email);
					$oClientUser[0]->setCliUsuTelefono($phone);
					$oClientUser[0]->setCliUsuDireccion($address);
					$oClientUser[0]->setCliUsuInfoPerfil($profile);
					$oClientUser[0]->setCliUsuTitulo($title);
					
					if( !empty($password) )
					{
						$oUser->setUsuClave( sha1($password) );
					}
					/*
					if( count($days) > 0)
					{
						$oUser->setUsuDiasTrabajo(implode(",", $days));
					}
					*/
					$schedule = json_decode($schedule, true);
					if( count($schedule) > 0 )
					{
						$oClientUser[0]->setCliUsuDiasTrabajo(serialize($schedule) );
					}else{
						$oClientUser[0]->setCliUsuDiasTrabajo("");
					}
					
					$em->persist($oUser);			
					$flush = $em->flush();
					if ($flush == null)
					{
						//$status = 1; 
						//success
						
					}
					
					
					$RAW_QUERY = "delete from usuario_especialidad where id_usuario = $userId "; //2 = Cliente( Representante )
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->execute();   
					//echo count($specialitiesList);
					$specialitiesList = json_decode($specialitiesList, true);
					if( count($specialitiesList) > 0 )
					{
						for( $i = 0; $i < count($specialitiesList); $i++)
						{
							$item = new UsuarioEspecialidad();
							echo $idSpe = $specialitiesList[$i];
							$spe = $em->getRepository('AppBundle:Especialidad')->find( $idSpe );
							$item->setIdEspecialidad($spe);
							$user = $em->getRepository('AppBundle:Usuario')->find( $userId );
							$item->setIdUsuario( $user );
							$em->persist($item);			
							$flush = $em->flush();
						}
					}
					
				}
				
				$status = 1;  
				//Call the service to upload file
				//Profile image
				//Check if is update onf file
				$uFile = $this->get('srv_uploadFile');
				if( !empty($img) )
				{
					$oUserGallery = $em->getRepository('AppBundle:UsuarioGaleria')->findOneBy( array( "galUsuario"=> $userId,"galCliente"=> $locationId) );
					
					
					$upload = $uFile->startUploadFile($img, $path="perfil", $pre_fix=false);
					if( !$oUserGallery )
					{
						$oUserGallery = new UsuarioGaleria();
						$oUserGallery->setGalHash($upload);
						$oUserGallery->setGalFechaCrea(new \DateTime());
						
						$oClient = $em->getRepository('AppBundle:Cliente')->find( $locationId );
						$oUserGallery->setGalCliente($oClient);
						
						$oUser = $em->getRepository('AppBundle:Usuario')->find( $userId );
						$oUserGallery->setGalUsuario($oUser);
						
						$oGalleryType = $em->getRepository('AppBundle:UsuarioGaleriaTipo')->find( $typeImage );
						$oUserGallery->setGalTipo($oGalleryType);
						
					}
					else
					{
						$current = $oUserGallery->getGalHash();
						$uFile->deleteFile($current, $path="perfil", $pre_fix=false);
						$oUserGallery->setGalHash($upload);
					}
					
					$em->persist($oUserGallery);			
					$flush = $em->flush();
					
				}
				
				for($i=0; $i < count($arrImages); $i++)
				{
					$img = $arrImages[$i];
					if( !empty($img) )
					{
						$upload = $uFile->startUploadFile($img, $path="otras", $pre_fix=false);
						
						$oUserGallery = new UsuarioGaleria();
						$oUserGallery->setGalHash($upload);
						$oUserGallery->setGalFechaCrea(new \DateTime());
						
						$oClient = $em->getRepository('AppBundle:Cliente')->find( $locationId );
						$oUserGallery->setGalCliente($oClient);
						
						$oUser = $em->getRepository('AppBundle:Usuario')->find( $userId );
						$oUserGallery->setGalUsuario($oUser);
						
						$oGalleryType = $em->getRepository('AppBundle:UsuarioGaleriaTipo')->find( $typeImage );
						$oUserGallery->setGalTipo($oGalleryType);
						$em->persist($oUserGallery);			
						$flush = $em->flush();
						
					}
				}
				
				if( count($galleryDeleteList) > 0 )
				{
					$RAW_QUERY = "SELECT * FROM usuario_galeria WHERE gal_id in (".implode(",", $galleryDeleteList).") AND gal_usu_id = $userId "; 
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					//$statement->bindValue("client", $clientId );
					$statement->execute();
					$getList = $statement->fetchAll();
					
					if( count($getList) > 0 )
					{
						foreach($getList as $item)
						{
							if($item['gal_tipo'] == 1)
							{
								$path="perfil";
							}
							else
							{
								$path="otras";
							}
							
							$uFile->deleteFile($item['gal_hash'], $path, $pre_fix=false);
						}
						
						
						$RAW_QUERY = "delete from usuario_galeria  WHERE gal_id in (".implode(",", $galleryDeleteList).") AND gal_usu_id = $userId "; 
						$statement = $em->getConnection()->prepare($RAW_QUERY);
						$statement->execute();
						
					}
					
				}
				
				
				if( !empty($password) && !empty($email) )
				{
					$templateEmail = "cambio_password";
					$username = $this->getUser()->getUsuUsuario();
					$this->sendMessage($templateEmail, $username, $password, $to = $email, $trom = false);
				}
				

				$msg = "Registro actualizado con éxito";
				$this->session->getFlashBag()->add("success", $msg);
				$em->getConnection()->commit();
			}
			catch (\Exception $e)
			{
				$em->getConnection()->rollBack();
				throw $e;
				//echo ($e->getMessage());
			}
		
		}
		echo $status;
		exit();
		
	}
	
	public function sendMessage($typeTemplate, $username, $password, $to, $trom=false)
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
			$variables['password'] = $password;

			$srvParameter = $this->get('srv_parameters');
			$link_sistema = $srvParameter->getParametro("link_sistema", $default_return_value = "");

			$variables['link'] = $link_sistema;

			//$para = "gialvarezlopez@gmail.com";
			$res = $srvMail->enviarCorreo ($plantilla, $variables, $to, $de = '') ;
		}
		
	}
	
	public function savePicture($img)
	{
		
		//$uFile = $this->get('srv_uploadFile');	
		
		$finder = new Finder();
		$finder->files()->in(__DIR__);

		foreach ($finder as $file) {
			// Dump the absolute path
			var_dump($file->getRealPath());

			// Dump the relative path to the file, omitting the filename
			var_dump($file->getRelativePath());

			// Dump the relative path to the file
			var_dump($file->getRelativePathname());
			
			
		}
		
		/*
		$fs = new Filesystem();
		//$file_name=time().".".$ext;
		//$fs->move("uploads",$file_name);
		
		try {
			$fs->mkdir('/tmp/random/dir/'.mt_rand());
		} catch (IOExceptionInterface $e) {
			echo "An error occurred while creating your directory at ".$e->getPath();
		}
		*/
		/*
			$filename = "test.png";
			$img = $_POST['img'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			file_put_contents("images/".$filename, $data);
		 */
	}
}
