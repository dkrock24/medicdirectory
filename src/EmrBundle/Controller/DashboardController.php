<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
	
	public function dashboardAction( Request $request )
    {
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
		{
			$em = $this->getDoctrine()->getManager();
			
			$roles = $this->get('session')->get('userRoles');
			
			$locationId = $this->get('session')->get('locationId');
			$idUser =  $this->getUser()->getUsuId();
			
			$oUser = $em->getRepository('AppBundle:Usuario')->find( $idUser );
			/*
			$RAW_QUERY = "SELECT * FROM usuario u 
							left join usuario_galeria ug ON u.usu_id = ug.gal_usu_id
							WHERE ug.gal_cliente_id =:client
							AND cu.cli_usu_rol_id = 2 "; //5 = Cliente( Representante )
			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->bindValue("client", $cliente->getCliId() );
			$statement->execute();
			$getUserRepresenter = $statement->fetchAll();
			*/
			//==================================================================
			//Get appointment
			//==================================================================
			//$filter = "";
			/*
				if (isset($doctorId) && $doctorId > 0) {
					$filter = " AND a.age_usu_id = " . $doctorId;
				}
			*/
			//----------------------------------
			//Events type
			//1 = Cita Médica
            //2 = Evento Personal
            //3 = Ausente
            //4 = Receso
            //5 = Otros
			//-----------------------------------
			
			$start = date("Y-m-d");
			$end = date("Y-m-d");
			$filter = " AND a.age_usu_id = " . $idUser;
			$RAW_QUERY = "SELECT a.age_id as id, a.age_fecha_inicio as start, a.age_fecha_fin as end, a.age_tipo_evento as tipo_evento,  p.pac_nombre, p.pac_seg_nombre, p.pac_apellido, p.pac_seg_apellido,p.pac_dui
								FROM agenda a
								LEFT JOIN cita c on c.cit_id = a.age_cit_id
								LEFT JOIN paciente p ON c.cit_pac_id = p.pac_id
								AND c.cit_activo = 1
								WHERE a.age_activo = 1
								AND a.age_cli_id = $locationId "
					. " AND  (date(a.age_fecha_inicio) >= '" . $start . "' AND date(a.age_fecha_inicio) <= '" . $end . "') "
					. $filter;


			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->execute();
			$appointments = $statement->fetchAll();

			$profilephoto = "";
			$oProfileImage = $em->getRepository('AppBundle:UsuarioGaleria')->findOneBy( array("galUsuario"=>$idUser, "galCliente"=>$locationId, "galTipo"=>1) );
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
			
			
			//Get unread messages
			//$roles = $this->get('session')->get('userRoles');	
			//$locationId = $this->get('session')->get('locationId');
			//$idUser =  $this->getUser()->getUsuId();
			//$em = $this->getDoctrine()->getManager();	

			$unread = 0;
			$oUnReadMessage = $em->getRepository('AppBundle:SolicitudContacto')->findBy( array("scUsuario"=>$idUser, "scCliente"=>$locationId, "estado"=>0) );
			
			if( count($oUnReadMessage) > 0 )
			{
				$unread = count($oUnReadMessage);
			}

			$RAW_QUERY = "SELECT * FROM solicitud_contacto WHERE sc_cli_id = $locationId AND sc_usu_id = $idUser ORDER BY fecha_contacto DESC LIMIT 20"; 
			$statement = $em->getConnection()->prepare($RAW_QUERY);
				//$statement->bindValue("idUser", $idUser );
			$statement->execute();
			$oMessages = $statement->fetchAll();
		}

		
		
		
		
        //$em = $this->getDoctrine()->getManager();
        return $this->render('EmrBundle:Dashboard:dashboard.html.twig', array(
			"profilephoto"=>$profilephoto,
			"userInfo"=> $oUser,
			"roles"=>$roles,
			"messages"=>$oMessages,
			'unReadMessage'=>$unread,
			"appointments"=>$appointments
        ));
    }
}
