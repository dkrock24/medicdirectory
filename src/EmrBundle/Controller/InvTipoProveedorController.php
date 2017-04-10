<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvTipoProveedor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invtipoproveedor controller.
 *
 */
class InvTipoProveedorController extends Controller
{
    /**
     * Lists all invTipoProveedor entities.
     *
     */
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invTipoProveedors = $em->getRepository('AppBundle:InvTipoProveedor')->findAll();

        return $this->render('EmrBundle:invtipoproveedor:index.html.twig', array(
            'invTipoProveedors' => $invTipoProveedors,
        ));
    }

    /**
     * Creates a new invTipoProveedor entity.
     *
     */
    public function newAction(Request $request)
    {
        $invTipoProveedor = new Invtipoproveedor();
        $form = $this->createForm('EmrBundle\Form\InvTipoProveedorType', $invTipoProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invTipoProveedor->SetItprFechaCrea(new \DateTime());
            $em->persist($invTipoProveedor);
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

            return $this->redirectToRoute('invtipoproveedor_show', array('itprId' => $invTipoProveedor->getItprid()));
        }

        return $this->render('EmrBundle:invtipoproveedor:new.html.twig', array(
            'invTipoProveedor' => $invTipoProveedor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invTipoProveedor entity.
     *
     */
    public function showAction(InvTipoProveedor $invTipoProveedor)
    {
        $deleteForm = $this->createDeleteForm($invTipoProveedor);

        return $this->render('EmrBundle:invtipoproveedor:show.html.twig', array(
            'invTipoProveedor' => $invTipoProveedor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invTipoProveedor entity.
     *
     */
    public function editAction(Request $request, InvTipoProveedor $invTipoProveedor)
    {
        $deleteForm = $this->createDeleteForm($invTipoProveedor);
        $editForm = $this->createForm('EmrBundle\Form\InvTipoProveedorType', $invTipoProveedor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invtipoproveedor_edit', array('itprId' => $invTipoProveedor->getItprid()));
        }

        return $this->render('EmrBundle:invtipoproveedor:edit.html.twig', array(
            'invTipoProveedor' => $invTipoProveedor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invTipoProveedor entity.
     *
     */
    public function deleteAction(Request $request, InvTipoProveedor $invTipoProveedor)
    {
        $form = $this->createDeleteForm($invTipoProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invTipoProveedor);
            $em->flush();
        }

        return $this->redirectToRoute('invtipoproveedor_index');
    }

    /**
     * Creates a form to delete a invTipoProveedor entity.
     *
     * @param InvTipoProveedor $invTipoProveedor The invTipoProveedor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvTipoProveedor $invTipoProveedor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invtipoproveedor_delete', array('itprId' => $invTipoProveedor->getItprid())))
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
                $repo = $em->getRepository("AppBundle:InvTipoProveedor");   
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
