<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysDepartamentos;
use AppBundle\Form\SysDepartamentosType;

/**
 * SysDepartamentos controller.
 *
 */
class SysDepartamentosController extends Controller
{
    /**
     * Lists all SysDepartamentos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysDepartamentos = $em->getRepository('AppBundle:SysDepartamentos')->findAll();

        return $this->render('AppBundle:sysdepartamentos:index.html.twig', array(
            'sysDepartamentos' => $sysDepartamentos,
        ));
    }

    /**
     * Creates a new SysDepartamentos entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysDepartamento = new SysDepartamentos();
        $form = $this->createForm('AppBundle\Form\SysDepartamentosType', $sysDepartamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysDepartamento);
            $em->flush();

            return $this->redirectToRoute('sysdepartamentos_show', array('id' => $sysDepartamento->getId()));
        }

        return $this->render('AppBundle:sysdepartamentos:new.html.twig', array(
            'sysDepartamento' => $sysDepartamento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysDepartamentos entity.
     *
     */
    public function showAction(SysDepartamentos $sysDepartamento)
    {
        $deleteForm = $this->createDeleteForm($sysDepartamento);

        return $this->render('AppBundle:sysdepartamentos:show.html.twig', array(
            'sysDepartamento' => $sysDepartamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysDepartamentos entity.
     *
     */
    public function editAction(Request $request, SysDepartamentos $sysDepartamento)
    {
        $deleteForm = $this->createDeleteForm($sysDepartamento);
        $editForm = $this->createForm('AppBundle\Form\SysDepartamentosType', $sysDepartamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysDepartamento);
            $em->flush();

            return $this->redirectToRoute('sysdepartamentos_edit', array('id' => $sysDepartamento->getId()));
        }

        return $this->render('AppBundle:sysdepartamentos:edit.html.twig', array(
            'sysDepartamento' => $sysDepartamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysDepartamentos entity.
     *
     */
    public function deleteAction(Request $request, SysDepartamentos $sysDepartamento)
    {
        $form = $this->createDeleteForm($sysDepartamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysDepartamento);
            $em->flush();
        }

        return $this->redirectToRoute('sysdepartamentos_index');
    }

    /**
     * Creates a form to delete a SysDepartamentos entity.
     *
     * @param SysDepartamentos $sysDepartamento The SysDepartamentos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysDepartamentos $sysDepartamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysdepartamentos_delete', array('id' => $sysDepartamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
