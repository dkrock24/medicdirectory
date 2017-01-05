<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysPeriodosMedico;
use AppBundle\Form\SysPeriodosMedicoType;

/**
 * SysPeriodosMedico controller.
 *
 */
class SysPeriodosMedicoController extends Controller
{
    /**
     * Lists all SysPeriodosMedico entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysPeriodosMedicos = $em->getRepository('AppBundle:SysPeriodosMedico')->findAll();

        return $this->render('AppBundle:sysperiodosmedico:index.html.twig', array(
            'sysPeriodosMedicos' => $sysPeriodosMedicos,
        ));
    }

    /**
     * Creates a new SysPeriodosMedico entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysPeriodosMedico = new SysPeriodosMedico();
        $form = $this->createForm('AppBundle\Form\SysPeriodosMedicoType', $sysPeriodosMedico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysPeriodosMedico);
            $flush = $em->flush();
            
            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('sysperiodosmedico_show', array('id' => $sysPeriodosMedico->getId()));
        }

        return $this->render('AppBundle:sysperiodosmedico:new.html.twig', array(
            'sysPeriodosMedico' => $sysPeriodosMedico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysPeriodosMedico entity.
     *
     */
    public function showAction(SysPeriodosMedico $sysPeriodosMedico)
    {
        $deleteForm = $this->createDeleteForm($sysPeriodosMedico);

        return $this->render('AppBundle:sysperiodosmedico:show.html.twig', array(
            'sysPeriodosMedico' => $sysPeriodosMedico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysPeriodosMedico entity.
     *
     */
    public function editAction(Request $request, SysPeriodosMedico $sysPeriodosMedico)
    {
        $deleteForm = $this->createDeleteForm($sysPeriodosMedico);
        $editForm = $this->createForm('AppBundle\Form\SysPeriodosMedicoType', $sysPeriodosMedico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysPeriodosMedico);
            $em->flush();

            return $this->redirectToRoute('sysperiodosmedico_edit', array('id' => $sysPeriodosMedico->getId()));
        }

        return $this->render('AppBundle:sysperiodosmedico:edit.html.twig', array(
            'sysPeriodosMedico' => $sysPeriodosMedico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysPeriodosMedico entity.
     *
     */
    public function deleteAction(Request $request, SysPeriodosMedico $sysPeriodosMedico)
    {
        $form = $this->createDeleteForm($sysPeriodosMedico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysPeriodosMedico);
            $em->flush();
        }

        return $this->redirectToRoute('sysperiodosmedico_index');
    }

    /**
     * Creates a form to delete a SysPeriodosMedico entity.
     *
     * @param SysPeriodosMedico $sysPeriodosMedico The SysPeriodosMedico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysPeriodosMedico $sysPeriodosMedico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysperiodosmedico_delete', array('id' => $sysPeriodosMedico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
