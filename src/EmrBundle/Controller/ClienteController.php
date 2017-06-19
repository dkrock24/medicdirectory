<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Session\Session;

use \AppBundle\Entity\Usuario;
use \AppBundle\Entity\Rol;
use \AppBundle\Entity\ClienteUsuario;
//use \AppBundle\Entity\UsuariosRol;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	
	
    /**
     * Lists all cliente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clientes = $em->getRepository('AppBundle:Cliente')->findAll();

        return $this->render('EmrBundle:cliente:index.html.twig', array(
            'clientes' => $clientes,
        ));
    }

    /**
     * Creates a new cliente entity.
     *
     */
    public function newAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		//die();
		$location = $request->get("id");
		//$idUser =  $this->getUser()->getUsuId();
		
		$addToUser = false;
		if( isset($location)  )
		{
			if( $location == "myself" )
			{
				$securityContext = $this->container->get('security.authorization_checker');
				if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
				{
					
					$idUser =  $this->getUser()->getUsuId();
					
					$location_repo = $em->getRepository("AppBundle:Cliente")->find($location);
					//if( $location_repo )
					if( $idUser )	
					{
						/*
							$RAW_QUERY = "SELECT * FROM cliente_usuario 

									WHERE cli_usu_cli_id =:client
									and cli_usu_usu_id =:idUser "; //5 = Cliente( Representante )

							$statement = $em->getConnection()->prepare($RAW_QUERY);
							$statement->bindValue("client", $location );
							$statement->bindValue("idUser", $idUser );
							$statement->execute();
							$getUsers = $statement->fetchAll();

							if( count($getUsers) > 0)
							{
								//==========================
								//Set the session 
								//==========================
								$idUser =  $this->getUser()->getUsuId();
								$srvSession = $this->get('srv_session');
								$res = $srvSession->setSessionLocation( $idUser, $location );
								$addToUser = true;
							}
							else
							{
								return $this->redirectToRoute("emr_location");
							}
						*/
						$addToUser = true;
						
					}
					else
					{
						return $this->redirectToRoute("emr_location");
					}
					
				}
				else
				{
					return $this->redirectToRoute("emr_location");
				}
			}
			else
			{
				return $this->redirectToRoute("emr_location");
			}
			
		}
		
		
        $cliente = new Cliente();
        $form = $this->createForm('EmrBundle\Form\ClienteType', $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush($cliente);

            return $this->redirectToRoute('cliente_show', array('id' => $cliente->getCliId()));
        }
		
		$methodPay = $em->getRepository('AppBundle:MetodoPago')->findBy( array("mepActivo"=>1) );
		
		if( $addToUser )
		{
			$addLocationToUser = $em->getRepository("AppBundle:Usuario")->find($idUser);
		}
		else
		{
			$addLocationToUser = "";
		}
		

        return $this->render('EmrBundle:cliente:new.html.twig', array(
            'cliente' => $cliente,
			'addLocationToUser'=>$addLocationToUser,
			'methodPay'=> $methodPay,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cliente entity.
     *
     */
    public function showAction(Cliente $cliente)
    {
        $deleteForm = $this->createDeleteForm($cliente);

        return $this->render('EmrBundle:cliente:show.html.twig', array(
            'cliente' => $cliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cliente entity.
     *
     */
    public function editAction(Request $request, Cliente $cliente)
    {
		

		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
		{
			
			$em = $this->getDoctrine()->getManager();
			
			
			$idUser =  $this->getUser()->getUsuId();
			
			//echo $cliente->getCliId();
			//==================================================================
			//Check if the user if a representer 
			//==================================================================
			$RAW_QUERY = "SELECT * FROM cliente_usuario 
							WHERE cli_usu_cli_id =:client
							and cli_usu_usu_id =:userId
							and cli_usu_rol_id = 2 "; //5 = Cliente( Representante )
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("client", $cliente->getCliId() );
			$statement->bindValue("userId", $idUser );
			$statement->execute();
			$isRepresenter = $statement->fetchAll();
			if( count($isRepresenter) == 0 )
			{
				return $this->redirectToRoute("emr_location");
			}
			
		
			$deleteForm = $this->createDeleteForm($cliente);
			$editForm = $this->createForm('EmrBundle\Form\ClienteType', $cliente);
			$editForm->handleRequest($request);

			if ($editForm->isSubmitted() && $editForm->isValid()) {
				$this->getDoctrine()->getManager()->flush();

				return $this->redirectToRoute('cliente_edit', array('id' => $cliente->getCliId()));
			}

			$methodPay = $em->getRepository('AppBundle:MetodoPago')->findBy( array("mepActivo"=>1) );
			
			//==========================
			//Set the session 
			//==========================
			
			$srvSession = $this->get('srv_session');
			$res = $srvSession->setSessionLocation( $idUser, $cliente->getCliId() );
			
			//==================================================================
			//Get the person data who is the representer 
			//==================================================================
			$RAW_QUERY = "SELECT * FROM cliente_usuario cu 
							inner join usuario u on u.usu_id = cu.cli_usu_usu_id
							WHERE cu.cli_usu_cli_id =:client
							and cu.cli_usu_rol_id = 2 "; //5 = Cliente( Representante )
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("client", $cliente->getCliId() );
			$statement->execute();
			$getUserRepresenter = $statement->fetchAll();
			//echo count($getUsersLocations);
			
			//==================================================================
			//Get users than are not representers only doctors and assistant
			//==================================================================
			/*
			$RAW_QUERY = "SELECT * FROM cliente_usuario cu 
							inner join usuario u on u.usu_id = cu.cli_usu_usu_id
							inner join usuarios_rol ur on ur.urol_usu_id = u.usu_id 
							WHERE cu.cli_usu_cli_id =:client
							and ur.urol_rol_id != 2 "; //2 = Cliente( Representante )
							*/
			$RAW_QUERY = "SELECT *
								FROM cliente_usuario cu
								INNER JOIN usuario u ON u.usu_id = cu.cli_usu_usu_id
								
								WHERE cu.cli_usu_cli_id  =:client AND cu.cli_usu_rol_id != 2 AND cu.cli_usu_activo = 1
								#GROUP BY cu.cli_usu_rol_id";				
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("client", $cliente->getCliId() );
			$statement->execute();
			$getUsersLocation = $statement->fetchAll();
			
			//echo $cliente->getCliId();
			//var_dump($getUsersLocation);
			//==================================================================
			//Get if the representer marked the checkbox as set representer date
			//as doctor or assistant
			//==================================================================
			$RAW_QUERY = "SELECT * FROM cliente_usuario WHERE cli_usu_usu_id =:idUser
							and cli_usu_rol_id != 2 "; //2 = Cliente( Representante )
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("idUser", $idUser );
			$statement->execute();
			$resDoctorOrAssistant = $statement->fetchAll();
			$representerIsDoctorOrAssistant = count($resDoctorOrAssistant);
			
			//==================================================================
			//Get current payment
			//==================================================================
			$RAW_QUERY = " SELECT cli_metodo_pago_id, cli_pago_detalle FROM cliente WHERE cli_id =:clientId ";
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("clientId", $cliente->getCliId() );
			$statement->execute();
			$currentPayment = $statement->fetchAll();
			
			$detail_payment = $currentPayment[0]['cli_pago_detalle'];
			$exp = "";
			$cvc = "";
			$creditCardInfo = "";
			$brand = "";
			if( !empty($detail_payment) )
			{
				
				$creditCard = unserialize($detail_payment);
				$number = @$creditCard['creaditcard']['number'];
				$exp = @$creditCard['creaditcard']['exp'];
				$cvc = @$creditCard['creaditcard']['cvc'];
				$brand = @$creditCard['creaditcard']['brand'];
				$creditCardInfo = $this->ccMasking($number, $maskingCharacter = '*');
			}
			
			//exit();
			
			return $this->render('EmrBundle:cliente:edit.html.twig', array(
				'cliente' => $cliente,
				'id'=>$cliente->getCliId(),
				'edit_form' => $editForm->createView(),
				'methodPay'=> $methodPay,
				'currentPayment' => $currentPayment,
				'creditCard' => $creditCardInfo,
				'exp'=>$exp,
				'cvc'=>$cvc,
				'brand'=>$brand,
				'getUserRepresenter'=>$getUserRepresenter,
				'getUsersLocation'=>$getUsersLocation,
				'representerIsDoctorOrAssistant' => $representerIsDoctorOrAssistant,
				'delete_form' => $deleteForm->createView(),
			));

		}
		else
		{
			return $this->redirectToRoute("login");
		}
        
    }
	
	function ccMasking($number, $maskingCharacter = 'X') {
		return substr($number, 0, 4) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
	}

    /**
     * Deletes a cliente entity.
     *
     */
    public function deleteAction(Request $request, Cliente $cliente)
    {
        $form = $this->createDeleteForm($cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cliente);
            $em->flush();
        }

        return $this->redirectToRoute('cliente_index');
    }

    /**
     * Creates a form to delete a cliente entity.
     *
     * @param Cliente $cliente The cliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cliente $cliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cliente_delete', array('id' => $cliente->getCliId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
	
	
	//Starts customs actions
	public function checkAvailableUserAction( Request $request )
	{
		
		//exit();
		//$result = "";
		//$iCountryId = $request->get('id');
		$sUsername = $request->get("username");
		
		$res = array();
		try
		{
			
			if( isset($sUsername) && !empty($sUsername) ) 
			{
				$em = $this->getDoctrine()->getManager();
				$RAW_QUERY = "SELECT * FROM usuario u WHERE usu_usuario =:username";

				$statement = $em->getConnection()->prepare($RAW_QUERY);
				$statement->bindValue("username", $sUsername);
				$statement->execute();
				$result = $statement->fetchAll();
			}

			if( count($result) == 0 )
			{
				$available = 1; //is available
				$email = "";
				$gender = "";
			}
			else
			{
				$available = 0; //in not available
				
				$email = "";//$result[0]['usu_correo'];
				$gender = $result[0]['usu_genero'];
				//$email =  $this->hide_mail( $email );
			}
			
			
			$res = array("available"=> $available, "email"=>$email, "gender"=>$gender );
			//var_dump($res);
		}
		catch (\Exception $e){
				echo ($e->getMessage());
		}		
		
		return  $response = new JsonResponse(($res));
		//$response->headers->set('Content-Type', 'application/json');

		//return $response;
		//exit();

	}
	
	function hide_mail($email) {
		$mail_part = explode("@", $email);
		//$mail_part[0] = str_repeat("*", strlen($mail_part[0]));
		
		$str_length = strlen($mail_part[0]);
		$str = $mail_part[0];
		$str_length = strlen($str);
		$mail_part[0] = substr($str, 0, 1).str_repeat('*', $str_length - 2).substr($str, $str_length - 1, 1);
		
		return implode("@", $mail_part);
	}
	
	
	public function validFormAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		
		/*
			$objUserRol = new UsuariosRol();
		
			$objUserRol->setUsuRolUsuarios( 2 );
			$objUserRol->setUsuRolClientes( 3 );
			$objUserRol->setUsuRolRols(2);
			//$objUserRol->set
			$em->persist($objUserRol);
			$flush = $em->flush();
		
		exit("xxxx");
		*/
		//exit("xxxx");
		//Location data
		$clientId = $request->get("id");
		
		$location = $request->get("location");
		$fiscal_name = $request->get("fiscal_name");
		$municipality = $request->get("municipality");
		$address = $request->get("address");
		$locationNit = $request->get("locationNit");
		$phone_one = $request->get("phone_one");
		$phone_two = $request->get("phone_two");
		$specialities = $request->get("specialities");
		//$representerName = $request->get("representerName");
		
		$representerNameOne = $request->get("representerNameOne");
		$representerNameTwo = $request->get("representerNameTwo");
		$representerNameThree = $request->get("representerNameThree");
		$representerLastNameOne = $request->get("representerLastNameOne");
		$representerLastNameTwo = $request->get("representerLastNameTwo");
		
		
		$comercial_name = $request->get("comercial_name");
		$lon = $request->get("lon");
		$lat = $request->get("lat");
		
		//Representer data
		$representerGender = $request->get("representerGender");
		$representerUser = $request->get("representerUser");
		$representerEmail = $request->get("representerEmail");
		$representerPass = $request->get("representerPass");
		$representerBirthDate = $request->get("representerBirthDate");
		
		//Location List users 
		$locationListUsers = $request->get("locationUsers");
		
		//Payment method
		$payMethod = $request->get("payMethod");
		
		//Credit card data
		//$credirCard = $request->get("credirCard");
		$representer_cc_number = $request->get("representer_cc_number");
		$representer_cc_exp = $request->get("representer_cc_exp");
		$representer_cc_cvc = $request->get("representer_cc_cvc");
		$representer_cc_brand = $request->get("representer_cc_brand");
		
		$payment = false;
		if( ($representer_cc_number != "" ) && ($representer_cc_exp != "") && ($representer_cc_cvc !="") )
		{
			
				$payment = array(
					"creaditcard" => array(
									"brand"=>$representer_cc_brand,
									"number"=>$representer_cc_number, 
									"exp"=>$representer_cc_exp, 
									"cvc"=>$representer_cc_cvc
						) 
				);
			
		}
		
		
		$addToUser = $request->get("addToUser");
		
		$em->getConnection()->beginTransaction(); // suspend auto-commit
		try
		{
			//================================================================================================================
			// Starts client register
			//================================================================================================================
			if (isset($clientId) && $clientId > 0) {
				$client = $em->getRepository('AppBundle:Cliente')->find($clientId);
			} else {
				$client = new Cliente();
			}

			$oMunicipality = $em->getRepository('AppBundle:Municipio')->find($municipality);

			$oTypeCliente = $em->getRepository('AppBundle:TipoCliente')->find($location);

			$client->setCliTipCli($oTypeCliente);
			$client->setCliMun($oMunicipality);
			$client->setCliDireccion($address);
			$client->setCliNit($locationNit);
			$client->setCliNombreFiscal($fiscal_name);

			$client->setCliTelefono1($phone_one);
			$client->setCliTelefono2($phone_two);
			//$client->setCliNombre($representerName);
			
			$client->setCliNombreComercial($comercial_name);
			$client->setCliUbicacionLat($lat);
			$client->setCliUbicacionLon($lon);
			
			$oPayMethod_repo = $em->getRepository('AppBundle:MetodoPago')->find($payMethod);
			$client->setCliMetodoPago( $oPayMethod_repo );
			
			if( $payment != false )
			{
				$client->setCliPagoDetalle(serialize($payment));
			}else{
				if( $payMethod != 2 ) //It's not Credit card
				{
					$client->setCliPagoDetalle("");
				}
				
			}
			$client->setCliFechaRegistro(new \Datetime() );
			$client->setCliFechaCrea(new \Datetime() );
				
			//Save all $specialities to this establashment
			if( count($specialities) > 0 )
			{
				if (isset($clientId) && $clientId > 0) 
				{
					$RAW_QUERY = " delete from cliente_especialidad where id_cliente = $clientId ";
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->execute();
				}
				
				for(	$i=0; $i < count($specialities); $i++ )
				{
					$spe_repo = $em->getRepository('AppBundle:Especialidad')->find($specialities[$i]);
					//$client->addEspid($spe_repo);
					$client->addIdEspecialidad($spe_repo);
				}
			}
			$em->persist($client);
			$flush = $em->flush();
			$lastClient = $client->getCliId();
			//================================================================================================================
			// Ends client register
			//================================================================================================================
			
				
			//================================================================================================================
			//Save presenter's data as user in table usuario
			//================================================================================================================
			if (isset($clientId) && $clientId > 0) 
			{
				$oRepresenter = $em->getRepository('AppBundle:Usuario')->findOneBy( array( "usuUsuario"=>$representerUser ) );
			}
			else
			{
				//if it a existent user to add new location
				if( isset($addToUser) && $addToUser > 0 ) 
				{
					$oRepresenter = $em->getRepository('AppBundle:Usuario')->findOneBy( array( "usuId"=>$addToUser ) );
				}
				else
				{
					$oRepresenter = new Usuario();
				}
				
				//$oRepresenter = new Usuario();
			}
			
			if( !empty($representerPass) )
			{
				if( isset($addToUser) && $addToUser > 0 )
				{
					
				}
				else
				{
					$oRepresenter->setUsuClave( sha1($representerPass) );

				}
				
				
				//$oRepresenter->setUsuClave( sha1($representerPass) );
			}
			
			
			$oRepresenter->setUsuGenero($representerGender);
			$oRepresenter->setUsuUsuario($representerUser);			
			$oRepresenter->setUsuNombre($representerNameOne);
			$oRepresenter->setUsuSegundoNombre($representerNameTwo);
			$oRepresenter->setUsuTercerNombre($representerNameThree);
			$oRepresenter->setUsuPrimerApellido($representerLastNameOne);
			$oRepresenter->setUsuSegundoApellido($representerLastNameTwo);

			
			if (isset($clientId) && $clientId > 0) 
			{
				$RAW_QUERY = "SELECT cu.cli_usu_rol_id, cu.cli_usu_rol_id as iduser, u.usu_usuario  FROM cliente_usuario cu 
								inner join usuario u on u.usu_id = cu.cli_usu_usu_id
								WHERE cu.cli_usu_cli_id =:client AND cu.cli_usu_rol_id != 2
							"; // 2 = cliente = representante
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->bindValue("client", $clientId );
					$statement->execute();
					$getUserList = $statement->fetchAll();
				//$deleteList = array();
				$userListDB = array();
				if( count($getUserList) )
				{
					foreach($getUserList as $k)
					{
						array_push($userListDB, $k['usu_usuario']);
					}
					/*
						if( count($deleteList) )
						{
							$RAW_QUERY = "delete from cliente_usuario where cli_usu_usu_id in (".  implode(",", $deleteList).") AND cli_usu_cli_id =  $clientId "; //2 = Cliente( Representante )
							$statement = $em->getConnection()->prepare($RAW_QUERY);
							$statement->execute();
						}
					*/
				}
			}
			
			$em->persist($oRepresenter);
			$flush = $em->flush();
			$lastRepresenter = $oRepresenter->getUsuId();	
			
			$role_representer_repo = $em->getRepository('AppBundle:Rol')->find(2); //2 = Cliente( Representante )

			$client_repo = $em->getRepository('AppBundle:Cliente')->find($lastClient); // = Cliente( Representante )
	
			$representer_repo = $em->getRepository("AppBundle:Usuario")->find($lastRepresenter);
			
			/*
			if (isset($clientId) && $clientId > 0) 
			{
				$RAW_QUERY = "delete from cliente_usuario where cli_usu_cli_id = $clientId ";
				$statement = $em->getConnection()->prepare($RAW_QUERY);
				$statement->execute();
			}
			*/
			
			//Check if exist the representer in table cliente_usuario
			$resUserRepresenter =  $this->checkExistUser($representerUser);
			if( $resUserRepresenter )
			{
				if( count($resUserRepresenter) > 0 )
				{
					$resUserRepresenter->getUsuId();
					
					$objUserRol = $em->getRepository("AppBundle:ClienteUsuario")->findOneBy( array( "cliUsuUsu"=> $resUserRepresenter->getUsuId(), "cliUsuRol"=>2 ) );
					
					if( !$objUserRol )
					{
						$objUserRol = new ClienteUsuario();
					}
				}
				else
				{
					$objUserRol = new ClienteUsuario();
				}
				
				//Send email notification
				if( !empty($representerPass) )
				{	
					if (isset($clientId) && $clientId > 0)
					{
						//Send email notification to representer
						$this->sendMessage("cambio_password", $representerUser, $representerPass, $to=$representerEmail,$trom=false);
					}
					else
					{
						//Send email notification to representer
						$this->sendMessage("nuevo_usuario", $representerUser, $representerPass, $to=$representerEmail,$trom=false);
					}
				}
				$objUserRol->setCliUsuUsu($representer_repo); //setUsuRolUsuarios(  $representer_repo );
				$objUserRol->setCliUsuCli($client_repo);
				$objUserRol->setCliUsuRol( $role_representer_repo );
				$objUserRol->setCliUsuFechaNacimiento( new \DateTime($representerBirthDate) );
				$objUserRol->setCliUsuFechaRegistro(new \Datetime());
				$objUserRol->setCliUsuCorreo($representerEmail);
				$objUserRol->setCliUsuFechaCrea( new \DateTime() );

				$em->persist($objUserRol);
				$flush = $em->flush();
			}
			
			
			
			
				
			//Save all users related for this location establishment
			$currentList = array();
			if( count($locationListUsers) > 0 )
			{
				
				for($i=0; $i < count($locationListUsers); $i++)
				{
						
					if( $locationListUsers[$i]['username'] != $representerUser )
					{
						//========================================
						//Save all users except the representer 
						//========================================

						//Check if exists or is new in module edit, if not exists then the represented added a new user
						$is_new = false;
						$user = $em->getRepository('AppBundle:Usuario')->findOneBy( array( "usuUsuario"=>$locationListUsers[$i]['username'] ) );
						if( !$user )
						{
							$user = new Usuario();
							$is_new = true;
						}

						if( isset($locationListUsers[$i]['nameone']) && !empty($locationListUsers[$i]['nameone']) )
						{
							$user->setUsuNombre($locationListUsers[$i]['nameone']);
						}
						if( isset($locationListUsers[$i]['nametwo']) && !empty($locationListUsers[$i]['nametwo']) )
						{
							$user->setUsuSegundoNombre($locationListUsers[$i]['nametwo']);
						}
						if( isset($locationListUsers[$i]['namethree']) && !empty($locationListUsers[$i]['namethree']) )
						{
							$user->setUsuTercerNombre($locationListUsers[$i]['namethree']);
						}
						if( isset($locationListUsers[$i]['lastnameone']) && !empty($locationListUsers[$i]['lastnameone']) )
						{
							$user->setUsuPrimerApellido($locationListUsers[$i]['lastnameone']);
						}
						if( isset($locationListUsers[$i]['lastnametwo']) && !empty($locationListUsers[$i]['lastnametwo']) )
						{
							$user->setUsuSegundoApellido($locationListUsers[$i]['lastnametwo']);
						}
	
						$user->setUsuUsuario($locationListUsers[$i]['username']);
						
						if( isset($locationListUsers[$i]['password']) && !empty($locationListUsers[$i]['password']) )
						{
							$user->setUsuClave( sha1($locationListUsers[$i]['password']) );
						}

						$user->setUsuGenero($locationListUsers[$i]['gender']);
						$role_repo = $em->getRepository('AppBundle:Rol')->find($locationListUsers[$i]['typeUser']);
						$em->persist($user);
						$flush = $em->flush();
						
						

						$lastUser = $user->getUsuId();
						
						$user_repo = $em->getRepository('AppBundle:Usuario')->find( $lastUser );
						
						
						//$locationListUsers[$i]['username']
						$resUserLocation =  $this->checkExistUser($locationListUsers[$i]['username']);
						if( $resUserLocation  )
						{	
							if( count($resUserLocation) > 0 )
							{
								$resUserLocation->getUsuId();

								$objUserRol = $em->getRepository("AppBundle:ClienteUsuario")->findOneBy( array( "cliUsuUsu"=> $resUserLocation->getUsuId(), "cliUsuRol"=>array(3, 6) ) ); //3= asistente, 6 = medico

								if( !$objUserRol )
								{
									$objUserRol = new ClienteUsuario();
								}
							}
							else
							{
								$objUserRol = new ClienteUsuario();
							}

							$objUserRol->setCliUsuCorreo($locationListUsers[$i]['email']);
							$objUserRol->setCliUsuUsu($user_repo); //setUsuRolUsuarios(  $representer_repo );
							$objUserRol->setCliUsuCli($client_repo);
							$objUserRol->setCliUsuRol( $role_repo );
							$objUserRol->setCliUsuFechaRegistro(new \Datetime());
							$objUserRol->setCliUsuFechaCrea( new \DateTime() );

							if( isset($locationListUsers[$i]['email']) && !empty($locationListUsers[$i]['email']) )
							{
								$objUserRol->setCliUsuCorreo( $locationListUsers[$i]['email'] );
							}
							
							$em->persist($objUserRol);
							$flush = $em->flush();
							
							if( !empty($locationListUsers[$i]['password']) )
							{
								if (isset($clientId) && $clientId > 0)
								{
									//Send email notification to representer
									if( !empty($locationListUsers[$i]['email']) )
									{
										if( $is_new == true)
										{
											$templateEmail = "nuevo_usuario";
										}
										else
										{
											$templateEmail = "cambio_password";
										}
										$this->sendMessage($templateEmail, $locationListUsers[$i]['username'], $locationListUsers[$i]['password'], $to=$locationListUsers[$i]['email'], $trom=false);
										
									}
								}
								else
								{
									//Send email notification to representer
									if( !empty($locationListUsers[$i]['email']) )
									{
										if( $is_new == true)
										{
											$templateEmail = "nuevo_usuario";
										}
										else
										{
											$templateEmail = "cambio_password";
										}
										$this->sendMessage($templateEmail, $locationListUsers[$i]['username'], $locationListUsers[$i]['password'], $to=$locationListUsers[$i]['email'], $trom=false);
										//$this->sendMessage("nuevo_usuario", $locationListUsers[$i]['username'], $locationListUsers[$i]['password'], $to=$locationListUsers[$i]['email'], $trom=false);
									}
								}
							}
							
							
							$currentList[] = $locationListUsers[$i]['username'];
							
						}
						
						
					}
					else
					{
						//========================================
						//Save all rol per users 
						//========================================
						$role_repo = $em->getRepository('AppBundle:Rol')->find($locationListUsers[$i]['typeUser']);
						$lastUser = $oRepresenter->getUsuId();
						
						$resUserLocation =  $this->checkExistUser($locationListUsers[$i]['username']);
						if( $resUserLocation  )
						{	
							$is_new = false;
							if( count($resUserLocation) > 0 )
							{
								$resUserLocation->getUsuId();
								
								
								$objUserRol = $em->getRepository("AppBundle:ClienteUsuario")->findOneBy( array( "cliUsuUsu"=> $resUserLocation->getUsuId(), "cliUsuRol"=>array(3, 6) ) ); //3= asistente, 6 = medico

								if( !$objUserRol )
								{
									
									$objUserRol = new ClienteUsuario();
									$is_new = true;
								}
							}
							else
							{
								
								$objUserRol = new ClienteUsuario();
								$is_new = true;
							}
							
							//$objUserRol = new ClienteUsuario();
							$objUserRol->setCliUsuUsu( $representer_repo );
							$objUserRol->setCliUsuCli( $client_repo );
							$objUserRol->setCliUsuRol($role_repo);
							$objUserRol->setCliUsuFechaCrea( new \DateTime() );
							$objUserRol->setCliUsuFechaRegistro(new \Datetime());
							$objUserRol->setCliUsuCorreo($representerEmail);
							$em->persist($objUserRol);
							$flush = $em->flush();
							
							if( !empty($locationListUsers[$i]['password']) )
							{
								if (isset($clientId) && $clientId > 0)
								{
									//Send email notification to representer
									if( !empty($locationListUsers[$i]['email']) )
									{
										
										if( $is_new == true)
										{
											$templateEmail = "nuevo_usuario";
										}
										else
										{
											$templateEmail = "cambio_password";
										}
										$this->sendMessage($templateEmail, $locationListUsers[$i]['username'], $locationListUsers[$i]['password'], $to=$locationListUsers[$i]['email'], $trom=false);
									}
								}
								else
								{
									//Send email notification to representer
									if( !empty($locationListUsers[$i]['email']) )
									{
										if( $is_new == true)
										{
											$templateEmail = "nuevo_usuario";
										}
										else
										{
											$templateEmail = "cambio_password";
										}
										$this->sendMessage($templateEmail, $locationListUsers[$i]['username'], $locationListUsers[$i]['password'], $to=$locationListUsers[$i]['email'], $trom=false);
									}
								}
							}
							
							$currentList[] = $locationListUsers[$i]['username'];
						}
					}
				}
			}

			
			if( isset($clientId) && $clientId > 0 )
			{	
				$result=array_diff($userListDB,$currentList);
				//$result=array_diff($a1,$a2);
				if( count($result) > 0 )
				{	
					foreach($result as $username)
					{
						//echo $value;

						$res = $this->checkExistUser($username);
						if( $res && count($res) > 0 )
						{
							$userId = $res->getUsuId();
							$RAW_QUERY = "UPDATE cliente_usuario SET cli_usu_activo = 0 WHERE cli_usu_cli_id =  $clientId AND cli_usu_usu_id = $userId AND ( cli_usu_rol_id in ( 3, 6 ) )";
							$statement = $em->getConnection()->prepare($RAW_QUERY);
							$statement->execute();
						}
					}
				}
			}
			//print_r($result);
			/*
			
			*/
			//} 

			$em->getConnection()->commit();
			if (isset($clientId) && $clientId > 0) {
				$msg = "Se actualizó correctamente los datos del extablecimiento con éxito";
			}
			else
			{
				$msg = "Registro creado con éxito";
			}
			$this->session->getFlashBag()->add("success", $msg);
			echo 1;
			
		}
		catch (Exception $e) {
			$em->getConnection()->rollBack();
			throw $e;
		}
		
		
		
		//echo $status;
		
		exit();
	}
	
	public function checkExistUser($username)
	{
		$em = $this->getDoctrine()->getManager();
		$username = trim($username);
		if( isset( $username ) && !empty($username) )
		{
			$user_repo = $em->getRepository('AppBundle:Usuario')->findOneBy( array( "usuUsuario" => $username) );
			//echo $user_repo[0]->getusuId();
			return $user_repo;
		}
		return false;
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
	
	/*
	public function checkClientUsers($clientId)
	{
		$em = $this->getDoctrine()->getManager();
		if( isset( $clientId ) && $clientId > 0 )
		{
			$client_repo = $em->getRepository('AppBundle:ClienteUsuario')->findBy( array( "cliUsuCli" => $clientId) );
		}
		
	}
	*/
}
