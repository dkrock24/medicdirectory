<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvProveedor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Invproveedor controller.
 *
 */
class InvProveedorController extends Controller
{
    /**
     * Lists all invProveedor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invProveedors = $em->getRepository('AppBundle:InvProveedor')->findAll();

        return $this->render('invproveedor/index.html.twig', array(
            'invProveedors' => $invProveedors,
        ));
    }

    /**
     * Creates a new invProveedor entity.
     *
     */
    public function newAction(Request $request)
    {
        $invProveedor = new Invproveedor();
        $form = $this->createForm('AppBundle\Form\InvProveedorType', $invProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invProveedor);
            $em->flush();

            return $this->redirectToRoute('invproveedor_show', array('iprId' => $invProveedor->getIprid()));
        }

        return $this->render('invproveedor/new.html.twig', array(
            'invProveedor' => $invProveedor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invProveedor entity.
     *
     */
    public function showAction(InvProveedor $invProveedor)
    {
        $deleteForm = $this->createDeleteForm($invProveedor);

        return $this->render('invproveedor/show.html.twig', array(
            'invProveedor' => $invProveedor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invProveedor entity.
     *
     */
    public function editAction(Request $request, InvProveedor $invProveedor)
    {
        $deleteForm = $this->createDeleteForm($invProveedor);
        $editForm = $this->createForm('AppBundle\Form\InvProveedorType', $invProveedor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invproveedor_edit', array('iprId' => $invProveedor->getIprid()));
        }

        return $this->render('invproveedor/edit.html.twig', array(
            'invProveedor' => $invProveedor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invProveedor entity.
     *
     */
    public function deleteAction(Request $request, InvProveedor $invProveedor)
    {
        $form = $this->createDeleteForm($invProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invProveedor);
            $em->flush();
        }

        return $this->redirectToRoute('invproveedor_index');
    }

    /**
     * Creates a form to delete a invProveedor entity.
     *
     * @param InvProveedor $invProveedor The invProveedor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvProveedor $invProveedor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invproveedor_delete', array('iprId' => $invProveedor->getIprid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
