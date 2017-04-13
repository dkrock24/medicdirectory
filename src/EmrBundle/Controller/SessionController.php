<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends Controller
{
	
	public function loginAction( Request $request )
    {
		//echo "xx";
        //return $this->render('EmrBundle:Session:login.html.twig', array());
		//return $this->redirectToRoute('emr_establecimiento');
		
		$em = $this->getDoctrine()->getManager();
		$idUser =  $this->getUser()->getUsuId();
		//echo $this->get('security.token_storage')->getToken()->getUser()->getUsuId();
		$user_repo = $em->getRepository("AppBundle:ClienteUsuario")->findByCliUsuUsu($idUser);
		
		$iLocationId = $request->get('id');
		
		if( isset($iLocationId) && $iLocationId > 0)
		{
		
			$locationName = "";
			$municipalityId = "";
			$municipalityName = "";
			$myLocation = array();
			foreach( $user_repo as $key)
			{
				$myLocation[] = $key->getCliUsuCli()->getCliId();
				if( $key->getCliUsuCli()->getCliId() ==  $iLocationId )
				{
					$locationName = $key->getCliUsuCli()->getCliNombre();
					$municipalityName = $key->getCliUsuCli()->getCliMun()->getMunNombre();
					$municipalityId = $key->getCliUsuCli()->getCliMun()->getMunId();
				}
			}
			
			if (in_array($iLocationId, $myLocation))
			{
				//$iLocationObj = $em->getRepository("AppBundle:Cliente")->find($iLocationId);
				
				$this->get('session')->set('locationId', $iLocationId);
				//$this->get('session')->set('locationObj', $iLocationObj);
				$this->get('session')->set('locationName', $locationName);
				$this->get('session')->set('municipalityId', $municipalityId);
				$this->get('session')->set('municipalityName', $municipalityName);
				
				return $this->redirectToRoute("emr_dashboard");
			}
		}
		
		return $this->redirectToRoute("emr_location");
		
    }
}
