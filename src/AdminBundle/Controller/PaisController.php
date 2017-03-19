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
class PaisController extends Controller
{
	
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
	
    /**
     * Lists all pai entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pais = $em->getRepository('AppBundle:Pais')->findAll();
		//exit("x");
        return $this->render('AdminBundle:pais:index.html.twig', array(
            'pais' => $pais,
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

    /**
     * Finds and displays a pai entity.
     *
     */
    public function showAction(Pais $pai)
    {
        $deleteForm = $this->createDeleteForm($pai);

        return $this->render('AdminBundle:pais:show.html.twig', array(
            'pai' => $pai,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pai entity.
     *
     */
    public function editAction(Request $request, Pais $pai)
    {
        $deleteForm = $this->createDeleteForm($pai);
        $editForm = $this->createForm('AdminBundle\Form\PaisType', $pai);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
			
            $flush = $this->getDoctrine()->getManager()->flush();
			
			if ($flush == null)
			{
				$msgBox = "Registro actualizado con éxito";
				$status = "success";
			} else {
				$msgBox = "No se ha podido actualizar el registro ";
				$status = "error";
			}
			
			$this->session->getFlashBag()->add($status,$msgBox);
            return $this->redirectToRoute('pais_edit', array('id' => $pai->getPaiId()));
        }

        return $this->render('AdminBundle:pais:edit.html.twig', array(
            'pai' => $pai,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pai entity.
     *
     */
    public function deleteAction(Request $request, Pais $pai)
    {
        $form = $this->createDeleteForm($pai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pai);
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

        return $this->redirectToRoute('pais_index');
    }
	
	public function deleteCustomAction( Request $request )
	{
		$iId = $request->request->get('id');
		//$iId = $request->query->get('id');
		
		if( isset($iId) && $iId > 0 )
		{
			$em = $this->getDoctrine()->getManager();
			$repo = $em->getRepository("AppBundle:Pais");	
			$item = $repo->find($iId);
			$em->remove($item);
			$flush = $em->flush();
			
			if ($flush == null)
			{
				echo 1;
			} else {
				echo 0;
			}
		}
		
		exit();
	}

    /**
     * Creates a form to delete a pai entity.
     *
     * @param Pais $pai The pai entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pais $pai)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pais_delete', array('id' => $pai->getPaiId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
