<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use \AppBundle\Entity\ClienteModulo;
#use \AppBundle\Entity\Agenda;

class ModulosController extends Controller
{
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	
	public function indexAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$locationId = $this->get('session')->get('locationId');
		
		$idUser = $this->getUser()->getUsuId();
		
		//$locationId = $request->get("id");
		$location_repo = $em->getRepository("AppBundle:ClienteUsuario")->findBy( array("cliUsuCli"=>$request->get("id"), "cliUsuUsu"=>$idUser, "cliUsuRol"=>2) );
		if( !$location_repo )
		{
			throw new AccessDeniedException('Acceso denegado');
		}
		
		
		if( !$locationId )
		{
			$srvSession = $this->get('srv_session');
			$res = $srvSession->setSessionLocation( $idUser, $request->get("id") );
			if( $res )
			{
				//return $this->redirectToRoute("emr_dashboard");
				$userRoles = $this->get('session')->get('userRoles');
			}
		}else{
			$userRoles = $this->get('session')->get('userRoles');
		}
		
		/*
		if( !array_key_exists(2, $userRoles) )
		{
			throw new AccessDeniedException('Acceso denegado.');
		}
		*/
	
		$arrCurrentModules = array();
		$oMyModules = $em->getRepository("AppBundle:ClienteModulo")->findBy(array("cliModCli"=>$locationId ) );
		foreach($oMyModules as $item)
		{
			$arrCurrentModules[ $item->getCliModMod()->getModId() ][] = /*$item->getCliModMod()->getModId();//*/($item->getCliModActivo())?1:0;
		}	
	
		
		$oAllModules = $em->getRepository("AppBundle:Modulo")->findBy(array("modActivo"=>1 ) );
		$hash_handler = null;
		$modulos = array();
		if(count($oAllModules) > 0 )
                {
                    foreach( $oAllModules as $kmod => $modulo ){
                        $hash_handler = $modulo->getModHashCode();
                        $modulos[] = array(
                                "id" => $modulo->getModId(),
                                "hash" => stream_get_contents( $hash_handler ),
                                "module" => $modulo->getModModulo(),
								"cost"=>$modulo->getModCosto(),
								"isGeneral"=>$modulo->getModGeneral(),
								"isActive"=>$modulo->getModActivo()
                        );
                        rewind($hash_handler);
                    }
                }
		
		return $this->render("EmrBundle:modulos:index.html.twig", array(
			//"userRoles" => $userRoles,
			"currentModules"=>$arrCurrentModules,
			"allModules"=>$oAllModules,
			"modulos"=>$modulos
				
		));
		
	}
	
	
	public function buyModulesAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$iLocationId = $this->get('session')->get('locationId');
		$ids = $request->get('id');
		$option = $request->get('option');
		$arrIds = explode(",",$ids);
		if( count($arrIds) > 0 )
		{	
			for($i=0;$i< count($arrIds);$i++)
			{
				$oModule = $em->getRepository("AppBundle:Modulo")->find( $arrIds[$i] );
				
				//echo $oModule->getModCosto()."-";
				
				$oClientModule = $em->getRepository("AppBundle:ClienteModulo")->findBy( array("cliModCli"=>$iLocationId,"cliModMod"=>$arrIds[$i] ) );
				
				if( $option == "btnSetSelectedModules" )
				{	
					if( !$oClientModule )
					{
						$oSetModule = new ClienteModulo();
						$oCliente = $em->getRepository("AppBundle:Cliente")->find( $iLocationId );
						$oSetModule->setCliModCli($oCliente);
						$oModule = $em->getRepository("AppBundle:Modulo")->find( $arrIds[$i]  );
						$oSetModule->setCliModMod($oModule);
						if( $oModule->getModCosto() == "0.00" || $oModule->getModGeneral() == 1 )
						{
							$oSetModule->setCliModActivo(1);
						}
						else
						{
							$oSetModule->setCliModActivo(0);
						}
						$oSetModule->setCliModFechaCrea( new \Datetime() );
						$em->persist($oSetModule);
						$flush = $em->flush();

					}
					else
					{
						$RAW_QUERY = "UPDATE cliente_modulo SET cli_mod_activo = 1 WHERE cli_mod_cli_id =  $iLocationId AND cli_mod_mod_id = $arrIds[$i] ";
						$statement = $em->getConnection()->prepare($RAW_QUERY);
						$statement->execute();
					}
				}
				else
				{
					//$userId = $res->getUsuId();
					if( !$oClientModule )
					{
						$oSetModule = new ClienteModulo();
						$oCliente = $em->getRepository("AppBundle:Cliente")->find( $iLocationId );
						$oSetModule->setCliModCli($oCliente);
						$oModule = $em->getRepository("AppBundle:Modulo")->find( $arrIds[$i]  );
						$oSetModule->setCliModMod($oModule);
						$oSetModule->setCliModActivo(0);
						$oSetModule->setCliModFechaCrea( new \Datetime() );
						$em->persist($oSetModule);
						$flush = $em->flush();
					}
					else
					{
						$RAW_QUERY = "UPDATE cliente_modulo SET cli_mod_activo = 0, cli_mod_fecha_mod = ".date("Y-m-d")." WHERE cli_mod_cli_id =  $iLocationId AND cli_mod_mod_id = $arrIds[$i] ";
						$statement = $em->getConnection()->prepare($RAW_QUERY);
						$statement->execute();
					}	
					
				}
				
			}
		}
		//var_dump($arrIds);
		//echo "mierda";
		/*
		if( isset($doctorId) && !empty($doctorId) )
		{
			$em = $this->getDoctrine()->getManager();
			$RAW_QUERY = "
							SELECT 
							c.cit_notas, concat_ws(' ', p.pac_nombre, p.pac_seg_nombre, p.pac_apellido, p.pac_seg_apellido ) AS paciente,
							concat_ws(' ', u.usu_nombre, u.usu_segundo_nombre, u.usu_tercer_nombre, u.usu_primer_apellido, u.usu_segundo_apellido ) AS medico,
							 CASE a.age_estado WHEN 'c' THEN 'En curso' WHEN 't' THEN 'Finilizada' WHEN 'a' THEN 'Anulada' WHEN 'p' THEN 'Pendiente' END  AS estatus,
							 a.age_fecha_inicio, c.cit_pac_id, a.age_id 
							FROM agenda a
							INNER JOIN cita c ON a.age_cit_id = c.cit_id
							INNER JOIN paciente p ON c.cit_pac_id = p.pac_id
							INNER JOIN usuario u ON c.cit_usu_id = u.usu_id
							WHERE c.cit_cli_id = $iLocationId AND u.usu_id = $doctorId $filterDate $filterStatus $filterPatiendId
					     ";
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->execute();

			$result = $statement->fetchAll();
			
			//var_dump( $result );
		}
		return  $response = new JsonResponse($result);
		*/
		exit();
	}		
	
}
