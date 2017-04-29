<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use \AppBundle\Entity\Cita;

class CitaController extends Controller
{
	
	public function newAction( Request $request  )
    {
		
		return $this->render("EmrBundle:cita:new.html.twig");
        
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
				$RAW_QUERY = "SELECT cit_id as id, cit_hora_inicio_cita as start, cit_hora_fin_cita as end, cit_notas as title FROM cita  WHERE  (date(cit_hora_inicio_cita) >= '".$start."' AND date(cit_hora_inicio_cita) <= '".$end."')";

				$statement = $em->getConnection()->prepare($RAW_QUERY);
				//$statement->bindValue("username", $sUsername);
				$statement->execute();
				$events = $statement->fetchAll();
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
				echo date("Y-m-d H:i:s",strtotime($end) );
				$obAppointment= new Cita();
				$obAppointment->setCitHoraInicioCita( new \DateTime( date("Y-m-d H:i:s",strtotime($start) ) ) ) ; //setUsuRolUsuarios(  $representer_repo );
				$obAppointment->setCitHoraFinCita(new \DateTime( date("Y-m-d H:i:s",strtotime($end) ) ) );
				$obAppointment->setCitNotas($title);
				$em->persist($obAppointment);
				$flush = $em->flush();
				$lastAppointment = $obAppointment->getUsuId();
				
				header("Content-Type: application/json");

				echo "{'id':$lastAppointment}";

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
