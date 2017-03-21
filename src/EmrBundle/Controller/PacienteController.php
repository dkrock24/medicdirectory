<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\Paciente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Paciente controller.
 *
 */
class PacienteController extends Controller
{
    /**
     * Lists all paciente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();

        return $this->render('EmrBundle:paciente:index.html.twig', array(
            'pacientes' => $pacientes,
        ));
    }

    /**
     * Creates a new paciente entity.
     *
     */
    public function newAction(Request $request)
    {
        $paciente = new Paciente();
        $form = $this->createForm('EmrBundle\Form\PacienteType', $paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush($paciente);

            return $this->redirectToRoute('paciente_show', array('id' => $paciente->getId()));
        }

        return $this->render('EmrBundle:paciente:new.html.twig', array(
            'paciente' => $paciente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paciente entity.
     *
     */
    public function showAction(Paciente $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);

        return $this->render('EmrBundle:paciente:show.html.twig', array(
            'paciente' => $paciente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paciente entity.
     *
     */
    public function editAction(Request $request, Paciente $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);
        $editForm = $this->createForm('EmrBundle\Form\PacienteType', $paciente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paciente_edit', array('id' => $paciente->getId()));
        }

        return $this->render('EmrBundle:paciente:edit.html.twig', array(
            'paciente' => $paciente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paciente entity.
     *
     */
    public function deleteAction(Request $request, Paciente $paciente)
    {
        $form = $this->createDeleteForm($paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paciente);
            $em->flush();
        }

        return $this->redirectToRoute('paciente_index');
    }

    /**
     * Creates a form to delete a paciente entity.
     *
     * @param Paciente $paciente The paciente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Paciente $paciente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paciente_delete', array('id' => $paciente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
