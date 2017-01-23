<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\SysUsuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sysusuario controller.
 *
 */
class UsuarioController extends Controller
{
    /**
     * Lists all sysUsuario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysUsuarios = $em->getRepository('AppBundle:SysUsuario')->findAll();

        return $this->render('Emr/sysusuario/index.html.twig', array(
            'sysUsuarios' => $sysUsuarios,
        ));
    }

    /**
     * Creates a new sysUsuario entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysUsuario = new Sysusuario();
        $form = $this->createForm('EmrBundle\Form\SysUsuarioType', $sysUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysUsuario);
            $em->flush($sysUsuario);

            return $this->redirectToRoute('sys_usuario_show', array('id' => $sysUsuario->getId()));
        }

        return $this->render('Emr/sysusuario/new.html.twig', array(
            'sysUsuario' => $sysUsuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sysUsuario entity.
     *
     */
    public function showAction(SysUsuario $sysUsuario)
    {
        $deleteForm = $this->createDeleteForm($sysUsuario);

        return $this->render('Emr/sysusuario/show.html.twig', array(
            'sysUsuario' => $sysUsuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sysUsuario entity.
     *
     */
    public function editAction(Request $request, SysUsuario $sysUsuario)
    {
        $deleteForm = $this->createDeleteForm($sysUsuario);
        $editForm = $this->createForm('EmrBundle\Form\SysUsuarioType', $sysUsuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sys_usuario_edit', array('id' => $sysUsuario->getId()));
        }

        return $this->render('Emr/sysusuario/edit.html.twig', array(
            'sysUsuario' => $sysUsuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sysUsuario entity.
     *
     */
    public function deleteAction(Request $request, SysUsuario $sysUsuario)
    {
        $form = $this->createDeleteForm($sysUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysUsuario);
            $em->flush($sysUsuario);
        }

        return $this->redirectToRoute('sys_usuario_index');
    }

    /**
     * Creates a form to delete a sysUsuario entity.
     *
     * @param SysUsuario $sysUsuario The sysUsuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysUsuario $sysUsuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sys_usuario_delete', array('id' => $sysUsuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
