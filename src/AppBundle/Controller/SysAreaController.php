<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysArea;
use AppBundle\Form\SysAreaType;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * SysArea controller.
 *
 */
class SysAreaController extends Controller
{
    /**
     * Lists all SysArea entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysAreas = $em->getRepository('AppBundle:SysArea')->findAll();

        return $this->render('AppBundle:sysarea:index.html.twig', array(
            'sysAreas' => $sysAreas,
        ));
    }

    /**
     * Creates a new SysArea entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysArea = new SysArea();
        $form = $this->createForm('AppBundle\Form\SysAreaType', $sysArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();            
            $sysArea->setfechaCreacion( new \DateTime(date('Y-m-d H:i:s')) );
            $em->persist($sysArea);
            $em->flush();

            return $this->redirectToRoute('sysarea_show', array('id' => $sysArea->getId()));
        }

        return $this->render('AppBundle:sysarea:new.html.twig', array(
            'sysArea' => $sysArea,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysArea entity.
     *
     */
    public function showAction(SysArea $sysArea)
    {
        $deleteForm = $this->createDeleteForm($sysArea);

        return $this->render('AppBundle:sysarea:show.html.twig', array(
            'sysArea' => $sysArea,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysArea entity.
     *
     */
    public function editAction(Request $request, SysArea $sysArea)
    {
        $deleteForm = $this->createDeleteForm($sysArea);
        $editForm = $this->createForm('AppBundle\Form\SysAreaType', $sysArea);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysArea);
            $flush = $em->flush();

            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('sysarea_edit', array('id' => $sysArea->getId()));
        }

        return $this->render('AppBundle:sysarea:edit.html.twig', array(
            'sysArea' => $sysArea,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysArea entity.
     *
     */
    public function deleteAction(Request $request, SysArea $sysArea)
    {
        $form = $this->createDeleteForm($sysArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysArea);
            $em->flush();
        }

        return $this->redirectToRoute('sysarea_index');
    }

    /**
     * Creates a form to delete a SysArea entity.
     *
     * @param SysArea $sysArea The SysArea entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysArea $sysArea)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysarea_delete', array('id' => $sysArea->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
