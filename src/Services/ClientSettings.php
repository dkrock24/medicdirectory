<?php

namespace Services;

//use \AppBundle\Entity\Menu;
use Symfony\Component\Validator\Constraints\DateTime;
class ClientSettings {
	
	/* @var $em \Doctrine\ORM\EntityManager */
	
    private $em;

	/*
    function __construct($em) {
        $this->em = $em;
    }
	*/
	
	private $session;
	public $locationId;

    public function __construct($em, $session)
    {
		$this->em = $em;
        $this->session = $session;
		
		$this->locationId = $this->session->get('locationId');
    }
	
	public function getClientSettings($idUser)
	{
		$arrParameter = array();
		$oClientUserId = $this->em->getRepository("AppBundle:ClienteUsuario")->findOneBy(array("cliUsuCli"=>$this->locationId, "cliUsuUsu"=>$idUser, "cliUsuRol"=>6 ) ); //6 = medico
		if( $oClientUserId )
		{
			$iClientUserId = $oClientUserId->getCliUsuId();
			$oSettings = $this->em->getRepository("AppBundle:ClienteAjustes")->findBy(array("cliAjuCliUsu" => $iClientUserId));
			if (count($oSettings) > 0) {
				foreach ($oSettings as $value) {
					$arrParameter[ $value->getCliAjuLlave() ] = $value->getCliAjuValor();
				}
			}
		}
		
		return $arrParameter;
	}
	
}
