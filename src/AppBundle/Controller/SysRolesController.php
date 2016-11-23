<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysRoles;
use AppBundle\Form\SysRolesType;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * SysRoles controller.
 *
 */
class SysRolesController extends Controller
{
    /**
     * Lists all SysRoles entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysRoles = $em->getRepository('AppBundle:SysRoles')->findAll();

        return $this->render('AppBundle:sysroles:index.html.twig', array(
            'sysRoles' => $sysRoles,
        ));
    }

    /**
     * Creates a new SysRoles entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysRole = new SysRoles();
        $form = $this->createForm('AppBundle\Form\SysRolesType', $sysRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			$sysRole->setfechaCreacionSysRoles( new \DateTime(date('Y-m-d H:i:s')) );
            $em->persist($sysRole);
            $flush = $em->flush();
			
			if ($flush == null) {
				$this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
			} else {
				$this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
			}

            return $this->redirectToRoute('sysroles_show', array('id' => $sysRole->getId()));
        }

        return $this->render('AppBundle:sysroles:new.html.twig', array(
            'sysRole' => $sysRole,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysRoles entity.
     *
     */
    public function showAction(SysRoles $sysRole)
    {
        $deleteForm = $this->createDeleteForm($sysRole);
		
        return $this->render('AppBundle:sysroles:show.html.twig', array(
            'sysRole' => $sysRole,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysRoles entity.
     *
     */
    public function editAction(Request $request, SysRoles $sysRole)
    {
        $deleteForm = $this->createDeleteForm($sysRole);
        $editForm = $this->createForm('AppBundle\Form\SysRolesType', $sysRole);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysRole);
            $flush = $em->flush();
			
			if ($flush == null) {
				$this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
			} else {
				$this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
			}

            return $this->redirectToRoute('sysroles_edit', array('id' => $sysRole->getId()));
        }

        return $this->render('AppBundle:sysroles:edit.html.twig', array(
            'sysRole' => $sysRole,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysRoles entity.
     *
     */
    public function deleteAction(Request $request, SysRoles $sysRole)
    {
        $form = $this->createDeleteForm($sysRole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysRole);
            $em->flush();
        }

        return $this->redirectToRoute('sysroles_index');
    }

    /**
     * Creates a form to delete a SysRoles entity.
     *
     * @param SysRoles $sysRole The SysRoles entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysRoles $sysRole)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysroles_delete', array('id' => $sysRole->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
