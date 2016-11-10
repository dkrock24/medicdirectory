<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysMunicipio;
use AppBundle\Form\SysMunicipioType;

/**
 * SysMunicipio controller.
 *
 */
class SysMunicipioController extends Controller
{
    /**
     * Lists all SysMunicipio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysMunicipios = $em->getRepository('AppBundle:SysMunicipio')->findAll();

        return $this->render('AppBundle:sysmunicipio:index.html.twig', array(
            'sysMunicipios' => $sysMunicipios,
        ));
    }

    /**
     * Creates a new SysMunicipio entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysMunicipio = new SysMunicipio();
        $form = $this->createForm('AppBundle\Form\SysMunicipioType', $sysMunicipio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysMunicipio);
            $em->flush();

            return $this->redirectToRoute('sysmunicipio_show', array('id' => $sysMunicipio->getId()));
        }

        return $this->render('AppBundle:sysmunicipio:new.html.twig', array(
            'sysMunicipio' => $sysMunicipio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysMunicipio entity.
     *
     */
    public function showAction(SysMunicipio $sysMunicipio)
    {
        $deleteForm = $this->createDeleteForm($sysMunicipio);

        return $this->render('AppBundle:sysmunicipio:show.html.twig', array(
            'sysMunicipio' => $sysMunicipio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysMunicipio entity.
     *
     */
    public function editAction(Request $request, SysMunicipio $sysMunicipio)
    {
        $deleteForm = $this->createDeleteForm($sysMunicipio);
        $editForm = $this->createForm('AppBundle\Form\SysMunicipioType', $sysMunicipio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysMunicipio);
            $em->flush();

            return $this->redirectToRoute('sysmunicipio_edit', array('id' => $sysMunicipio->getId()));
        }

        return $this->render('AppBundle:sysmunicipio:edit.html.twig', array(
            'sysMunicipio' => $sysMunicipio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysMunicipio entity.
     *
     */
    public function deleteAction(Request $request, SysMunicipio $sysMunicipio)
    {
        $form = $this->createDeleteForm($sysMunicipio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysMunicipio);
            $em->flush();
        }

        return $this->redirectToRoute('sysmunicipio_index');
    }

    /**
     * Creates a form to delete a SysMunicipio entity.
     *
     * @param SysMunicipio $sysMunicipio The SysMunicipio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysMunicipio $sysMunicipio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysmunicipio_delete', array('id' => $sysMunicipio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
