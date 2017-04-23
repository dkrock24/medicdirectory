<?php

namespace Services;

use \AppBundle\Entity\Menu;

class ConfigureSession {
	
	/* @var $em \Doctrine\ORM\EntityManager */
	
    private $em;

	/*
    function __construct($em) {
        $this->em = $em;
    }
	*/
	
	private $session;

    public function __construct($em, $session)
    {
		$this->em = $em;
        $this->session = $session;
    }
	
	public function setSessionLocation($idUser, $clientId)
	{
		
		$iLocationId = $clientId;
		$status = false;
		if( isset($idUser) && $idUser >0 && isset($iLocationId) && is_numeric($iLocationId) )
		{
			$user_repo = $this->em->getRepository("AppBundle:ClienteUsuario")->findByCliUsuUsu($idUser);
			
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
				$this->session->set('locationId', $iLocationId);
				$this->session->set('locationName', $locationName);
				$this->session->set('municipalityId', $municipalityId);
				$this->session->set('municipalityName', $municipalityName);
				//return $this->redirectToRoute("emr_dashboard");
				$status = true;
			}
		}
		
		return $status;
	}
	
	
	
	
}
