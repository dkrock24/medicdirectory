<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvTipoMovimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Invtipomovimiento controller.
 *
 */
class InvTipoMovimientoController extends Controller
{
    /**
     * Lists all invTipoMovimiento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invTipoMovimientos = $em->getRepository('AppBundle:InvTipoMovimiento')->findAll();

        return $this->render('invtipomovimiento/index.html.twig', array(
            'invTipoMovimientos' => $invTipoMovimientos,
        ));
    }

    /**
     * Creates a new invTipoMovimiento entity.
     *
     */
    public function newAction(Request $request)
    {
        $invTipoMovimiento = new Invtipomovimiento();
        $form = $this->createForm('AppBundle\Form\InvTipoMovimientoType', $invTipoMovimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invTipoMovimiento);
            $em->flush();

            return $this->redirectToRoute('invtipomovimiento_show', array('itmId' => $invTipoMovimiento->getItmid()));
        }

        return $this->render('invtipomovimiento/new.html.twig', array(
            'invTipoMovimiento' => $invTipoMovimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invTipoMovimiento entity.
     *
     */
    public function showAction(InvTipoMovimiento $invTipoMovimiento)
    {
        $deleteForm = $this->createDeleteForm($invTipoMovimiento);

        return $this->render('invtipomovimiento/show.html.twig', array(
            'invTipoMovimiento' => $invTipoMovimiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invTipoMovimiento entity.
     *
     */
    public function editAction(Request $request, InvTipoMovimiento $invTipoMovimiento)
    {
        $deleteForm = $this->createDeleteForm($invTipoMovimiento);
        $editForm = $this->createForm('AppBundle\Form\InvTipoMovimientoType', $invTipoMovimiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invtipomovimiento_edit', array('itmId' => $invTipoMovimiento->getItmid()));
        }

        return $this->render('invtipomovimiento/edit.html.twig', array(
            'invTipoMovimiento' => $invTipoMovimiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invTipoMovimiento entity.
     *
     */
    public function deleteAction(Request $request, InvTipoMovimiento $invTipoMovimiento)
    {
        $form = $this->createDeleteForm($invTipoMovimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invTipoMovimiento);
            $em->flush();
        }

        return $this->redirectToRoute('invtipomovimiento_index');
    }

    /**
     * Creates a form to delete a invTipoMovimiento entity.
     *
     * @param InvTipoMovimiento $invTipoMovimiento The invTipoMovimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvTipoMovimiento $invTipoMovimiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invtipomovimiento_delete', array('itmId' => $invTipoMovimiento->getItmid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
