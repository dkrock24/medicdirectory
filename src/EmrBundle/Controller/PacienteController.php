<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\Paciente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Paciente controller.
 *
 */
class PacienteController extends Controller
{
    /**
     * Lists all paciente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();
		
        return $this->render('EmrBundle:paciente:index.html.twig', array(
            'pacientes' => $pacientes,
        ));
    }

    /**
     * Creates a new paciente entity.
     *
     */
    public function newAction(Request $request)
    {
        $paciente = new Paciente();
        $form = $this->createForm('EmrBundle\Form\PacienteType', $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush($paciente);

            return $this->redirectToRoute('paciente_show', array('id' => $paciente->getId()));
        }

        return $this->render('EmrBundle:paciente:new.html.twig', array(
            'paciente' => $paciente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paciente entity.
     *
     */
    public function showAction(Paciente $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);

        return $this->render('EmrBundle:paciente:show.html.twig', array(
            'paciente' => $paciente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paciente entity.
     *
     */
    public function editAction(Request $request, Paciente $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);
        $editForm = $this->createForm('EmrBundle\Form\PacienteType', $paciente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paciente_edit', array('id' => $paciente->getId()));
        }

        return $this->render('EmrBundle:paciente:edit.html.twig', array(
            'paciente' => $paciente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paciente entity.
     *
     */
    public function deleteAction(Request $request, Paciente $paciente)
    {
        $form = $this->createDeleteForm($paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paciente);
            $em->flush();
        }

        return $this->redirectToRoute('paciente_index');
    }

    /**
     * Creates a form to delete a paciente entity.
     *
     * @param Paciente $paciente The paciente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Paciente $paciente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paciente_delete', array('id' => $paciente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
	
	//custom Functions
	public function getStatesFromCountryAction( Request $request )
	{
		
		$result = "";
		$iCountryId = $request->get('id');
		
		if( isset($iCountryId) )
		{
			$em = $this->getDoctrine()->getManager();
			$RAW_QUERY = "SELECT m.mun_id, m.mun_nombre, d.dep_departamento FROM departamento d "
						. " inner join municipio m on d.dep_id = m.mun_dep_id where d.dep_pai_id = $iCountryId ";

			$statement = $em->getConnection()->prepare($RAW_QUERY);
			$statement->execute();

			$result = $statement->fetchAll();
		}
		
		return  $response = new JsonResponse($result);
		/*
		return  $response->setData(array(
			'data' => $result
		));
		*/

	}
	
	public function formPacientesAction( Request $request )
	{
		$id = $request->get('id');
		$firts_name = $request->get('firts_name');
		$middle_name = $request->get('middle_name');
		$last_name = $request->get('last_name');
		$middle_last_name = $request->get('middle_last_name');
		$gender = $request->get('gender');
		$dui = $request->get('dui');
		
		$blood_type = $request->get('blood_type');
		$email = $request->get('email');
		$civil_state = $request->get('civil_state');
		$municipality = $request->get('municipality');
		$address = $request->get('address');
		$home_phone = $request->get('home_phone');
		
		$work_phone = $request->get('work_phone');
		$cellphone = $request->get('cellphone');
		$date = $request->get('date');
		$img = $request->get('img');
		
		$em = $this->getDoctrine()->getManager();

        $status = 0;
		try
		{
			if( isset($municipality) )
			{
				$municipality = $em->getRepository('AppBundle:Municipio')->find($municipality);
			}

			if( isset($id) && $id > 0 )
			{
				
			}
			else
			{
				$oPatient = new Paciente();
				$oPatient->setPacNombre($firts_name);
				$oPatient->setPacSegNombre($middle_name);
				$oPatient->setPacApellido($last_name);
				$oPatient->setPacSegApellido($middle_last_name);
				$oPatient->setPacGenero($gender);
				$oPatient->setPacDui($dui);
				$oPatient->setPacTipSangre($blood_type);
				$oPatient->setPacEmail($email);
				$oPatient->setPacEstadoCivil($civil_state);
				$oPatient->setPacMun( $municipality );
				$oPatient->setPacDireccion($address);
				$oPatient->setPacTelCasa($home_phone);
				$oPatient->setPacTelTrabajo($work_phone);
				$oPatient->setPacTelCelular($cellphone);
				$oPatient->setPacFechaNacimiento(new \Datetime($date) );
				$oPatient->setPacFechaCrea(new \Datetime()); //Fecha de creacion
			}

			$em->persist($oPatient);			
			$flush = $em->flush();
			if ($flush == null)
			{
				$status = 1; //success
			}else{
				$status = 0; //error
			}
		}
		catch (\Exception $e)
		{
			echo ($e->getMessage());
		}
		
		
		echo $status;
		exit();
		
	}
	
	
	public function savePicture($img)
	{
		
		$fs = new Filesystem();
		
		try {
			$fs->mkdir('/tmp/random/dir/'.mt_rand());
		} catch (IOExceptionInterface $e) {
			echo "An error occurred while creating your directory at ".$e->getPath();
		}
		
		/*
			$filename = "test.png";
			$img = $_POST['img'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			file_put_contents("images/".$filename, $data);
		 */
	}
}
