<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Departamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Departamento controller.
 *
 */
class DepartamentoController extends Controller
{
    /**
     * Lists all departamento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('AppBundle:Departamento')->findAll();

        return $this->render('AdminBundle:departamento:index.html.twig', array(
            'departamentos' => $departamentos,
        ));
    }

    /**
     * Creates a new departamento entity.
     *
     */
    public function newAction(Request $request)
    {
        $departamento = new Departamento();
        $form = $this->createForm('AdminBundle\Form\DepartamentoType', $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			$departamento->setDepFechaCrea( new \DateTime() );
            $em->persist($departamento);
            $em->flush($departamento);

            return $this->redirectToRoute('departamento_show', array('id' => $departamento->getDepId()));
        }

        return $this->render('AdminBundle:departamento:new.html.twig', array(
            'departamento' => $departamento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a departamento entity.
     *
     */
    public function showAction(Departamento $departamento)
    {
        $deleteForm = $this->createDeleteForm($departamento);

        return $this->render('AdminBundle:departamento:show.html.twig', array(
            'departamento' => $departamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing departamento entity.
     *
     */
    public function editAction(Request $request, Departamento $departamento)
    {
        $deleteForm = $this->createDeleteForm($departamento);
        $editForm = $this->createForm('AppBundle\Form\DepartamentoType', $departamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('departamento_edit', array('id' => $departamento->getId()));
        }

        return $this->render('departamento/edit.html.twig', array(
            'departamento' => $departamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a departamento entity.
     *
     */
    public function deleteAction(Request $request, Departamento $departamento)
    {
        $form = $this->createDeleteForm($departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departamento);
            $em->flush();
        }

        return $this->redirectToRoute('departamento_index');
    }

    /**
     * Creates a form to delete a departamento entity.
     *
     * @param Departamento $departamento The departamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departamento $departamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('departamento_delete', array('id' => $departamento->getDepId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
