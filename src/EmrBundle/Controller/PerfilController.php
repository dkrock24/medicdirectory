<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\Paciente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

use Symfony\Component\HttpFoundation\Session\Session;

use \AppBundle\Entity\UsuarioEspecialidad;
use \AppBundle\Entity\UsuarioSocial;
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
		/*
		$locationId = $this->get('session')->get('locationId');
		$em = $this->getDoctrine()->getManager();
		*/
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
		
		$networkSelected = $em->getRepository('AppBundle:UsuarioSocial')->findBy( array("idUsuario"=>$userId) );
		
		
		$oUser = $em->getRepository('AppBundle:Usuario')->find( $userId );
		
		$week = array("Lun"=>"Lun","Mar"=>"Mar","Mie"=>"Mie","Jue"=>"Jue","Vie"=>"Vie","Sab"=>"Sab","Dom"=>"Dom");
		
		$daysSelected = array();
		if( $oUser->getUsuDiasTrabajo() != "" )
		{
			$daysSelected = explode(",", $oUser->getUsuDiasTrabajo() );
		}
		
		
		$oImageType = $em->getRepository('AppBundle:UsuarioGaleriaTipo')->findBy( array("usuGalTipActivo"=>1) );
		
		$schedule = unserialize($oUser->getUsuDiasTrabajo());
		
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
			"imageType"=>$oImageType
        ));
    }

	
	
	
	public function formPerfilAction( Request $request )
	{
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
		$img = $request->get('img');

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
				
				//================
				//Social Network
				//================
				$RAW_QUERY = "delete from usuario_social where id_usuario = $userId "; //2 = Cliente( Representante )
				$statement = $em->getConnection()->prepare($RAW_QUERY);
				$statement->execute();
				foreach( $social_network as $sn)
				{
					
					//$socials = $em->getRepository('AppBundle:UsuarioSocial')->findBy( array("socRedActivo"=>1) );
					//echo $sn['id']." - ".$sn['url'];
					$network = new UsuarioSocial();
					$network->setIdUsuario( $oUser );
					$oSocialNetwork = $em->getRepository('AppBundle:SocialRedes')->find( $sn['id'] );
					$network->setIdSocialRed($oSocialNetwork);
					$network->setUsuSocUrl($sn['url']);
					$em->persist($network);			
					$flush = $em->flush();
				}

				if( $oUser )
				{
					$oUser->setUsuCorreo($email);
					$oUser->setUsuTelefono($phone);
					$oUser->setUsuDireccion($address);
					$oUser->setUsuInfoPerfil($profile);
					$oUser->setUsuTitulo($title);
					
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
					if( count($schedule) > 0 )
					{
						$oUser->setUsuDiasTrabajo(serialize($schedule) );
					}else{
						$oUser->setUsuDiasTrabajo("");
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
					echo count($specialitiesList);
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
				
				//Check if is update onf file
				if( !empty($img) )
				{
					$oUserGallery = $em->getRepository('AppBundle:UsuarioGaleria')->findBy( array( "galUsuId"=> $userId ) );
					/*
					$uFile = $this->get('srv_uploadFile');
					$upload = $uFile->startUploadFile($img, $path="perfil", $pre_fix=false);
					if( $upload )
					{
						$oPatient->setPacFoto($upload);
					}
					*/
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
