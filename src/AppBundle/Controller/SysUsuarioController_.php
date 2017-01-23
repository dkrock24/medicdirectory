<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysUsuario;
use AppBundle\Form\SysUsuarioType;

/**
 * SysUsuario controller.
 *
 */
class SysUsuarioController extends Controller
{
    /**
     * Lists all SysUsuario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysUsuarios = $em->getRepository('AppBundle:SysUsuario')->findAll();

        return $this->render('AppBundle:sysusuario:index.html.twig', array(
            'sysUsuarios' => $sysUsuarios,
        ));
    }

    /**
     * Creates a new SysUsuario entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysUsuario = new SysUsuario();
        $form = $this->createForm('AppBundle\Form\SysUsuarioType', $sysUsuario);
        $form->handleRequest($request);
		//echo $form->get('genero');
		$genero = $form->get("genero")->getData();
		$pass = $form->get("passwordSysUsuario")->getData();
		
		$password = md5($pass);
		//echo "zzzzzzz";
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			
			$sysUsuario->setFechaCreacionSysUsuario( new \DateTime(date('Y-m-d H:i:s')) );
			$sysUsuario->setGenero( $genero );
			$sysUsuario->setPasswordSysUsuario( $password );

            $em->persist($sysUsuario);
            $em->flush();

            return $this->redirectToRoute('sysusuario_show', array('id' => $sysUsuario->getId()));
        }
		//exit();
        return $this->render('AppBundle:sysusuario:new.html.twig', array(
            'sysUsuario' => $sysUsuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysUsuario entity.
     *
     */
    public function showAction(SysUsuario $sysUsuario)
    {
        $deleteForm = $this->createDeleteForm($sysUsuario);

        return $this->render('AppBundle:sysusuario:show.html.twig', array(
            'sysUsuario' => $sysUsuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysUsuario entity.
     *
     */
    public function editAction(Request $request, SysUsuario $sysUsuario)
    {
        $deleteForm = $this->createDeleteForm($sysUsuario);
        $editForm = $this->createForm('AppBundle\Form\SysUsuarioType', $sysUsuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysUsuario);
            $em->flush();

            return $this->redirectToRoute('sysusuario_edit', array('id' => $sysUsuario->getId()));
        }

        return $this->render('AppBundle:sysusuario:edit.html.twig', array(
            'sysUsuario' => $sysUsuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysUsuario entity.
     *
     */
    public function deleteAction(Request $request, SysUsuario $sysUsuario)
    {
        $form = $this->createDeleteForm($sysUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysUsuario);
            $em->flush();
        }

        return $this->redirectToRoute('sysusuario_index');
    }

    /**
     * Creates a form to delete a SysUsuario entity.
     *
     * @param SysUsuario $sysUsuario The SysUsuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysUsuario $sysUsuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysusuario_delete', array('id' => $sysUsuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
