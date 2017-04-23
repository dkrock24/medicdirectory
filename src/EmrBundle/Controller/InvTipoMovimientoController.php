<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvTipoMovimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invtipomovimiento controller.
 *
 */
class InvTipoMovimientoController extends Controller
{
    /**
     * Lists all invTipoMovimiento entities.
     *
     */
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $idCliente = $this->get('session')->get('locationId');

        $invTipoMovimientos = $em->getRepository('AppBundle:InvTipoMovimiento')->findBy(array('itmCli' => $idCliente));

        return $this->render('EmrBundle:invtipomovimiento:index.html.twig', array(
            'invTipoMovimientos' => $invTipoMovimientos,
        ));
    }

    /**
     * Creates a new invTipoMovimiento entity.
     *
     */
    public function newAction(Request $request)
    {
        $invTipoMovimiento = new Invtipomovimiento();
        $form = $this->createForm('EmrBundle\Form\InvTipoMovimientoType', $invTipoMovimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $idCliente = $this->get('session')->get('locationId');
            $id = $em->getRepository('AppBundle:Cliente')->find($idCliente);
            $invTipoMovimiento->SetItmCli($id);

            $invTipoMovimiento->SetItmFechaCrea(new \DateTime());
            $em->persist($invTipoMovimiento);           

            $flush = $em->flush();
            if ($flush == null)
            {
                $msgBox = "Registro creado con éxito";
                $status = "success";
            } else {
                $msgBox = "No se pudo crear el registro ";
                $status = "error";
            }
            $this->session->getFlashBag()->add($status,$msgBox);

            return $this->redirectToRoute('invtipomovimiento_show', array('itmId' => $invTipoMovimiento->getItmid()));
        }

        return $this->render('EmrBundle:invtipomovimiento:new.html.twig', array(
            'invTipoMovimiento' => $invTipoMovimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invTipoMovimiento entity.
     *
     */
    public function showAction(InvTipoMovimiento $invTipoMovimiento)
    {
        $deleteForm = $this->createDeleteForm($invTipoMovimiento);

        return $this->render('EmrBundle:invtipomovimiento:show.html.twig', array(
            'invTipoMovimiento' => $invTipoMovimiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invTipoMovimiento entity.
     *
     */
    public function editAction(Request $request, InvTipoMovimiento $invTipoMovimiento)
    {
        $deleteForm = $this->createDeleteForm($invTipoMovimiento);
        $editForm = $this->createForm('EmrBundle\Form\InvTipoMovimientoType', $invTipoMovimiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invtipomovimiento_edit', array('itmId' => $invTipoMovimiento->getItmid()));
        }

        return $this->render('EmrBundle:invtipomovimiento:edit.html.twig', array(
            'invTipoMovimiento' => $invTipoMovimiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invTipoMovimiento entity.
     *
     */
    public function deleteAction(Request $request, InvTipoMovimiento $invTipoMovimiento)
    {
        $form = $this->createDeleteForm($invTipoMovimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invTipoMovimiento);
            $em->flush();
        }

        return $this->redirectToRoute('invtipomovimiento_index');
    }

    /**
     * Creates a form to delete a invTipoMovimiento entity.
     *
     * @param InvTipoMovimiento $invTipoMovimiento The invTipoMovimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvTipoMovimiento $invTipoMovimiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invtipomovimiento_delete', array('itmId' => $invTipoMovimiento->getItmid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function deleteCustomAction( Request $request )
    {
        $iId = $request->request->get('id');
        //$iId = $request->query->get('id');
        
        if( isset($iId) && $iId > 0 )
        {
            
            try
            {
                $em = $this->getDoctrine()->getManager();
                $repo = $em->getRepository("AppBundle:InvTipoMovimiento");   
                $item = $repo->find($iId);
                $em->remove($item);
                $flush = $em->flush();

                if ($flush == null)
                {
                    echo 1;
                } else {
                    echo 0;
                }
                
            }catch (\Exception $e){
                echo ($e->getMessage());
            }
            
        }
        
        exit();
    }
}
