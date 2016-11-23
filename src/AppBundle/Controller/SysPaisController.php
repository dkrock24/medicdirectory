<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysPais;
use AppBundle\Form\SysPaisType;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * SysPais controller.
 *
 */
class SysPaisController extends Controller
{
    /**
     * Lists all SysPais entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysPais = $em->getRepository('AppBundle:SysPais')->findAll();

        return $this->render('AppBundle:syspais:index.html.twig', array(
            'sysPais' => $sysPais,
        ));
    }

    /**
     * Creates a new SysPais entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysPai = new SysPais();
        $form = $this->createForm('AppBundle\Form\SysPaisType', $sysPai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysPai);
            $flush = $em->flush();
			
			if ($flush == null) {
				$this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
			} else {
				$this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
			}

            return $this->redirectToRoute('syspais_show', array('id' => $sysPai->getId()));
        }

        return $this->render('AppBundle:syspais:new.html.twig', array(
            'sysPai' => $sysPai,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysPais entity.
     *
     */
    public function showAction(SysPais $sysPai)
    {
        $deleteForm = $this->createDeleteForm($sysPai);

        return $this->render('AppBundle:syspais:show.html.twig', array(
            'sysPai' => $sysPai,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysPais entity.
     *
     */
    public function editAction(Request $request, SysPais $sysPai)
    {
        $deleteForm = $this->createDeleteForm($sysPai);
        $editForm = $this->createForm('AppBundle\Form\SysPaisType', $sysPai);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysPai);
            $flush = $em->flush();
			
			if ($flush == null) {
				$this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
			} else {
				$this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
			}

            return $this->redirectToRoute('syspais_edit', array('id' => $sysPai->getId()));
        }

        return $this->render('AppBundle:syspais:edit.html.twig', array(
            'sysPai' => $sysPai,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysPais entity.
     *
     */
    public function deleteAction(Request $request, SysPais $sysPai)
    {
        $form = $this->createDeleteForm($sysPai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysPai);
            $em->flush();
        }

        return $this->redirectToRoute('syspais_index');
    }

    /**
     * Creates a form to delete a SysPais entity.
     *
     * @param SysPais $sysPai The SysPais entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysPais $sysPai)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('syspais_delete', array('id' => $sysPai->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
