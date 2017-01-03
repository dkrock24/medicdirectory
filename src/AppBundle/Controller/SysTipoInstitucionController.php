<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysTipoInstitucion;
use AppBundle\Form\SysTipoInstitucionType;

/**
 * SysTipoInstitucion controller.
 *
 */
class SysTipoInstitucionController extends Controller
{
    /**
     * Lists all SysTipoInstitucion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysTipoInstitucions = $em->getRepository('AppBundle:SysTipoInstitucion')->findAll();

        return $this->render('AppBundle:systipoinstitucion:index.html.twig', array(
            'sysTipoInstitucions' => $sysTipoInstitucions,
        ));
    }

    /**
     * Creates a new SysTipoInstitucion entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysTipoInstitucion = new SysTipoInstitucion();
        $form = $this->createForm('AppBundle\Form\SysTipoInstitucionType', $sysTipoInstitucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysTipoInstitucion);
            $flush = $em->flush();
			
			if ($flush == null) {
				$this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
			} else {
				$this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
			}

            return $this->redirectToRoute('systipoinstitucion_show', array('id' => $sysTipoInstitucion->getId()));
        }

        return $this->render('AppBundle:systipoinstitucion:new.html.twig', array(
            'sysTipoInstitucion' => $sysTipoInstitucion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysTipoInstitucion entity.
     *
     */
    public function showAction(SysTipoInstitucion $sysTipoInstitucion)
    {
        $deleteForm = $this->createDeleteForm($sysTipoInstitucion);

        return $this->render('AppBundle:systipoinstitucion:show.html.twig', array(
            'sysTipoInstitucion' => $sysTipoInstitucion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysTipoInstitucion entity.
     *
     */
    public function editAction(Request $request, SysTipoInstitucion $sysTipoInstitucion)
    {
        $deleteForm = $this->createDeleteForm($sysTipoInstitucion);
        $editForm = $this->createForm('AppBundle\Form\SysTipoInstitucionType', $sysTipoInstitucion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysTipoInstitucion);
            $flush = $em->flush();
			
			if ($flush == null) {
				$this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
			} else {
				$this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
			}

            return $this->redirectToRoute('systipoinstitucion_edit', array('id' => $sysTipoInstitucion->getId()));
        }

        return $this->render('AppBundle:systipoinstitucion:edit.html.twig', array(
            'sysTipoInstitucion' => $sysTipoInstitucion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysTipoInstitucion entity.
     *
     */
    public function deleteAction(Request $request, SysTipoInstitucion $sysTipoInstitucion)
    {
        $form = $this->createDeleteForm($sysTipoInstitucion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysTipoInstitucion);
            $em->flush();
        }

        return $this->redirectToRoute('systipoinstitucion_index');
    }

    /**
     * Creates a form to delete a SysTipoInstitucion entity.
     *
     * @param SysTipoInstitucion $sysTipoInstitucion The SysTipoInstitucion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysTipoInstitucion $sysTipoInstitucion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('systipoinstitucion_delete', array('id' => $sysTipoInstitucion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
