<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use \AppBundle\Entity\Usuario;
use \AppBundle\Entity\Rol;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{
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
		

        return $this->render('EmrBundle:cliente:new.html.twig', array(
            'cliente' => $cliente,
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
        $deleteForm = $this->createDeleteForm($cliente);
        $editForm = $this->createForm('EmrBundle\Form\ClienteType', $cliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cliente_edit', array('id' => $cliente->getCliId()));
        }

        return $this->render('EmrBundle:cliente:edit.html.twig', array(
            'cliente' => $cliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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
		
		//$result = "";
		//$iCountryId = $request->get('id');
		$sUsername = $request->get("username");
		
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
				echo 1; //is available
			}
			else
			{
				echo 0; //in not available
			}
		}
		catch (\Exception $e){
				echo ($e->getMessage());
		}
		
		
		exit();
		//return  $response = new JsonResponse($result);

	}
	
	
	public function validFormAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		
		//Location data
		$clienId = $request->get("id");
		
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
		
		//Location List users 
		$locationListUsers = $request->get("locationUsers");
		
		//Payment method
		$payMethod = $request->get("payMethod");
		
		//Credit card data
		$credirCard = $request->get("credirCard");
		
		$em->getConnection()->beginTransaction(); // suspend auto-commit
		try
		{
			if (isset($clienId) && $clienId > 0) {
				
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
			//$client->setCliEsp($cliEsp);
			$client->setCliTelefono1($phone_one);
			$client->setCliTelefono2($phone_two);
			$client->setCliNombre($representerName);
			$client->setCliFechaRegistro(new \Datetime());
			$client->setCliFechaCrea(new \Datetime() );

			
			//if ($flush == null) {
				//$status = 1; 
				//success

				//if (isset($clienId) && $clienId != "") {
					//$this->session->getFlashBag()->add("success","Registro creado con éxito");
					//return $this->redirectToRoute('paciente_show', array('id' => $oPatient->getPacId()));
				//	$status = 1;  // is update
				//} else {

				//	 $status = $client->getCliId(); //new 
				//}
				
				//Save all $specialities to this establashment
				if( count($specialities) > 0 )
				{
					for(	$i=0; $i < count($specialities); $i++ )
					{
						//$specialities = new Cliente
						$spe_repo = $em->getRepository('AppBundle:Especialidad')->find($specialities[$i]);
						$client->addEspid($spe_repo);
						//echo $specialities[$i]." - ";
					}
				}
				
				$em->persist($client);
				$flush = $em->flush();
				
				
				//Save all users related for this location establishment
				if( count($locationListUsers) > 0 )
				{
					for($i=0; $i < count($locationListUsers); $i++)
					{
						$user = new Usuario();
						$user->setUsuNombre($locationListUsers[$i]['name']);
						$user->setUsuUsuario($locationListUsers[$i]['username']);
						$user->setUsuClave( sha1($locationListUsers[$i]['password']) );

						$user->setUsuCorreo( $locationListUsers[$i]['email'] );
						$user->setUsuGenero($locationListUsers[$i]['gender']);
						$user->setUsuFechaRegistro(new \Datetime());
						$user->setUsuFechaCrea(new \Datetime());
						

						$role_repo = $em->getRepository('AppBundle:Rol')->find($locationListUsers[$i]['typeUser']);
						$user->addRol($role_repo);
						 
						$em->persist($user);
						$flush = $em->flush();
						
						$lastUser = $user->getUsuId();
						
						//Set type permission
						//$typeRole = new  UsuarioRol();
						
					}
				}
				
			//} 

			$em->getConnection()->commit();
		}
		catch (Exception $e) {
			$em->getConnection()->rollBack();
			throw $e;
		}
		
		
		
		//echo $status;
		
		exit();
	}
}
