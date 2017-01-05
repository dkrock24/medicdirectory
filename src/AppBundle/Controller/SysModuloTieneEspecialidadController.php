<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysModuloTieneEspecialidad;
use AppBundle\Form\SysModuloTieneEspecialidadType;

/**
 * SysModuloTieneEspecialidad controller.
 *
 */
class SysModuloTieneEspecialidadController extends Controller
{
    /**
     * Lists all SysModuloTieneEspecialidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysModuloTieneEspecialidads = $em->getRepository('AppBundle:SysModuloTieneEspecialidad')->findAll();

        return $this->render('AppBundle:sysmodulotieneespecialidad:index.html.twig', array(
            'sysModuloTieneEspecialidads' => $sysModuloTieneEspecialidads,
        ));
    }

    /**
     * Creates a new SysModuloTieneEspecialidad entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysModuloTieneEspecialidad = new SysModuloTieneEspecialidad();
        $form = $this->createForm('AppBundle\Form\SysModuloTieneEspecialidadType', $sysModuloTieneEspecialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysModuloTieneEspecialidad);
            $em->flush();

            return $this->redirectToRoute('sysmodulotieneespecialidad_show', array('id' => $sysModuloTieneEspecialidad->getId()));
        }

        return $this->render('AppBundle:sysmodulotieneespecialidad:new.html.twig', array(
            'sysModuloTieneEspecialidad' => $sysModuloTieneEspecialidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysModuloTieneEspecialidad entity.
     *
     */
    public function showAction(SysModuloTieneEspecialidad $sysModuloTieneEspecialidad)
    {
        $deleteForm = $this->createDeleteForm($sysModuloTieneEspecialidad);

        return $this->render('AppBundle:sysmodulotieneespecialidad:show.html.twig', array(
            'sysModuloTieneEspecialidad' => $sysModuloTieneEspecialidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysModuloTieneEspecialidad entity.
     *
     */
    public function editAction(Request $request, SysModuloTieneEspecialidad $sysModuloTieneEspecialidad)
    {
        $deleteForm = $this->createDeleteForm($sysModuloTieneEspecialidad);
        $editForm = $this->createForm('AppBundle\Form\SysModuloTieneEspecialidadType', $sysModuloTieneEspecialidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysModuloTieneEspecialidad);
            $em->flush();

            return $this->redirectToRoute('sysmodulotieneespecialidad_edit', array('id' => $sysModuloTieneEspecialidad->getId()));
        }

        return $this->render('AppBundle:sysmodulotieneespecialidad:edit.html.twig', array(
            'sysModuloTieneEspecialidad' => $sysModuloTieneEspecialidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysModuloTieneEspecialidad entity.
     *
     */
    public function deleteAction(Request $request, SysModuloTieneEspecialidad $sysModuloTieneEspecialidad)
    {
        $form = $this->createDeleteForm($sysModuloTieneEspecialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysModuloTieneEspecialidad);
            $em->flush();
        }

        return $this->redirectToRoute('sysmodulotieneespecialidad_index');
    }

    /**
     * Creates a form to delete a SysModuloTieneEspecialidad entity.
     *
     * @param SysModuloTieneEspecialidad $sysModuloTieneEspecialidad The SysModuloTieneEspecialidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysModuloTieneEspecialidad $sysModuloTieneEspecialidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysmodulotieneespecialidad_delete', array('id' => $sysModuloTieneEspecialidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
