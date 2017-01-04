<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysSugerencias;
use AppBundle\Form\SysSugerenciasType;

/**
 * SysSugerencias controller.
 *
 */
class SysSugerenciasController extends Controller
{
    /**
     * Lists all SysSugerencias entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysSugerencias = $em->getRepository('AppBundle:SysSugerencias')->findAll();

        return $this->render('AppBundle:syssugerencias:index.html.twig', array(
            'sysSugerencias' => $sysSugerencias,
        ));
    }

    /**
     * Creates a new SysSugerencias entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysSugerencia = new SysSugerencias();
        $form = $this->createForm('AppBundle\Form\SysSugerenciasType', $sysSugerencia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $sysSugerencia->setFechaCreacionSysSugerencia( new \DateTime(date('Y-m-d H:i:s')) );
            $em->persist($sysSugerencia);
            $flush = $em->flush();
            
            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('syssugerencias_show', array('id' => $sysSugerencia->getId()));
        }

        return $this->render('AppBundle:syssugerencias:new.html.twig', array(
            'sysSugerencia' => $sysSugerencia,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysSugerencias entity.
     *
     */
    public function showAction(SysSugerencias $sysSugerencia)
    {
        $deleteForm = $this->createDeleteForm($sysSugerencia);

        return $this->render('AppBundle:syssugerencias:show.html.twig', array(
            'sysSugerencia' => $sysSugerencia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysSugerencias entity.
     *
     */
    public function editAction(Request $request, SysSugerencias $sysSugerencia)
    {
        $deleteForm = $this->createDeleteForm($sysSugerencia);
        $editForm = $this->createForm('AppBundle\Form\SysSugerenciasType', $sysSugerencia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysSugerencia);
            $em->flush();

            return $this->redirectToRoute('syssugerencias_edit', array('id' => $sysSugerencia->getId()));
        }

        return $this->render('AppBundle:syssugerencias:edit.html.twig', array(
            'sysSugerencia' => $sysSugerencia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysSugerencias entity.
     *
     */
    public function deleteAction(Request $request, SysSugerencias $sysSugerencia)
    {
        $form = $this->createDeleteForm($sysSugerencia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysSugerencia);
            $em->flush();
        }

        return $this->redirectToRoute('syssugerencias_index');
    }

    /**
     * Creates a form to delete a SysSugerencias entity.
     *
     * @param SysSugerencias $sysSugerencia The SysSugerencias entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysSugerencias $sysSugerencia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('syssugerencias_delete', array('id' => $sysSugerencia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
