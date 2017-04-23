<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvMovimiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invmovimiento controller.
 *
 */
class InvMovimientoController extends Controller
{
    /**
     * Lists all invMovimiento entities.
     *
     */
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invMovimientos = $em->getRepository('AppBundle:InvMovimiento')->findAll();

        return $this->render('EmrBundle:invmovimiento:index.html.twig', array(
            'invMovimientos' => $invMovimientos,
        ));
    }

    /**
     * Creates a new invMovimiento entity.
     *
     */
    public function newAction(Request $request)
    {
        $invMovimiento  = new Invmovimiento();
        $idCliente      = $this->get('session')->get('locationId');

        $form = $this->createForm('EmrBundle\Form\InvMovimientoType', $invMovimiento, array('id_cliente_session'=> $idCliente));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invMovimiento->SetImoFechaCrea(new \DateTime());
            $em->persist($invMovimiento);
            
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

            return $this->redirectToRoute('invmovimiento_show', array('imoId' => $invMovimiento->getImoid()));
        }

        return $this->render('EmrBundle:invmovimiento:new.html.twig', array(
            'invMovimiento' => $invMovimiento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invMovimiento entity.
     *
     */
    public function showAction(InvMovimiento $invMovimiento)
    {
        $deleteForm = $this->createDeleteForm($invMovimiento);

        return $this->render('EmrBundle:invmovimiento:show.html.twig', array(
            'invMovimiento' => $invMovimiento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invMovimiento entity.
     *
     */
    public function editAction(Request $request, InvMovimiento $invMovimiento)
    {
        $deleteForm = $this->createDeleteForm($invMovimiento);
        $editForm = $this->createForm('EmrBundle\Form\InvMovimientoType', $invMovimiento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invmovimiento_edit', array('imoId' => $invMovimiento->getImoid()));
        }

        return $this->render('EmrBundle:invmovimiento:edit.html.twig', array(
            'invMovimiento' => $invMovimiento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invMovimiento entity.
     *
     */
    public function deleteAction(Request $request, InvMovimiento $invMovimiento)
    {
        $form = $this->createDeleteForm($invMovimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invMovimiento);
            $em->flush();
        }

        return $this->redirectToRoute('invmovimiento_index');
    }

    /**
     * Creates a form to delete a invMovimiento entity.
     *
     * @param InvMovimiento $invMovimiento The invMovimiento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvMovimiento $invMovimiento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invmovimiento_delete', array('imoId' => $invMovimiento->getImoid())))
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
                $repo = $em->getRepository("AppBundle:InvMovimiento");   
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
