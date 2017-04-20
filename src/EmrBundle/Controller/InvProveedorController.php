<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvProveedor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invproveedor controller.
 *
 */
class InvProveedorController extends Controller
{
    /**
     * Lists all invProveedor entities.
     *
     */
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invProveedors = $em->getRepository('AppBundle:InvProveedor')->findAll();

        return $this->render('EmrBundle:invproveedor:index.html.twig', array(
            'invProveedors' => $invProveedors,
        ));
    }

    /**
     * Creates a new invProveedor entity.
     *
     */
    public function newAction(Request $request)
    {
        $invProveedor = new Invproveedor();
        $form = $this->createForm('EmrBundle\Form\InvProveedorType', $invProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invProveedor->SetIprFechaCrea(new \DateTime());
            $em->persist($invProveedor);
            
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

            return $this->redirectToRoute('invproveedor_show', array('iprId' => $invProveedor->getIprid()));
        }

        return $this->render('EmrBundle:invproveedor:new.html.twig', array(
            'invProveedor' => $invProveedor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invProveedor entity.
     *
     */
    public function showAction(InvProveedor $invProveedor)
    {
        $deleteForm = $this->createDeleteForm($invProveedor);

        return $this->render('EmrBundle:invproveedor:show.html.twig', array(
            'invProveedor' => $invProveedor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invProveedor entity.
     *
     */
    public function editAction(Request $request, InvProveedor $invProveedor)
    {
        $deleteForm = $this->createDeleteForm($invProveedor);
        $editForm = $this->createForm('EmrBundle\Form\InvProveedorType', $invProveedor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invproveedor_edit', array('iprId' => $invProveedor->getIprid()));
        }

        return $this->render('EmrBundle:invproveedor:edit.html.twig', array(
            'invProveedor' => $invProveedor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invProveedor entity.
     *
     */
    public function deleteAction(Request $request, InvProveedor $invProveedor)
    {
        $form = $this->createDeleteForm($invProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invProveedor);
            $em->flush();
        }

        return $this->redirectToRoute('invproveedor_index');
    }

    /**
     * Creates a form to delete a invProveedor entity.
     *
     * @param InvProveedor $invProveedor The invProveedor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvProveedor $invProveedor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invproveedor_delete', array('iprId' => $invProveedor->getIprid())))
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
                $repo = $em->getRepository("AppBundle:InvProveedor");   
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
