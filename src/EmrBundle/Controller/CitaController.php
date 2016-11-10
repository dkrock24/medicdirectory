<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\SysCita;
use EmrBundle\Form\SysCitaType;

class CitaController extends Controller
{
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	
	public function indexAction(){
		/*
		$em = $this->getDoctrine()->getManager();
		$girl_repo = $em->getRepository("LipsBundle:Girl");
		$girls = $girl_repo->findAll();
		
		return $this->render("LipsBundle:Girl:index.html.twig", array(
			"girls" => $girls
		));
		*/
	}
	
	public function addAction(Request $request)
	{	
		
		
		//$cita = new \AppBundle\Entity\SysCita();
		
		if ( $request->getMethod() == 'POST')
		{
			
			$em = $this->getDoctrine()->getEntityManager();
			//$iCountryID		= $request->get('country');
			$cita = new SysCita();
			$cita->setSysInstTieneArea( $request->get("name") );
			$cita->setSysUsuarioMedico($form->get("username")->getData());
			$cita->setSysUsuarioPaciente($form->get("age")->getData());
			$cita->setFechaCitaSysCita($form->get("price")->getData());
			$cita->setComentario($request->get("comentario_cita")->getData());
			$cita->setFechaCita($form->get("phone")->getData());

			$em->persist($cita);
			$flush = $em->flush();

			if ($flush == null) {
				$status = "Cita creada con éxito";
			} else {
				$status = "No se pudo crear el la cita ";
			}

			$this->session->getFlashBag()->add("status",$status);
			return $this->redirectToRoute("emr_cita_add");
		}

		return $this->render("EmrBundle:Cita:add.html.twig", array(
			//"form" => $form->createView()
		));
	}
	/*
	public function editAction(Request $request, $id){
		if($id)
		{
			$em = $this->getDoctrine()->getManager();
			$girl_repo = $em->getRepository("LipsBundle:Girl");	
			$girl = $girl_repo->find($id);

			$form = $this->createForm(GirlType::class, $girl);
			$form->handleRequest($request);	
			if ($form->isSubmitted()) {
				if ($form->isValid()) {
					$em = $this->getDoctrine()->getManager();

					//$girl = new Girl();
					$girl->setName($form->get("name")->getData());
					$girl->setUsername($form->get("username")->getData());
					$girl->setAge($form->get("age")->getData());
					$girl->setPrice($form->get("price")->getData());
					$girl->setPhone($form->get("phone")->getData());
					
					$file = $form['image']->getData();
					$ext=$file->guessExtension();
					$file_name=time().".".$ext;
					$file->move("uploads",$file_name);

					$girl->setImage($file_name);
					

					$em->persist($girl);
					$flush = $em->flush();

					if ($flush == null) {
						$status = "Registro editado con éxito";
					} else {
						$status = "No se pudo editar el registro ";
					}
				} else {
					$status = "Formulario invalido";
				}
				$this->session->getFlashBag()->add("status", $status);
				//return $this->redirectToRoute("lips_add_girl");
			}

			return $this->render("LipsBundle:Girl:edit.html.twig", array(
				"form" => $form->createView(),
				"girl" => $girl
			));
		}
	}
	 */
}
