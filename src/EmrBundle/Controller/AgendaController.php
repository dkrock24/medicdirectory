<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use \AppBundle\Entity\Cita;

class AgendaController extends Controller
{
	
	public function newAction( Request $request  )
    {
		$em = $this->getDoctrine()->getManager();
		
		
		$doctor = $request->get("d");
		
		$patient = $request->get("p");
		
		//==================================================
		//get all user roles logged
		//==================================================
		$userRoles = $this->get('session')->get('userRoles');
		
		//==================================================
		//get all doctors from this establishment
		//==================================================
		
		$locationId = $this->get('session')->get('locationId');
		if( !$locationId )
		{
			return $this->redirectToRoute("emr_location");
		}
		
		$RAW_QUERY = "SELECT u.* FROM cliente_usuario cu
						INNER JOIN usuarios_rol ur on cu.cli_usu_usu_id = ur.urol_usu_id
						INNER JOIN usuario u on cu.cli_usu_usu_id = u.usu_id 
						where cli_usu_cli_id =:locationId
						and ur.urol_rol_id = 6 ORDER BY u.usu_nombre asc ";

		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("locationId", $locationId);
		$statement->execute();
		$doctorList = $statement->fetchAll();
		
		//================================================
		//Check if the doctor exists in the location
		//================================================
		if( isset($doctor) )
		{
			$is_available = false;
			foreach($doctorList as $value )
			{
				if($doctor == $value['usu_id'])
				{
					$is_available = true;
				}
			}
			
			if( !$is_available )
			{
				return $this->redirectToRoute("agenda_new");
			}
		}
		
		return $this->render("EmrBundle:agenda:new.html.twig", array(
			"userRoles" => $userRoles,
			"doctorList"=> $doctorList	
		));
        
    }
	
	
	public function validAppointmentAction( Request $request )
	{
		$em = $this->getDoctrine()->getManager();
		
		$action = $request->get("action");
		$view = $request->get("view");
		$title = $request->get("title");
		$start = $request->get("start");
		$end = $request->get("end");
		if (isset($action) or isset($view))
		{
			//show all events
			if (isset($view))
			{

				header("Content-Type: application/json");
				//$start = mysqli_real_escape_string($connection, $_GET["start"]);
				//$end = mysqli_real_escape_string($connection, $_GET["end"]);
				//$result = "";//mysqli_query($connection, "SELECT id, start ,end ,title FROM  events where (date(start) >= "$start" AND date(start) <= "$end")");
				$RAW_QUERY = "SELECT a.age_id as id, a.age_fecha_inicio as start, a.age_fecha_fin as end, a.age_tipo_evento as tipo_evento FROM agenda a
								LEFT JOIN cita c on c.cit_id = a.age_cit_id
								AND c.cit_activo = 1
								WHERE a.age_activo = 1"
							. " AND  (date(a.age_fecha_inicio) >= '".$start."' AND date(a.age_fecha_inicio) <= '".$end."')";

				$statement = $em->getConnection()->prepare($RAW_QUERY);
				//$statement->bindValue("username", $sUsername);
				$statement->execute();
				$rs = $statement->fetchAll();
				
				//var_dump($events);
				
				$events = array();
				foreach( $rs as $key)
				{
					$ar = array();
					$ar['start'] = $key['start'];
					$ar['end'] = $key['end'];
					
					
					switch ( $key['tipo_evento'] )
					{
						case 1:
							$color = "#0E77AE";
							$event = " Cita médica";
							break;
						case 2:
							$color = "#26A69A";
							$event = " Evento Personal ";
							break;
						case 3:
							$color = "#3a3a3a";
							$event = " Ausente ";
							break;
						case 4:
							$color = "#93c54b";
							$event = "Tiempo de Comida";	
						default;
							$color = "#FF7043";
							$event = "Otros";
							break;
					}
					
					$ar['title'] = $event;
					$ar['color'] = $color;
					//$ar['rendering'] = "background";
					array_push($events, $ar);
				}
				/*
				while ($row = mysqli_fetch_assoc($result)) {

					$events[] = $row;
				}
				*/
				echo json_encode($events);

				exit;
			}
			elseif ($_POST["action"] == "add") 
			{ 
				// add new event

				/*
				mysqli_query($connection, "INSERT INTO events ( title ,start ,end )

                    VALUES ("".mysqli_real_escape_string($connection,$_POST["title"])."",

                    "".mysqli_real_escape_string($connection,date("Y-m-d H:i:s",strtotime($_POST["start"])))."",

                    "".mysqli_real_escape_string($connection,date("Y-m-d H:i:s",strtotime($_POST["end"]))).""

                    )");
				*/

				/*	
				$obAppointment= new Cita();
				$obAppointment->setCitHoraInicioCita( new \DateTime( date("Y-m-d H:i:s",strtotime($start) ) ) ) ; //setUsuRolUsuarios(  $representer_repo );
				$obAppointment->setCitHoraFinCita(new \DateTime( date("Y-m-d H:i:s",strtotime($end) ) ) );
				$obAppointment->setCitNotas($title);
				$em->persist($obAppointment);
				$flush = $em->flush();
				$lastAppointment = $obAppointment->getUsuId();
				
				header("Content-Type: application/json");

				echo "{'id':$lastAppointment}";
				*/
				exit;
			} elseif ($_POST["action"] == "update") {  // update event

				/*
				mysqli_query($connection, "UPDATE events set 

				start = "".mysqli_real_escape_string($connection,date("Y-m-d H:i:s",strtotime($_POST["start"])))."", 

				end = "".mysqli_real_escape_string($connection,date("Y-m-d H:i:s",strtotime($_POST["end"])))."" 

				where id = "".mysqli_real_escape_string($connection,$_POST["id"]).""");
				*/
				exit;
			} elseif ($_POST["action"] == "delete") {  // remove event
				/*
				mysqli_query($connection, "DELETE from events where id = "".mysqli_real_escape_string($connection,$_POST["id"]).""");

				if (mysqli_affected_rows($connection) > 0) {

					echo "1";
				}
				*/
				exit;
			}
		}
	}

}
