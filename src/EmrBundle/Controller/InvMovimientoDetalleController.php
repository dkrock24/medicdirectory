<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvMovimientoDetalle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invmovimientodetalle controller.
 *
 */
class InvMovimientoDetalleController extends Controller
{
    /**
     * Lists all invMovimientoDetalle entities.
     *
     */
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();        
        //$request
        $id =  $request->get('imoId');
        $invMovimientoDetalles = $em->getRepository('AppBundle:InvMovimientoDetalle')->findBy(array('imdImo' => $id));

        return $this->render('EmrBundle:invmovimientodetalle:index.html.twig', array(
            'invMovimientoDetalles' => $invMovimientoDetalles,
        ));
    }

    /**
     * Creates a new invMovimientoDetalle entity.
     *
     */
    public function newAction(Request $request)
    {
        $invMovimientoDetalle = new Invmovimientodetalle();
        $form = $this->createForm('EmrBundle\Form\InvMovimientoDetalleType', $invMovimientoDetalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invMovimientoDetalle->SetImdFechaCrea(new \DateTime());
            $em->persist($invMovimientoDetalle);
            
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

            return $this->redirectToRoute('invmovimientodetalle_show', array('imdId' => $invMovimientoDetalle->getImdid()));
        }

        return $this->render('EmrBundle:invmovimientodetalle:new.html.twig', array(
            'invMovimientoDetalle' => $invMovimientoDetalle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invMovimientoDetalle entity.
     *
     */
    public function showAction(InvMovimientoDetalle $invMovimientoDetalle)
    {
        $deleteForm = $this->createDeleteForm($invMovimientoDetalle);

        return $this->render('EmrBundle:invmovimientodetalle:show.html.twig', array(
            'invMovimientoDetalle' => $invMovimientoDetalle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invMovimientoDetalle entity.
     *
     */
    public function editAction(Request $request, InvMovimientoDetalle $invMovimientoDetalle)
    {
        $deleteForm = $this->createDeleteForm($invMovimientoDetalle);
        $editForm = $this->createForm('EmrBundle\Form\InvMovimientoDetalleType', $invMovimientoDetalle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invmovimientodetalle_edit', array('imdId' => $invMovimientoDetalle->getImdid()));
        }

        return $this->render('EmrBundle:invmovimientodetalle:edit.html.twig', array(
            'invMovimientoDetalle' => $invMovimientoDetalle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invMovimientoDetalle entity.
     *
     */
    public function deleteAction(Request $request, InvMovimientoDetalle $invMovimientoDetalle)
    {
        $form = $this->createDeleteForm($invMovimientoDetalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invMovimientoDetalle);
            $em->flush();
        }

        return $this->redirectToRoute('invmovimientodetalle_index');
    }

    /**
     * Creates a form to delete a invMovimientoDetalle entity.
     *
     * @param InvMovimientoDetalle $invMovimientoDetalle The invMovimientoDetalle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvMovimientoDetalle $invMovimientoDetalle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invmovimientodetalle_delete', array('imdId' => $invMovimientoDetalle->getImdid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
