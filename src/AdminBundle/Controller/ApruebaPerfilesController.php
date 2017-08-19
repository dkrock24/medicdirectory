<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Pais;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;



/**
 * Pai controller.
 *
 */
class ApruebaPerfilesController extends Controller
{
	
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	
	
	public function showAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$RAW_QUERY = "SELECT 
						gal.gal_id, gal.gal_usu_id, gal.gal_cliente_id, gal.gal_hash, gal.gal_activo, gal.gal_aprobado,
						(SELECT cu.cli_usu_correo FROM cliente_usuario cu WHERE cu.cli_usu_usu_id = gal.gal_usu_id AND cu.cli_usu_rol_id = 6 ) as email,
						(SELECT cu.cli_usu_jvpm FROM cliente_usuario cu WHERE cu.cli_usu_usu_id = gal.gal_usu_id AND cu.cli_usu_rol_id = 6 ) as jvpm,
						(
							SELECT CONCAT_WS(' ', cu.cli_usu_titulo, u.usu_nombre, u.usu_segundo_nombre, u.usu_tercer_nombre, u.usu_primer_apellido, u.usu_segundo_apellido  ) as nombre
								FROM cliente_usuario cu
								INNER JOIN usuario u ON cu.cli_usu_usu_id = u.usu_id 
								WHERE cu.cli_usu_usu_id = gal.gal_usu_id AND cu.cli_usu_rol_id = 6 
						) as nombre_doctor,
						(SELECT cu.cli_usu_telefono FROM cliente_usuario cu WHERE cu.cli_usu_usu_id = gal.gal_usu_id AND cu.cli_usu_rol_id = 6 ) as telefono,
						(
							SELECT c.cli_nombre
								FROM cliente c
								WHERE c.cli_id = gal.gal_cliente_id
						) as nombre_cliente
					FROM usuario_galeria gal
					WHERE gal.gal_activo = 1 AND gal.gal_tipo = 1 AND gal.gal_aprobado = 0 AND gal.gal_hash IS NOT NULL
					"; 
		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		$getList = $statement->fetchAll();

        return $this->render('AdminBundle:aprueba_perfiles:show.html.twig', array(
            'list' => $getList,
            //'delete_form' => $deleteForm->createView(),
        ));
    }
	
	public function validAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		
		$ids = $request->get('id');
		$option = $request->get('option');
		
		if( $option == "btnSetSelectedAprove" )
		{
			$gal_opt = 1;
		}else{
			$gal_opt = 0;
		}	
		
		$RAW_QUERY = "UPDATE usuario_galeria SET gal_aprobado = ".$gal_opt." WHERE gal_id IN (".$ids.") ";
		$statement = $em->getConnection()->prepare($RAW_QUERY);
		$statement->execute();
		
		exit();
	}
	
	public function getImageProfileAction(Request $request)
	{
		$img = $request->get('img');
		return $this->render('AdminBundle:aprueba_perfiles:_printPhoto.html.twig', array(
            'image' => $img
        ));
	}
	

    /**
     * Creates a new pai entity.
     *
     */
    public function newAction(Request $request)
    {
        $pai = new Pais;
        $form = $this->createForm('AdminBundle\Form\PaisType', $pai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			
			$pai->setPaiFechaCrea(new \DateTime());
			
            $em->persist($pai);
            $flush = $em->flush($pai);
			
			if ($flush == null)
			{
				$msgBox = "Registro creado con éxito";
				$status = "success";
			} else {
				$msgBox = "No se pudo crear el registro ";
				$status = "error";
			}
			
			$this->session->getFlashBag()->add($status,$msgBox);
			return $this->redirectToRoute('pais_show', array('id' => $pai->getPaiId()));
        }

        return $this->render('AdminBundle:pais:new.html.twig', array(
            'pai' => $pai,
            'form' => $form->createView(),
        ));
    }


}
