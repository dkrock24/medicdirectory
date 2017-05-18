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
	
	
	public function locationAction( Request $request )
	{
		//echo "ss";
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
		{
		
			$em = $this->getDoctrine()->getManager();
			$idUser =  $this->getUser()->getUsuId();
			//$municipality = 
			
			/*
			$RAW_QUERY = "SELECT distinct(cu.cli_usu_rol_id), cu.* FROM cliente c 
							inner join cliente_usuario cu on cu.cli_usu_cli_id = c.cli_id
							inner join usuario u on u.usu_id = cu.cli_usu_usu_id
							where u.usu_id =:idUser
							
							"; 
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("idUser", $idUser );
			$statement->execute();
			$aRols = $statement->fetchAll();
			
			$rolsList = array();
			foreach( $aRols as $r)
			{
				//$rolsList[ $r['cli_usu_rol_id'] ][] = $r['cli_usu_rol_id'];
				$rolsList[ $r['cli_usu_cli_id'] ][] = $r['cli_usu_rol_id'];
			}
			*/

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
				/*
					foreach( $rolsList[$clientId] as $elem )
					{
						$representer = false;
						for($i=0; $i < count($elem); $i++ )
						{
							//echo $elem[$i]."<br>";
							if( $elem[$i] == 2 )
							{
								$dataLocation[$num]['client'] = "is_representer";
								$representer = true;
								break;
							}else{
								$dataLocation[$num]['client'] = "no_representer";
							}
						}
						if( $representer ){
							break;
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
	
	public function checkSessionLocationAction( Request $request )
	{
		$location = $this->get('session')->get('locationId');
		if( !isset($location) )
		{
			$msg =  0;
			//return $this->redirectToRoute("emr_location");
			//throw $this->createNotFoundException("<a href='xxx'>xxxx</a>");
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

}
