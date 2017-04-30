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
use \AppBundle\Entity\UsuariosRol;

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
			$RAW_QUERY = "SELECT * FROM usuarios_rol 
							WHERE urol_cli_id =:client
							and urol_usu_id =:userId
							and urol_rol_id = 2 "; //5 = Cliente( Representante )
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
							inner join usuarios_rol ur on ur.urol_usu_id = u.usu_id 
							WHERE cu.cli_usu_cli_id =:client
							and ur.urol_rol_id = 2 "; //5 = Cliente( Representante )
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
								LEFT JOIN usuarios_rol ur ON ur.urol_usu_id = u.usu_id
								WHERE ur.urol_cli_id  =:client AND ur.urol_rol_id != 2
								GROUP BY ur.urol_rol_id, ur.urol_usu_id";				
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("client", $cliente->getCliId() );
			$statement->execute();
			$getUsersLocation = $statement->fetchAll();
			
			
			//==================================================================
			//Get if the representer marked the checkbox as set representer date
			//as doctor or assistant
			//==================================================================
			$RAW_QUERY = "SELECT * FROM usuarios_rol WHERE urol_usu_id =:idUser
							and urol_rol_id != 2 "; //2 = Cliente( Representante )
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("idUser", $idUser );
			$statement->execute();
			$resDoctorOrAssistant = $statement->fetchAll();
			$representerIsDoctorOrAssistant = count($resDoctorOrAssistant);
			
			return $this->render('EmrBundle:cliente:edit.html.twig', array(
				'cliente' => $cliente,
				'id'=>$cliente->getCliId(),
				'edit_form' => $editForm->createView(),
				'methodPay'=> $methodPay,
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
				
				$email = $result[0]['usu_correo'];
				$gender = $result[0]['usu_genero'];
				$email =  $this->hide_mail( $email );
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
		$representerName = $request->get("representerName");
		
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
		$credirCard = $request->get("credirCard");
		
		$addToUser = $request->get("addToUser");
		
		$em->getConnection()->beginTransaction(); // suspend auto-commit
		try
		{
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
			$client->setCliNombre($representerName);
			
			$client->setCliFechaRegistro(new \Datetime());
			$client->setCliFechaCrea(new \Datetime() );
				
			//Save all $specialities to this establashment
			if( count($specialities) > 0 )
			{
				if (isset($clientId) && $clientId > 0) 
				{
					$RAW_QUERY = " delete from cliente_especialidad where cliId = $clientId ";
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->execute();
				}
				
				
				for(	$i=0; $i < count($specialities); $i++ )
				{
					$spe_repo = $em->getRepository('AppBundle:Especialidad')->find($specialities[$i]);
					$client->addEspid($spe_repo);
				}
			}
				
			$em->persist($client);
			$flush = $em->flush();
			$lastClient = $client->getCliId();
				
			//========================================
			//Save presenter's data as user in table usuario
			//========================================
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
			$oRepresenter->setUsuCorreo($representerEmail);
			$oRepresenter->setUsuGenero($representerGender);
			$oRepresenter->setUsuUsuario($representerUser);
			$oRepresenter->setUsuNombre($representerName);
			$oRepresenter->setUsuFechaRegistro(new \Datetime());
			$oRepresenter->setUsuFechaCrea(new \Datetime());
			$oRepresenter->setUsuFechaNacimiento( new \DateTime($representerBirthDate) );
			
			if (isset($clientId) && $clientId > 0) 
			{
				//exit("x");
				/*
					$RAW_QUERY = "delete from usuarios_rol where urol_usu_id =$clientId AND urol_rol_id = 2"; //2 = Cliente( Representante )
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->execute();
				*/
				$RAW_QUERY = "SELECT ur.urol_usu_id FROM cliente_usuario cu 
								inner join usuario u on u.usu_id = cu.cli_usu_usu_id
								inner join usuarios_rol ur on ur.urol_usu_id = u.usu_id 
								WHERE cu.cli_usu_cli_id =:client
							"; //5 = Cliente( Representante )
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->bindValue("client", $clientId );
					$statement->execute();
					$getUserList = $statement->fetchAll();
				$deleteList = array();
				if( count($getUserList) )
				{
					foreach($getUserList as $k)
					{
						array_push($deleteList, $k['urol_usu_id']);
					}
					
					if( count($deleteList) )
					{
						$RAW_QUERY = "delete from usuarios_rol where urol_usu_id in (".  implode(",", $deleteList).") AND urol_cli_id =  $clientId "; //2 = Cliente( Representante )
						$statement = $em->getConnection()->prepare($RAW_QUERY);
						$statement->execute();
					}
				}
				//var_dump( $deleteList );
				//echo implode(",", $deleteList);
				//exit("v");
			}
			
			$em->persist($oRepresenter);
			$flush = $em->flush();
			$lastRepresenter = $oRepresenter->getUsuId();	
			
			$role_representer_repo = $em->getRepository('AppBundle:Rol')->find(2); //2 = Cliente( Representante )
			//$oRepresenter->addIdRol($role_representer_repo); 

			$client_repo = $em->getRepository('AppBundle:Cliente')->find($lastClient); // = Cliente( Representante )
			//echo $lastRepresenter;
			$representer_repo = $em->getRepository("AppBundle:Usuario")->find($lastRepresenter);
			
			
			//$lastRepresenter = $objUserRol->getUsuId();
			//
			$objUserRol = new UsuariosRol();
			$objUserRol->setUrolUsu($representer_repo); //setUsuRolUsuarios(  $representer_repo );
			$objUserRol->setUrolCli($client_repo);
			$objUserRol->setUrolRol( $role_representer_repo );
			$em->persist($objUserRol);
			$flush = $em->flush();
				
			//Save all users related for this location establishment
			if( count($locationListUsers) > 0 )
			{
				
				if (isset($clientId) && $clientId > 0) 
				{
					//exit("c");
					$RAW_QUERY = "delete from cliente_usuario where cli_usu_cli_id = $clientId ";
					$statement = $em->getConnection()->prepare($RAW_QUERY);
					$statement->execute();
				}
				
				for($i=0; $i < count($locationListUsers); $i++)
				{
						
					if( $locationListUsers[$i]['username'] != $representerUser )
					{
						//========================================
						//Save all users except the representer 
						//========================================
						if (isset($clientId) && $clientId > 0)
						{
							//Check if exists or is new in module edit, if not exists then the represented added a new user
							$user = $em->getRepository('AppBundle:Usuario')->findOneBy( array( "usuUsuario"=>$locationListUsers[$i]['username'] ) );
							if( !$user )
							{
								$user = new Usuario();
							}
						}
						else
						{
							$user = new Usuario();
						} 
						//$user = new Usuario();
						if( isset($locationListUsers[$i]['name']) && !empty($locationListUsers[$i]['name']) )
						{
							$user->setUsuNombre( $locationListUsers[$i]['name']);
						}
						$user->setUsuUsuario($locationListUsers[$i]['username']);
						
						if( isset($locationListUsers[$i]['password']) && !empty($locationListUsers[$i]['password']) )
						{
							$user->setUsuClave( sha1($locationListUsers[$i]['password']) );
						}

						if( isset($locationListUsers[$i]['email']) && !empty($locationListUsers[$i]['email']) )
						{
							$user->setUsuCorreo( $locationListUsers[$i]['email'] );
						}
						
						$user->setUsuGenero($locationListUsers[$i]['gender']);
						$user->setUsuFechaRegistro(new \Datetime());
						$user->setUsuFechaCrea(new \Datetime());
						
						$role_repo = $em->getRepository('AppBundle:Rol')->find($locationListUsers[$i]['typeUser']);
						//$user->addIdRol($role_repo);
						$em->persist($user);
						$flush = $em->flush();

						$lastUser = $user->getUsuId();
						
						$user_repo = $em->getRepository('AppBundle:Usuario')->find( $lastUser );
						
						$objUserRol = new UsuariosRol();
						/*
						$objUserRol->setUrolCliId( $client_repo ); // cliente 
						$objUserRol->setUrolUsuId( $user_repo ); //user
						$objUserRol->setUrolRolId( $role_repo ); //role
						*/						
						
						$objUserRol->setUrolUsu($user_repo); //setUsuRolUsuarios(  $representer_repo );
						$objUserRol->setUrolCli($client_repo);
						$objUserRol->setUrolRol( $role_repo );
						
						
						$em->persist($objUserRol);
						$flush = $em->flush();
						
						
					}
					else
					{
						//========================================
						//Save all rol per users 
						//========================================
						$role_repo = $em->getRepository('AppBundle:Rol')->find($locationListUsers[$i]['typeUser']);
						//$oRepresenter->addIdRol($role_repo);
						$lastUser = $oRepresenter->getUsuId();
						
						
						$objUserRol = new UsuariosRol();
						/*
						$objUserRol->setUrolCliId( $client_repo ); // cliente 
						$objUserRol->setUrolUsuId( $representer_repo ); //user
						$objUserRol->setUrolRolId( $role_repo ); //role
						*/
						//exit("xxxx");
						$objUserRol->setUrolUsu( $representer_repo );
						$objUserRol->setUrolCli( $client_repo );
						$objUserRol->setUrolRol($role_repo);
						
						$em->persist($objUserRol);
						$flush = $em->flush();
						
						
					}
					
					//========================================
					//Sava data in cliente_usuario
					//========================================					
					//$client_repo = $em->getRepository('AppBundle:Cliente')->find($lastClient);
					$user_repo = $em->getRepository('AppBundle:Usuario')->find($lastUser);

					$oClientUser = new ClienteUsuario();
					$oClientUser->setCliUsuCli( $client_repo );
					$oClientUser->setCliUsuFechaCrea( new \DateTime() );
					$oClientUser->setCliUsuRol( $role_repo );
					$oClientUser->setCliUsuUsu( $user_repo );
					$em->persist($oClientUser);
					$flush = $em->flush();
				}
			}
				
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
}
