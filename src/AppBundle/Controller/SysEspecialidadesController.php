<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysEspecialidades;
use AppBundle\Form\SysEspecialidadesType;

/**
 * SysEspecialidades controller.
 *
 */
class SysEspecialidadesController extends Controller
{
    /**
     * Lists all SysEspecialidades entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysEspecialidades = $em->getRepository('AppBundle:SysEspecialidades')->findAll();

        return $this->render('AppBundle:sysespecialidades:index.html.twig', array(
            'sysEspecialidades' => $sysEspecialidades,
        ));
    }

    /**
     * Creates a new SysEspecialidades entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysEspecialidade = new SysEspecialidades();
        $form = $this->createForm('AppBundle\Form\SysEspecialidadesType', $sysEspecialidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysEspecialidade);
            $flush =  $em->flush();

            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('sysespecialidades_show', array('id' => $sysEspecialidade->getId()));
        }

        return $this->render('AppBundle:sysespecialidades:new.html.twig', array(
            'sysEspecialidade' => $sysEspecialidade,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysEspecialidades entity.
     *
     */
    public function showAction(SysEspecialidades $sysEspecialidade)
    {
        $deleteForm = $this->createDeleteForm($sysEspecialidade);

        return $this->render('AppBundle:sysespecialidades:show.html.twig', array(
            'sysEspecialidade' => $sysEspecialidade,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysEspecialidades entity.
     *
     */
    public function editAction(Request $request, SysEspecialidades $sysEspecialidade)
    {
        $deleteForm = $this->createDeleteForm($sysEspecialidade);
        $editForm = $this->createForm('AppBundle\Form\SysEspecialidadesType', $sysEspecialidade);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysEspecialidade);
            $flush = $em->flush();
            
            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('sysespecialidades_edit', array('id' => $sysEspecialidade->getId()));
        }

        return $this->render('AppBundle:sysespecialidades:edit.html.twig', array(
            'sysEspecialidade' => $sysEspecialidade,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysEspecialidades entity.
     *
     */
    public function deleteAction(Request $request, SysEspecialidades $sysEspecialidade)
    {
        $form = $this->createDeleteForm($sysEspecialidade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysEspecialidade);
            $em->flush();
        }

        return $this->redirectToRoute('sysespecialidades_index');
    }

    /**
     * Creates a form to delete a SysEspecialidades entity.
     *
     * @param SysEspecialidades $sysEspecialidade The SysEspecialidades entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysEspecialidades $sysEspecialidade)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysespecialidades_delete', array('id' => $sysEspecialidade->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
