<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SysPais;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Syspai controller.
 *
 */
class SysPaisController extends Controller
{
    /**
     * Lists all sysPai entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysPais = $em->getRepository('AppBundle:SysPais')->findAll();

        return $this->render('Admin/syspais/index.html.twig', array(
            'sysPais' => $sysPais,
        ));
    }

    /**
     * Creates a new sysPai entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysPai = new Syspai();
        $form = $this->createForm('AppBundle\Form\SysPaisType', $sysPai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysPai);
            $em->flush($sysPai);

            return $this->redirectToRoute('sys_pais_show', array('id' => $sysPai->getId()));
        }

        return $this->render('Admin/syspais/new.html.twig', array(
            'sysPai' => $sysPai,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sysPai entity.
     *
     */
    public function showAction(SysPais $sysPai)
    {
        $deleteForm = $this->createDeleteForm($sysPai);

        return $this->render('Admin/syspais/show.html.twig', array(
            'sysPai' => $sysPai,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sysPai entity.
     *
     */
    public function editAction(Request $request, SysPais $sysPai)
    {
        $deleteForm = $this->createDeleteForm($sysPai);
        $editForm = $this->createForm('AppBundle\Form\SysPaisType', $sysPai);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sys_pais_edit', array('id' => $sysPai->getId()));
        }

        return $this->render('Admin/syspais/edit.html.twig', array(
            'sysPai' => $sysPai,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sysPai entity.
     *
     */
    public function deleteAction(Request $request, SysPais $sysPai)
    {
        $form = $this->createDeleteForm($sysPai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysPai);
            $em->flush($sysPai);
        }

        return $this->redirectToRoute('sys_pais_index');
    }

    /**
     * Creates a form to delete a sysPai entity.
     *
     * @param SysPais $sysPai The sysPai entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysPais $sysPai)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sys_pais_delete', array('id' => $sysPai->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
