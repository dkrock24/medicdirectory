<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use \AppBundle\Entity\Pagos;
//use AppBundle\Form\LpPhotosType;

#use AppBundle\Sevices\MailRelayService;

class PaypalController extends Controller 
{	
	
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	
	public function paypalSuccessAction( Request $request )
	{
		$session = new Session();
		$token = $request->get('token');
		$PayerID = $request->get('PayerID');
		
		if( isset($token) ){

			$paypal = $this->get('srv_Paypal');			
			$aData = $this->getGeneralParameters();
			$paypal->setParameterDB($aData['nameDB'], $aData['hostDB'], $aData['userDB'], $aData['passwordDB'], $aData['portDB'], $aData['urlSuccess'], $aData['urlCancel'] );

			$paypal->viewTransactionPaypal($token, $PayerID);
			
			$sessionUser =  $session->get("payed");

			if( $sessionUser)
			{
				$session->remove('payed');
				
				$msg = "Record created successfully";
				$this->session->getFlashBag()->add("success", $msg);
				return $this->redirectToRoute('cliente_new');
			}
			else
			{
				exit("Ocurred an error");
			}
		}
		else
		{
			throw new \Exception('Something went wrong!');
		}
	}
	
	public function paypalCancelAction( Request $request )
	{
		
	}
	
	public function newPictureAction( Request $request )
	{	
		return $this->render('AppBundle:TheBestPicture:new.html.twig', array());
	}
	
	public function paypalAction( Request $request ){
		
		$session = new Session();
		
		$pay = new Pagos();
		//$form = $this->createForm(LpPhotosType::class, $photos);		
		//$form->handleRequest($request);
		
		$clientId = $request->get("clientId");
		$plan = $request->get("opt");
		
		if( $plan != "" && $plan > 0  && $clientId != "" && $clientId > 0 )
		{	
		
		
			//Variables del formulario
			$email			= "email@test.com"; //$form->get('phEmail')->getData();
			$file			= "xxxxxxxx"; //$form['phPicture']->getData();
			$description	= "description"; //$form->get('phText')->getData();
			$link			= "http//www.link.com"; //$form->get('phLink')->getData();
			$is_checkout	= "checkout";

			$client_id = $request->get('client_id');


			$em = $this->getDoctrine()->getManager();
			$pay->setCli( $client_id );
			$pay->setPhEmail($email);
			//$photos->setPhPicture($picture);
			$pay->setPhText($description);
			$pay->setPhLink($link);
			$flush = $em->flush();
		
		
		
			if ($flush == null)
			{
				$paypal = $this->get('srv_Paypal');

				//Inicio las sesiones
				//$session->set('email', $email);

				//$session->set('description', $description);
				//$session->set('link', $link);
				$session->set('payed', 1);
				//$picture = "picture"; //$session->get('picture');



				//echo $session->get('payed');
				//Inicializo el metodo para procesar el paypal

				$aData = $this->getGeneralParameters();
				$paypal->setParameterDB($aData['nameDB'], $aData['hostDB'], $aData['userDB'], $aData['passwordDB'], $aData['portDB'], $aData['urlSuccess'], $aData['urlCancel'] );
				//$paypal->processPaypal($email,$picture, $description, $link, $is_checkout );
				$paypal->processPaypal($clientId, $plan, $is_checkout );
			}
		
		}
		else{
			return $this->redirectToRoute("cliente_new");
		}
		
		exit();
		
	}
	
	public function getGeneralParameters()
	{
		$urlSuccess = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']. $this->generateUrl('app_paypal_success');
		$urlCancel = "http://"./*.$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']. */$this->generateUrl('clientes_modulos_new');
		
		$em = $this->getDoctrine()->getEntityManager();
		$nameDB = $em->getConnection()->getDatabase();
		$hostDB = $em->getConnection()->getHost();
		$userDB = $em->getConnection()->getUsername();
		$passwordDB = $em->getConnection()->getPassword();
		$portDB = $em->getConnection()->getPort();
		
		return array( "urlSuccess"=>$urlSuccess, "urlCancel"=>$urlCancel, "nameDB"=>$nameDB, "hostDB"=>$hostDB, "userDB"=>$userDB, "passwordDB"=>$passwordDB, "portDB"=>$portDB );
	}
}

