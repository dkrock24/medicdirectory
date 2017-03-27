<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvCategoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invcategorium controller.
 *
 */
class InvCategoriaController extends Controller
{
    /**
     * Lists all invCategorium entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invCategorias = $em->getRepository('AppBundle:InvCategoria')->findAll();

        return $this->render('EmrBundle:invcategoria:index.html.twig', array(
            'invCategorias' => $invCategorias,
        ));
    }

    /**
     * Creates a new invCategorium entity.
     *
     */
    public function newAction(Request $request)
    {
        $invCategorium = new InvCategoria();
        $form = $this->createForm('EmrBundle\Form\InvCategoriaType', $invCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invCategorium->SetIcaFechaCrea(new \DateTime());

            $em->persist($invCategorium);
            $em->flush();

            return $this->redirectToRoute('invcategoria_show', array('icaId' => $invCategorium->getIcaid()));
        }

        return $this->render('EmrBundle:invcategoria:new.html.twig', array(
            'invCategorium' => $invCategorium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invCategorium entity.
     *
     */
    public function showAction(InvCategoria $invCategorium)
    {
        $deleteForm = $this->createDeleteForm($invCategorium);

        return $this->render('EmrBundle:invcategoria:show.html.twig', array(
            'invCategorium' => $invCategorium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invCategorium entity.
     *
     */
    public function editAction(Request $request, InvCategoria $invCategorium)
    {
        $deleteForm = $this->createDeleteForm($invCategorium);
        $editForm = $this->createForm('EmrBundle\Form\InvCategoriaType', $invCategorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invcategoria_edit', array('icaId' => $invCategorium->getIcaid()));
        }

        return $this->render('EmrBundle:invcategoria:edit.html.twig', array(
            'invCategorium' => $invCategorium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invCategorium entity.
     *
     */
    public function deleteAction(Request $request, InvCategoria $invCategorium)
    {
        $form = $this->createDeleteForm($invCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invCategorium);
            $em->flush();
        }

        return $this->redirectToRoute('invcategoria_index');
    }

    /**
     * Creates a form to delete a invCategorium entity.
     *
     * @param InvCategoria $invCategorium The invCategorium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvCategoria $invCategorium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invcategoria_delete', array('icaId' => $invCategorium->getIcaid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
