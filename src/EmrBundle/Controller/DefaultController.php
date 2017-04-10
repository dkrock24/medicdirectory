<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	
	public function redirectMenuAction( $route  )
    {
		
		// redirect to the route example paciente_
		return $this->redirectToRoute($route);
		
		//return $this->render("ErmBundle:".$folder.":".$pagina.".html.twig");
        
    }
	
	public function establecimientoAction( Request $request )
    {
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
				$this->get('session')->set('locationId', $iLocationId);
				$this->get('session')->set('locationName', $locationName);
				$this->get('session')->set('municipalityId', $municipalityId);
				$this->get('session')->set('municipalityName', $municipalityName);
				
				return $this->redirectToRoute("emr_dashboard");
			}
		}
		//echo  count($user_repo);
		/*
		if( isset($iCountryId) )
		{
			$em = $this->getDoctrine()->getManager();
			$RAW_QUERY = "SELECT m.mun_id, m.mun_nombre, d.dep_departamento FROM departamento d "
						. " inner join municipio m on d.dep_id = m.mun_dep_id where d.dep_pai_id = $iCountryId ";

			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->execute();

			$result = $statement->fetchAll();
		}
		*/
		
		return $this->render('EmrBundle:Default:location.html.twig', array("data"=>$user_repo));
    }
}
