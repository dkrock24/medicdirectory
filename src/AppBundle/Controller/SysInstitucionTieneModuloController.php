<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysInstitucionTieneModulo;
use AppBundle\Form\SysInstitucionTieneModuloType;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * SysInstitucionTieneModulo controller.
 *
 */
class SysInstitucionTieneModuloController extends Controller
{
    /**
     * Lists all SysInstitucionTieneModulo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysInstitucionTieneModulos = $em->getRepository('AppBundle:SysInstitucionTieneModulo')->findAll();

        return $this->render('AppBundle:sysinstituciontienemodulo:index.html.twig', array(
            'sysInstitucionTieneModulos' => $sysInstitucionTieneModulos,
        ));
    }

    /**
     * Creates a new SysInstitucionTieneModulo entity.
     *
     */
    public function newAction(Request $request)
    {
        $sysInstitucionTieneModulo = new SysInstitucionTieneModulo();
        $form = $this->createForm('AppBundle\Form\SysInstitucionTieneModuloType', $sysInstitucionTieneModulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($sysInstitucionTieneModulo);
            $flush = $em->flush();
            
            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('sysinstituciontienemodulo_show', array('id' => $sysInstitucionTieneModulo->getId()));
        }

        return $this->render('AppBundle:sysinstituciontienemodulo:new.html.twig', array(
            'sysInstitucionTieneModulo' => $sysInstitucionTieneModulo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysInstitucionTieneModulo entity.
     *
     */
    public function showAction(SysInstitucionTieneModulo $sysInstitucionTieneModulo)
    {
        $deleteForm = $this->createDeleteForm($sysInstitucionTieneModulo);

        return $this->render('AppBundle:sysinstituciontienemodulo:show.html.twig', array(
            'sysInstitucionTieneModulo' => $sysInstitucionTieneModulo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SysInstitucionTieneModulo entity.
     *
     */
    public function editAction(Request $request, SysInstitucionTieneModulo $sysInstitucionTieneModulo)
    {
        $deleteForm = $this->createDeleteForm($sysInstitucionTieneModulo);
        $editForm = $this->createForm('AppBundle\Form\SysInstitucionTieneModuloType', $sysInstitucionTieneModulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysInstitucionTieneModulo);
            $em->flush();

            return $this->redirectToRoute('sysinstituciontienemodulo_edit', array('id' => $sysInstitucionTieneModulo->getId()));
        }

        return $this->render('AppBundle:sysinstituciontienemodulo:edit.html.twig', array(
            'sysInstitucionTieneModulo' => $sysInstitucionTieneModulo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysInstitucionTieneModulo entity.
     *
     */
    public function deleteAction(Request $request, SysInstitucionTieneModulo $sysInstitucionTieneModulo)
    {
        $form = $this->createDeleteForm($sysInstitucionTieneModulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysInstitucionTieneModulo);
            $em->flush();
        }

        return $this->redirectToRoute('sysinstituciontienemodulo_index');
    }

    /**
     * Creates a form to delete a SysInstitucionTieneModulo entity.
     *
     * @param SysInstitucionTieneModulo $sysInstitucionTieneModulo The SysInstitucionTieneModulo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysInstitucionTieneModulo $sysInstitucionTieneModulo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysinstituciontienemodulo_delete', array('id' => $sysInstitucionTieneModulo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
