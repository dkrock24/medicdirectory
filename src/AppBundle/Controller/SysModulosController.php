<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\SysModulos;
use AppBundle\Form\SysModulosType;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Controller\Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * SysModulos controller.
 *
 */
class SysModulosController extends Controller
{
    /**
     * Lists all SysModulos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysModulos = $em->getRepository('AppBundle:SysModulos')->findAll();

        return $this->render('AppBundle:sysmodulos:index.html.twig', array(
            'sysModulos' => $sysModulos,
        ));
    }

    /**
     * Creates a new SysModulo entity.
     *
     */
    public function newAction(Request $request)
    {
        $SysModulo = new SysModulos();
        $form = $this->createForm('AppBundle\Form\SysModulosType', $SysModulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //echo $date = date();
            //$SysModulo.fechaCreacionSysModulo($date);            
            $SysModulo->setfechaCreacionSysModulo( new \DateTime(date('Y-m-d H:i:s')) );

            // Recogemos el fichero
            $file=$form['imagenModulo']->getData();                         
            $ext=$file->guessExtension();                         
            $file_name=time().".".$ext;             
            $file->move("uploads", $file_name);             
            $SysModulo->setImagenModulo($file_name);

            $em->persist($SysModulo);
            $flush = $em->flush();
            
            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('sysmodulos_show', array('id' => $SysModulo->getId()));
        }

        return $this->render('AppBundle:sysmodulos:new.html.twig', array(
            'SysModulo' => $SysModulo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SysModulos entity.
     *
     */
    public function showAction(SysModulos $sysModulo)
    {
        $deleteForm = $this->createDeleteForm($sysModulo);

        return $this->render('AppBundle:sysmodulos:show.html.twig', array(
            'sysModulo' => $sysModulo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function editAction(Request $request, SysModulos $sysModulo)
    {
        $SysModulo = new SysModulos();
        $form = $this->createForm('AppBundle\Form\SysModulosType', $SysModulo);
        //$form->handleRequest($request);

        $deleteForm = $this->createDeleteForm($sysModulo);
        $editForm = $this->createForm('AppBundle\Form\SysModulosType', $sysModulo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file=$editForm['imagenModulo']->getData();                         
            $ext=$file->guessExtension();                         
            $file_name=time().".".$ext;             
            $file->move("uploads", $file_name);             
            $sysModulo->setImagenModulo($file_name);

            $em->persist($sysModulo);
            $flush = $em->flush();
            
            if ($flush == null) {
                $this->get('session')->getFlashBag()->add('success', "Regístro creado exitosamente");
            } else {
                $this->get('session')->getFlashBag()->add('error', "No se ha podido crear el regístro");
            }

            return $this->redirectToRoute('sysmodulos_edit', array('id' => $sysModulo->getId()));
        }

        return $this->render('AppBundle:sysmodulos:edit.html.twig', array(
            'sysModulo' => $sysModulo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SysModulos entity.
     *
     */
    public function deleteAction(Request $request, SysModulos $sysModulo)
    {
        $form = $this->createDeleteForm($sysModulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sysModulo);
            $em->flush();
        }

        return $this->redirectToRoute('sysmodulos_index');
    }

    /**
     * Creates a form to delete a SysPais entity.
     *
     * @param SysModulos $sysModulo The SysModulos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SysModulos $sysModulo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sysmodulos_delete', array('id' => $sysModulo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
