<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvArea;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invarea controller.
 *
 */
class InvAreaController extends Controller
{
    /**
     * Lists all invArea entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invAreas = $em->getRepository('AppBundle:InvArea')->findAll();

        return $this->render('EmrBundle:invarea:index.html.twig', array(
            'invAreas' => $invAreas,
        ));
    }

    /**
     * Creates a new invArea entity.
     *
     */
    public function newAction(Request $request)
    {
        $invArea = new Invarea();
        $form = $this->createForm('EmrBundle\Form\InvAreaType', $invArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invArea->SetIarFechaCrea(new \DateTime());

            $em->persist($invArea);
            $em->flush();

            return $this->redirectToRoute('invarea_show', array('iarId' => $invArea->getIarid()));
        }

        return $this->render('EmrBundle:invarea:new.html.twig', array(
            'invArea' => $invArea,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invArea entity.
     *
     */
    public function showAction(InvArea $invArea)
    {
        $deleteForm = $this->createDeleteForm($invArea);

        return $this->render('EmrBundle:invarea:show.html.twig', array(
            'invArea' => $invArea,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invArea entity.
     *
     */
    public function editAction(Request $request, InvArea $invArea)
    {
        $deleteForm = $this->createDeleteForm($invArea);
        $editForm = $this->createForm('EmrBundle\Form\InvAreaType', $invArea);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invarea_edit', array('iarId' => $invArea->getIarid()));
        }

        return $this->render('EmrBundle:invarea:edit.html.twig', array(
            'invArea' => $invArea,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invArea entity.
     *
     */
    public function deleteAction(Request $request, InvArea $invArea)
    {
        $form = $this->createDeleteForm($invArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invArea);
            $em->flush();
        }

        return $this->redirectToRoute('invarea_index');
    }

    /**
     * Creates a form to delete a invArea entity.
     *
     * @param InvArea $invArea The invArea entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvArea $invArea)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invarea_delete', array('iarId' => $invArea->getIarid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
