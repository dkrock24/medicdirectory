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
        //$deleteForm = $this->createDeleteForm($paciente);
		
		/*
		$locationId = $this->get('session')->get('locationId');
		$em = $this->getDoctrine()->getManager();
		*/
		$em = $this->getDoctrine()->getManager();
		//$listAppointment 
		$patient = $this->get('srv_patient');
		//$listAppointment = $patient->getAppointments( $paciente->getPacId() );
		//$doctorstList = $patient->getDoctorsPerPatient( $paciente->getPacId() );
		//$medicalConsultation = $patient->getMedicalConsultation( $paciente->getPacId() );
		//$totalMedicalConsultation = $medicalConsultation[0]['total'];
		
		$specialities = $em->getRepository('AppBundle:Especialidad')->findBy( array("espActivo"=>1) );
		
		$socials = $em->getRepository('AppBundle:SocialRedes')->findBy( array("socRedActivo"=>1) );
		
		$userId = $this->getUser()->getUsuId();
		$oUser = $em->getRepository('AppBundle:Usuario')->find( $userId );
		
		//$week = array("Lun","Mar","Mie","Jue","Vie","Sab","Dom");
		$week = array("Lun"=>"Lun","Mar"=>"Mar","Mie"=>"Mie","Jue"=>"Jue","Vie"=>"Vie","Sab"=>"Sab","Dom"=>"Dom");
		
        return $this->render('EmrBundle:perfil:show.html.twig', array(
            'specialities' => $specialities,
			'socials'=>$socials,
			"week"=>$week,
			"user"=>$oUser
			//'listAppointment' => $listAppointment,
			//'totalMedicalConsultation' =>$totalMedicalConsultation,
			//'doctorstList' => $doctorstList,
            //'delete_form' => $deleteForm->createView(),
        ));
    }

	
	
	
	public function formPerfilAction( Request $request )
	{
		//exit();
		//$id = $request->get('id');
		$address = $request->get('address');
		$email = $request->get('email');
		$password = $request->get('password');
		$days = $request->get('day');
		$social_network = $request->get('social_network');
		$specialitiesList = $request->get("specialitiesList");
		$profile = $request->get('profile');
		$phone = $request->get('phone');
		$img = $request->get('img');
		
		//var_dump($specialitiesList);
		//exit();
		
		$em = $this->getDoctrine()->getManager();
		$userId = $this->getUser()->getUsuId();
		
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
		{
		
			//var_dump($social_network);

			
			//}
			
			$em->getConnection()->beginTransaction(); // suspend auto-commit
			$status = 0;
			try
			{
				//================
				//Social Network
				//================
				foreach( $social_network as $sn)
				{
					
					//$socials = $em->getRepository('AppBundle:UsuarioSocial')->findBy( array("socRedActivo"=>1) );
					//echo $sn['id']." - ".$sn['url'];
				}
				
				$oUser = $em->getRepository('AppBundle:Usuario')->find( $userId );
				
				if( $oUser )
				{
					$oUser->setUsuCorreo($email);
					$oUser->setUsuTelefono($phone);
					$oUser->setUsuDireccion($address);
					$oUser->setUsuInfoPerfil($profile);
					if( count($days) > 0)
					{
						$oUser->setUsuDiasTrabajo(implode(",", $days));
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
				$uFile = $this->get('srv_uploadFile');


				if( isset($userId) && $userId > 0 )
				{
					/*
					//throw $this->createNotFoundException('The product does not exist');
					$oPatient = $em->getRepository('AppBundle:Paciente')->findOneBy(array("pacId"=>$id));

					if( $oPatient )
					{
						$oPatient->setPacNombre($firts_name);
						$oPatient->setPacSegNombre($middle_name);
						$oPatient->setPacApellido($last_name);
						$oPatient->setPacSegApellido($middle_last_name);
						$oPatient->setPacGenero($gender);
						$oPatient->setPacDui($dui);
						$oPatient->setPacTipSangre($blood_type);
						$oPatient->setPacEmail($email);
						$oPatient->setPacEstadoCivil($civil_state);
						$oPatient->setPacMun( $municipality );
						$oPatient->setPacDireccion($address);
						$oPatient->setPacTelCasa($home_phone);
						$oPatient->setPacTelTrabajo($work_phone);
						$oPatient->setPacTelCelular($cellphone);
						$oPatient->setPacFechaNacimiento(new \Datetime($date) );
						$oPatient->setPacFechaMod(new \Datetime()); //Fecha de creacion
						$isNew = false;
						//Check if is update onf file
						if( !empty($img) )
						{
							$currentImg = $oPatient->getPacFoto();

							//$uFile->deleteFile($currentImg, $path="pacientes");

							$uFile->deleteFile($currentImg, $path="pacientes", $pre_fix=false);

						}

					}
					*/

				}
				else
				{
					/*
					$oPatient = new Paciente();
					$oPatient->setPacNombre($firts_name);
					$oPatient->setPacSegNombre($middle_name);
					$oPatient->setPacApellido($last_name);
					$oPatient->setPacSegApellido($middle_last_name);
					$oPatient->setPacGenero($gender);
					$oPatient->setPacDui($dui);
					$oPatient->setPacTipSangre($blood_type);
					$oPatient->setPacEmail($email);
					$oPatient->setPacEstadoCivil($civil_state);
					$oPatient->setPacMun( $municipality );
					$oPatient->setPacDireccion($address);
					$oPatient->setPacTelCasa($home_phone);
					$oPatient->setPacTelTrabajo($work_phone);
					$oPatient->setPacTelCelular($cellphone);
					if( !empty($date) )
					{
						$oPatient->setPacFechaNacimiento(new \Datetime($date) );
					}

					$oPatient->setPacFechaCrea(new \Datetime()); //Fecha de creacion
					$iLocationId = $this->get('session')->get('locationId');
					$iLocationObj = $em->getRepository("AppBundle:Cliente")->find($iLocationId);
					$oPatient->setPacCli( $iLocationObj );

					$isNew = true;
					*/
				}

				/*
				if( !empty($img) )
				{
					$upload = $uFile->startUploadFile($img, $path="pacientes", $pre_fix=false);
					if( $upload )
					{
						$oPatient->setPacFoto($upload);
					}
				}

				$em->persist($oPatient);			
				$flush = $em->flush();
				if ($flush == null)
				{
					//$status = 1; 
					//success

					if( isset($isNew) && $isNew == true )
					{
						$status = $oPatient->getPacId(); //new 
					}else{
						$status = 1;  // is update
					}


				}else{
					$status = 0; //error
				}
				*/
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
