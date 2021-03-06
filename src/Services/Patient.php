<?php

namespace Services;

//use \AppBundle\Entity\Menu;
use Symfony\Component\Validator\Constraints\DateTime;
class Patient {
	
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
	
	/**
	*
	* @param  $idUser ID del paciente
	*/
	public function getAppointments($idUser)
	{
		//===========================================
		//Get all user's appointment 
		//============================================
		$RAW_QUERY = "SELECT a.age_id, u.usu_id as id_doctor, u.usu_nombre AS doctor, a.age_id AS id_agenda, a.age_fecha_inicio AS fecha_inicio, a.age_fecha_fin AS fecha_fin, 
						CASE a.age_estado 
						WHEN 'p' THEN 'Pendiente' 
						WHEN 'a' THEN 'Anulada'
						WHEN 'c' THEN 'En curso'
						WHEN 't' THEN 'Terminada'
						END AS estado, a.age_estado as letra_estado
						FROM cita c
						INNER JOIN agenda a ON c.cit_id = a.age_cit_id
						LEFT JOIN usuario u ON c.cit_usu_id = u.usu_id
						WHERE c.cit_cli_id =:idClient
						AND c.cit_pac_id =:patientId 
						ORDER BY a.age_fecha_inicio ASC"; 
		$statement = $this->em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("patientId", $idUser );
		$statement->bindValue("idClient", $this->locationId );
		$statement->execute();
		$appointmentsList = $statement->fetchAll();
		
		return $appointmentsList;
	}
	
	
	public function getDoctorsPerPatient( $idUser )
	{
		
				//===========================================
		//Get all user's appointment 
		//============================================
		//$locationId = $this->session->get('locationId');
		$RAW_QUERY = "SELECT u.*, cu.cli_usu_titulo as title_doctor
						FROM cita c
						INNER JOIN agenda a ON c.cit_id = a.age_cit_id
						LEFT JOIN usuario u ON c.cit_usu_id = u.usu_id
						LEFT JOIN cliente_usuario cu ON u.usu_id = cu.cli_usu_usu_id
						WHERE c.cit_cli_id =:idClient
						AND c.cit_pac_id =:patientId
						AND cu.cli_usu_rol_id = 6
						GROUP BY u.usu_id "; 
		$statement = $this->em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("patientId", $idUser );
		$statement->bindValue("idClient", $this->locationId);
		$statement->execute();
		$doctorstList = $statement->fetchAll();
		
		return $doctorstList;
	}
	
	
	public function getMedicalConsultation( $idUser )
	{
		
				//===========================================
		//Get all user's appointment 
		//============================================
		//$locationId = $this->session->get('locationId');
		$RAW_QUERY = "SELECT count(*) as total
						FROM cita c
						INNER JOIN agenda a ON c.cit_id = a.age_cit_id
						LEFT JOIN usuario u ON c.cit_usu_id = u.usu_id
						WHERE c.cit_cli_id =:idClient
						AND c.cit_pac_id =:patientId
						AND a.age_estado = 't' "; 
		$statement = $this->em->getConnection()->prepare($RAW_QUERY);
		$statement->bindValue("patientId", $idUser );
		$statement->bindValue("idClient", $this->locationId);
		$statement->execute();
		$doctorstList = $statement->fetchAll();
		
		return $doctorstList;
	}
	
	
	function getAge($fecha)
	{
		if( !empty($fecha) )
		{
			$fecha_nac = new \DateTime(date('Y/m/d',strtotime($fecha))); // Creo un objeto DateTime de la fecha ingresada
			$fecha_hoy =  new \DateTime(date('Y/m/d',time())); // Creo un objeto DateTime de la fecha de hoy
			$edad = date_diff($fecha_hoy,$fecha_nac); // La funcion ayuda a calcular la diferencia, esto seria un objeto
			return "{$edad->format('%Y')} años y {$edad->format('%m')} meses"; // Aplicamos un formato al objeto resultante de la funcion
		}
		
	}
  
	//$edad = calcular_edad('1999-12-31');

}
