<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
	
	public function redirectMenuAction( $route  )
    {
		
		// redirect to the route example paciente_
		return $this->redirectToRoute($route);
		
		//return $this->render("ErmBundle:".$folder.":".$pagina.".html.twig");
        
    }
	
	
	public function locationAction( Request $request )
	{

		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
		{
		
			$em = $this->getDoctrine()->getManager();
			$idUser =  $this->getUser()->getUsuId();

			//=========================================
			//Nuevo cambio
			//=========================================
			$RAW_QUERY = "SELECT 
							a.*,
							c.cli_nombre AS nombre_fiscal,
							m.mun_nombre AS municipio
						FROM
							(SELECT
								cu.cli_usu_cli_id AS cliente,
									GROUP_CONCAT(r.rol_id
										SEPARATOR ',') AS roles
							FROM
								cliente_usuario cu
							LEFT JOIN rol r ON r.rol_id = cu.cli_usu_rol_id
							WHERE
								cu.cli_usu_usu_id =:idUser
								AND cu.cli_usu_activo = 1
							GROUP BY cu.cli_usu_cli_id) a
								LEFT JOIN
							cliente c ON a.cliente = c.cli_id
								LEFT JOIN
							municipio m ON c.cli_mun_id = m.mun_id
							"; 
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("idUser", $idUser );
			$statement->execute();
			$user_repo = $statement->fetchAll();
			
			//var_dump($user_repo);
			//exit();
			
			$dataLocation = array();
			$num = 0;
			foreach( $user_repo as $val)
			{
				$fiscalName =  $val['nombre_fiscal']; //$val->getCliUsuCli()->getCliNombreFiscal();
				$clientId = $val['cliente']; //$val->getCliUsuCli()->getCliId();
				$municipality = $val['municipio']; //$val->getCliUsuCli()->getCliMun()->getMunNombre();
				
				//$clientId =  $val->getCliUsuCli()->getCliId();
				
				
				$dataLocation[$num]['clientId'] = $clientId;
				$dataLocation[$num]['fiscalName'] = $fiscalName;
				$dataLocation[$num]['municipality'] = $municipality;
				
				//2 = Cliente = representante
				$roles = explode(",",$val['roles']);
				$dataLocation[$num]['roles'] = $roles;
					/*
					$representer = false;
					for($i=0; $i < count($roles); $i++ )
					{
						//echo $elem[$i]."<br>";
						if( $roles[$i] == 2 )
						{
							$dataLocation[$num]['client'] = "is_representer";
							$representer = true;
							break;
						}else{
							$dataLocation[$num]['client'] = "no_representer";
						}
					}
					*/
				$num++;
			}
			
			return $this->render("EmrBundle:Default:location.html.twig", array('data' => $user_repo, 'dataLocation'=>$dataLocation));
		}
		else
		{
			return $this->redirectToRoute("login");
		}
	}
	
	public function getDoctorsFromLocationAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		$idUser =  $this->getUser()->getUsuId();
		$locationId = $request->get("id");
		
		$location_repo = $em->getRepository("AppBundle:ClienteUsuario")->findBy( array("cliUsuCli"=>$locationId, "cliUsuUsu"=>$idUser, "cliUsuRol"=>2) );
		if( !$location_repo )
		{
			throw new AccessDeniedException('Acceso denegado');
		}
		else
		{
			$RAW_QUERY = "SELECT 
							cu.cli_usu_usu_id AS id, cu.cli_usu_correo as email, cu.cli_usu_exponer as exponer, cu.cli_usu_jvpm as jvpm,
							( 
								SELECT gu.gal_hash from usuario_galeria gu 
										WHERE gu.gal_usu_id = cu.cli_usu_usu_id AND gu.gal_tipo = 1 AND gu.gal_activo = 1 and gu.gal_cliente_id = $locationId 
							) as foto,
							( 
								SELECT CONCAT_WS(' ',u.usu_nombre,u.usu_segundo_nombre,u.usu_tercer_nombre,u.usu_primer_apellido,u.usu_segundo_apellido) 
								FROM usuario u WHERE u.usu_id = cu.cli_usu_usu_id  
							) as nombre,
							
							(
								SELECT u.usu_genero
								FROM usuario u
								WHERE u.usu_id = cu.cli_usu_usu_id
							) AS genero
							FROM cliente_usuario cu
							WHERE cu.cli_usu_cli_id = $locationId and cu.cli_usu_rol_id = 6
							";
			
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("idUser", $idUser );
			$statement->execute();
			$aDoctors = $statement->fetchAll();
			
			//var_dump($aDoctors);
		}
		
		
		return $this->render("EmrBundle:Default:locationHasDoctors.html.twig", array( 'doctors' => $aDoctors ));
	}
	
	public function checkSessionLocationAction( Request $request )
	{
		$location = $this->get('session')->get('locationId');
		if( !isset($location) )
		{
			$msg =  0;
			$path = $url = $this->generateUrl('emr_location', array(), true);
			$tag = "<div class='alert alert-danger alert-styled-left'>
					Debe de seleccionar un establecimiento para hacer un buen uso de la herramienta de lo contrario tendrá problemas, seleccione uno pulsando <a href=".$path.">Aquí</a>
					</div>";
			exit($tag);
			
		}else{
			$msg = 1;
		}
		
		return $this->render("EmrBundle:Default:noticeLocation.html.twig", array('msg'=>$msg));
	}
	
	public function getThubmanlImageProfileAction( Request $request )
	{

		$roles = $this->get('session')->get('userRoles');	
		$locationId = $this->get('session')->get('locationId');
		$idUser =  $this->getUser()->getUsuId();
		$em = $this->getDoctrine()->getManager();	
		$oUser = $em->getRepository('AppBundle:Usuario')->find( $idUser );
		
		$profilephoto = "";
		$oProfileImage = $em->getRepository('AppBundle:UsuarioGaleria')->findOneBy( array("galUsu"=>$idUser, "galCliente"=>$locationId, "galTipo"=>1) );
		if( isset($locationId) && !empty($locationId) )
		{
			

			if( $oProfileImage )
			{
				$hashImg = $oProfileImage->getGalHash();
				$srvImage = $this->get('srv_uploadFile');
				$res = $srvImage->fileExist("perfil/".$hashImg);
				if( $res )
				{
					$profilephoto = $hashImg;
				}
				
			}
		}
		return $this->render("EmrBundle:Default:profileImage.html.twig", array("userInfo"=> $oUser,'profilephoto'=>$profilephoto,'roles'=>$roles));
		
	}
	
	public function getAllMessagesAction( Request $request )
	{
		$roles = $this->get('session')->get('userRoles');	
		$locationId = $this->get('session')->get('locationId');
		$idUser =  $this->getUser()->getUsuId();
		$em = $this->getDoctrine()->getManager();	
		
		$unread = 0;
		
		if( $locationId != "")
		{
			$oUnReadMessage = $em->getRepository('AppBundle:SolicitudContacto')->findBy( array("scUsu"=>$idUser, "scCli"=>$locationId, "estado"=>0) );
			if( count($oUnReadMessage) > 0 )
			{
				$unread = count($oUnReadMessage);
			}
			
			$RAW_QUERY = "SELECT * FROM solicitud_contacto WHERE sc_cli_id = $locationId AND sc_usu_id = $idUser ORDER BY fecha_contacto DESC LIMIT 10"; 
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			//$statement->bindValue("idUser", $idUser );
			$statement->execute();
			$oMessages = $statement->fetchAll();
		}
		else{
			$oMessages = array();
		}
		
		
		
		
		//$oMessages = "";
		return $this->render("EmrBundle:Default:messages.html.twig", array("messages"=> $oMessages, "unread"=>$unread));
	}
	
	public function getDetailMessageAction( Request $request )
	{
		
		$id = $request->get("id");
		
		$roles = $this->get('session')->get('userRoles');	
		$locationId = $this->get('session')->get('locationId');
		$idUser =  $this->getUser()->getUsuId();
		$em = $this->getDoctrine()->getManager();	
		
		
		$RAW_QUERY = "SELECT * FROM solicitud_contacto WHERE sc_cli_id = $locationId AND sc_usu_id = $idUser AND id= $id"; 
		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		$oMessages = $statement->fetchAll();
		
		if( $oMessages && $oMessages[0]['estado'] == 0 )
		{
			$RAW_QUERY = "UPDATE solicitud_contacto SET estado = 1 WHERE id =  $id";
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->execute();
		}
		
		return  $response = new JsonResponse($oMessages);
		exit();
		
		
	}

}
