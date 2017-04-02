<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Departamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Departamento controller.
 *
 */
class DepartamentoController extends Controller
{
	
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
    /**
     * Lists all departamento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('AppBundle:Departamento')->findAll();

        return $this->render('AdminBundle:departamento:index.html.twig', array(
            'departamentos' => $departamentos,
        ));
    }

    /**
     * Creates a new departamento entity.
     *
     */
    public function newAction(Request $request)
    {
        $departamento = new Departamento();
        $form = $this->createForm('AdminBundle\Form\DepartamentoType', $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			$departamento->setDepFechaCrea( new \DateTime() );
            $em->persist($departamento);
            $flush = $em->flush($departamento);
			
			if ($flush == null)
			{
				$msgBox = "Registro creado con éxito";
				$status = "success";
			} else {
				$msgBox = "No se pudo crear el registro ";
				$status = "error";
			}
			
			$this->session->getFlashBag()->add($status,$msgBox);

            return $this->redirectToRoute('departamento_show', array('id' => $departamento->getDepId()));
        }

        return $this->render('AdminBundle:departamento:new.html.twig', array(
            'departamento' => $departamento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a departamento entity.
     *
     */
    public function showAction(Departamento $departamento)
    {
        $deleteForm = $this->createDeleteForm($departamento);

        return $this->render('AdminBundle:departamento:show.html.twig', array(
            'departamento' => $departamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing departamento entity.
     *
     */
    public function editAction(Request $request, Departamento $departamento)
    {
        $deleteForm = $this->createDeleteForm($departamento);
        $editForm = $this->createForm('AdminBundle\Form\DepartamentoType', $departamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
			
            $em = $this->getDoctrine()->getManager();
			
			
			//Update field dep_fecha_mod
			$id = $editForm->getData()->getDepId();
			$item = $em->getRepository('AppBundle:Departamento')->find($id);
			$item->setDepFechaMod(new \DateTime());
			//end 
			$flush = $em->flush($item);
			
			if ($flush == null)
			{
				$msgBox = "Registro actualizado con éxito";
				$status = "success";
			} else {
				$msgBox = "No se ha podido actualizar el registro ";
				$status = "error";
			}
			
			$this->session->getFlashBag()->add($status,$msgBox);

            return $this->redirectToRoute('departamento_edit', array('id' => $departamento->getDepId()));
        }

        return $this->render('AdminBundle:departamento:edit.html.twig', array(
            'departamento' => $departamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a departamento entity.
     *
     */
    public function deleteAction(Request $request, Departamento $departamento)
    {
        $form = $this->createDeleteForm($departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departamento);
			
			$flush = $em->flush();
			
			if ($flush == null)
			{
				$msgBox = "El registro fue eliminado con éxito";
				$status = "success";
			} else {
				$msgBox = "No se ha podido eliminar el registro ";
				$status = "error";
			}
			
			$this->session->getFlashBag()->add($status,$msgBox);
        }

        return $this->redirectToRoute('departamento_index');
    }
	
	
	public function deleteCustomAction( Request $request )
	{
		$iId = $request->request->get('id');
		//$iId = $request->query->get('id');
		
		if( isset($iId) && $iId > 0 )
		{
			
			try
			{
				$em = $this->getDoctrine()->getManager();
				$repo = $em->getRepository("AppBundle:Departamento");	
				$item = $repo->find($iId);
				$em->remove($item);
				$flush = $em->flush();

				if ($flush == null)
				{
					echo 1;
				} else {
					echo 0;
				}
				
			}catch (\Exception $e){
				echo ($e->getMessage());
			}
			
		}
		
		exit();
	}

    /**
     * Creates a form to delete a departamento entity.
     *
     * @param Departamento $departamento The departamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departamento $departamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('departamento_delete', array('id' => $departamento->getDepId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
