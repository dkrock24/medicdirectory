<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysAntecedentesEspecialidad;
use AppBundle\Form\SysAntecedentesEspecialidadType;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * SysAntecedentesEspecialidad controller.
 *
 */
class SysAntecedentesEspecialidadController extends Controller
{
    /**
     * Lists all SysAntecedentesEspecialidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysAntecedentesEspecialidads = $em->getRepository('AppBundle:SysAntecedentesEspecialidad')->findAll();

        return $this->render('AppBundle:sysantecedentesespecialidad:index.html.twig', array(
            'sysAntecedentesEspecialidads' => $sysAntecedentesEspecialidads,
        ));
    }

    /**
     * Creates a new SysAntecedentesEspecialidad entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysAntecedentesEspecialidad = new SysAntecedentesEspecialidad();
        $form = $this->createForm('AppBundle\Form\SysAntecedentesEspecialidadType', $sysAntecedentesEspecialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $sysAntecedentesEspecialidad->setfechaCreacion( new \DateTime(date('Y-m-d H:i:s')) );
            $em->persist($sysAntecedentesEspecialidad);
            $em->flush();

            return $this->redirectToRoute('sysantecedentesespecialidad_show', array('id' => $sysAntecedentesEspecialidad->getId()));
        }

        return $this->render('AppBundle:sysantecedentesespecialidad:new.html.twig', array(
            'sysAntecedentesEspecialidad' => $sysAntecedentesEspecialidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysAntecedentesEspecialidad entity.
     *
     */
    public function showAction(SysAntecedentesEspecialidad $sysAntecedentesEspecialidad)
    {
        $deleteForm = $this->createDeleteForm($sysAntecedentesEspecialidad);

        return $this->render('AppBundle:sysantecedentesespecialidad:show.html.twig', array(
            'sysAntecedentesEspecialidad' => $sysAntecedentesEspecialidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysAntecedentesEspecialidad entity.
     *
     */
    public function editAction(Request $request, SysAntecedentesEspecialidad $sysAntecedentesEspecialidad)
    {
        $deleteForm = $this->createDeleteForm($sysAntecedentesEspecialidad);
        $editForm = $this->createForm('AppBundle\Form\SysAntecedentesEspecialidadType', $sysAntecedentesEspecialidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysAntecedentesEspecialidad);
            $flush = $em->flush();

            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('sysantecedentesespecialidad_edit', array('id' => $sysAntecedentesEspecialidad->getId()));
        }

        return $this->render('AppBundle:sysantecedentesespecialidad:edit.html.twig', array(
            'sysAntecedentesEspecialidad' => $sysAntecedentesEspecialidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysAntecedentesEspecialidad entity.
     *
     */
    public function deleteAction(Request $request, SysAntecedentesEspecialidad $sysAntecedentesEspecialidad)
    {
        $form = $this->createDeleteForm($sysAntecedentesEspecialidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysAntecedentesEspecialidad);
            $em->flush();
        }

        return $this->redirectToRoute('sysantecedentesespecialidad_index');
    }

    /**
     * Creates a form to delete a SysAntecedentesEspecialidad entity.
     *
     * @param SysAntecedentesEspecialidad $sysAntecedentesEspecialidad The SysAntecedentesEspecialidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysAntecedentesEspecialidad $sysAntecedentesEspecialidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysantecedentesespecialidad_delete', array('id' => $sysAntecedentesEspecialidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
