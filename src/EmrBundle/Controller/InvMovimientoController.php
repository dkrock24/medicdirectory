<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvMovimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Invmovimiento controller.
 *
 */
class InvMovimientoController extends Controller
{
    /**
     * Lists all invMovimiento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invMovimientos = $em->getRepository('AppBundle:InvMovimiento')->findAll();

        return $this->render('invmovimiento/index.html.twig', array(
            'invMovimientos' => $invMovimientos,
        ));
    }

    /**
     * Creates a new invMovimiento entity.
     *
     */
    public function newAction(Request $request)
    {
        $invMovimiento = new Invmovimiento();
        $form = $this->createForm('AppBundle\Form\InvMovimientoType', $invMovimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invMovimiento);
            $em->flush();

            return $this->redirectToRoute('invmovimiento_show', array('imoId' => $invMovimiento->getImoid()));
        }

        return $this->render('invmovimiento/new.html.twig', array(
            'invMovimiento' => $invMovimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invMovimiento entity.
     *
     */
    public function showAction(InvMovimiento $invMovimiento)
    {
        $deleteForm = $this->createDeleteForm($invMovimiento);

        return $this->render('invmovimiento/show.html.twig', array(
            'invMovimiento' => $invMovimiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invMovimiento entity.
     *
     */
    public function editAction(Request $request, InvMovimiento $invMovimiento)
    {
        $deleteForm = $this->createDeleteForm($invMovimiento);
        $editForm = $this->createForm('AppBundle\Form\InvMovimientoType', $invMovimiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invmovimiento_edit', array('imoId' => $invMovimiento->getImoid()));
        }

        return $this->render('invmovimiento/edit.html.twig', array(
            'invMovimiento' => $invMovimiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invMovimiento entity.
     *
     */
    public function deleteAction(Request $request, InvMovimiento $invMovimiento)
    {
        $form = $this->createDeleteForm($invMovimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invMovimiento);
            $em->flush();
        }

        return $this->redirectToRoute('invmovimiento_index');
    }

    /**
     * Creates a form to delete a invMovimiento entity.
     *
     * @param InvMovimiento $invMovimiento The invMovimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvMovimiento $invMovimiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invmovimiento_delete', array('imoId' => $invMovimiento->getImoid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
