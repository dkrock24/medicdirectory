<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysExamenesMedicos;
use AppBundle\Form\SysExamenesMedicosType;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * SysExamenesMedicos controller.
 *
 */
class SysExamenesMedicosController extends Controller
{
    /**
     * Lists all SysExamenesMedicos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysExamenesMedicos = $em->getRepository('AppBundle:SysExamenesMedicos')->findAll();

        return $this->render('AppBundle:sysexamenesmedicos:index.html.twig', array(
            'sysExamenesMedicos' => $sysExamenesMedicos,
        ));
    }

    /**
     * Creates a new SysExamenesMedicos entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysExamenesMedico = new SysExamenesMedicos();
        $form = $this->createForm('AppBundle\Form\SysExamenesMedicosType', $sysExamenesMedico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $sysExamenesMedico->setfechaCreacion( new \DateTime(date('Y-m-d H:i:s')) );
            $em->persist($sysExamenesMedico);
            $em->flush();

            return $this->redirectToRoute('sysexamenesmedicos_show', array('id' => $sysExamenesMedico->getId()));
        }

        return $this->render('AppBundle:sysexamenesmedicos:new.html.twig', array(
            'sysExamenesMedico' => $sysExamenesMedico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysExamenesMedicos entity.
     *
     */
    public function showAction(SysExamenesMedicos $sysExamenesMedico)
    {
        $deleteForm = $this->createDeleteForm($sysExamenesMedico);

        return $this->render('AppBundle:sysexamenesmedicos:show.html.twig', array(
            'sysExamenesMedico' => $sysExamenesMedico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysExamenesMedicos entity.
     *
     */
    public function editAction(Request $request, SysExamenesMedicos $sysExamenesMedico)
    {
        $deleteForm = $this->createDeleteForm($sysExamenesMedico);
        $editForm = $this->createForm('AppBundle\Form\SysExamenesMedicosType', $sysExamenesMedico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysExamenesMedico);
            $em->flush();

            return $this->redirectToRoute('sysexamenesmedicos_edit', array('id' => $sysExamenesMedico->getId()));
        }

        return $this->render('AppBundle:sysexamenesmedicos:edit.html.twig', array(
            'sysExamenesMedico' => $sysExamenesMedico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysExamenesMedicos entity.
     *
     */
    public function deleteAction(Request $request, SysExamenesMedicos $sysExamenesMedico)
    {
        $form = $this->createDeleteForm($sysExamenesMedico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysExamenesMedico);
            $em->flush();
        }

        return $this->redirectToRoute('sysexamenesmedicos_index');
    }

    /**
     * Creates a form to delete a SysExamenesMedicos entity.
     *
     * @param SysExamenesMedicos $sysExamenesMedico The SysExamenesMedicos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysExamenesMedicos $sysExamenesMedico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysexamenesmedicos_delete', array('id' => $sysExamenesMedico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
