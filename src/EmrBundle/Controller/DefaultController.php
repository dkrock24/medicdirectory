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
			//var_dump($rolsList);
			//exit();
			//echo count($rolsList);
			//echo "<hr>";
			//echo $this->get('security.token_storage')->getToken()->getUser()->getUsuId();
			$user_repo = $em->getRepository("AppBundle:ClienteUsuario")->findByCliUsuUsu($idUser);
			
			//$em = $this->getDoctrine()->getManager();
			$user_repo = $em->createQuery(
						'SELECT cu
						FROM AppBundle:ClienteUsuario cu
						WHERE cu.cliUsuUsu =:userId 
						GROUP BY cu.cliUsuCli'
					)
					->setParameter('userId', $idUser)    
					->getResult();
			
			
			$dataLocation = array();
			$num = 0;
			foreach( $user_repo as $val)
			{
				$fiscalName = $val->getCliUsuCli()->getCliNombreFiscal();
				$clientId = $val->getCliUsuCli()->getCliId();
				$municipality = $val->getCliUsuCli()->getCliMun()->getMunNombre();
				
				//$clientId =  $val->getCliUsuCli()->getCliId();
				
				
				$dataLocation[$num]['clientId'] = $clientId;
				$dataLocation[$num]['fiscalName'] = $fiscalName;
				$dataLocation[$num]['municipality'] = $municipality;
				
				//2 = Cliente = representante
				//$dataLocation[$num]['client'] = "no_representer";
				//for($i=0; $i < count($rolsList); $i++ )
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
				/*
				if (array_key_exists($clientId, $rolsList)) 
				{
					if (in_array("2", $rolsList[$clientId]) ) {
						$dataLocation[$num]['client'] = "is_representer";
					}else{
						$dataLocation[$num]['client'] = "no_representer";
					}
					
					//echo "The 'first' element is in the array";
				}else{
					$dataLocation[$num]['client'] = "no_representer";
					//echo "else";
				}
				*/
				
				
				
				$num++;
			}
			
			//var_dump($dataLocation);
			
			//return $this->redirectToRoute("");
			
			//echo "zzzz";
			
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
