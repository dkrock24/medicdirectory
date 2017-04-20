<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvUnidadMedida;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invunidadmedida controller.
 *
 */
class InvUnidadMedidaController extends Controller
{
    /**
     * Lists all invUnidadMedida entities.
     *
     */
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invUnidadMedidas = $em->getRepository('AppBundle:InvUnidadMedida')->findAll();

        return $this->render('EmrBundle:invunidadmedida:index.html.twig', array(
            'invUnidadMedidas' => $invUnidadMedidas,
        ));
    }

    /**
     * Creates a new invUnidadMedida entity.
     *
     */
    public function newAction(Request $request)
    {
        $invUnidadMedida = new Invunidadmedida();
        $form = $this->createForm('EmrBundle\Form\InvUnidadMedidaType', $invUnidadMedida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invUnidadMedida->SetIumFechaCrea(new \DateTime());

            $em->persist($invUnidadMedida);
            
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

            return $this->redirectToRoute('invunidadmedida_show', array('iumId' => $invUnidadMedida->getIumid()));
        }

        return $this->render('EmrBundle:invunidadmedida:new.html.twig', array(
            'invUnidadMedida' => $invUnidadMedida,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invUnidadMedida entity.
     *
     */
    public function showAction(InvUnidadMedida $invUnidadMedida)
    {
        $deleteForm = $this->createDeleteForm($invUnidadMedida);

        return $this->render('EmrBundle:invunidadmedida:show.html.twig', array(
            'invUnidadMedida' => $invUnidadMedida,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invUnidadMedida entity.
     *
     */
    public function editAction(Request $request, InvUnidadMedida $invUnidadMedida)
    {
        $deleteForm = $this->createDeleteForm($invUnidadMedida);
        $editForm = $this->createForm('EmrBundle\Form\InvUnidadMedidaType', $invUnidadMedida);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invunidadmedida_edit', array('iumId' => $invUnidadMedida->getIumid()));
        }

        return $this->render('EmrBundle:invunidadmedida:edit.html.twig', array(
            'invUnidadMedida' => $invUnidadMedida,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invUnidadMedida entity.
     *
     */
    public function deleteAction(Request $request, InvUnidadMedida $invUnidadMedida)
    {
        $form = $this->createDeleteForm($invUnidadMedida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invUnidadMedida);
            $em->flush();
        }

        return $this->redirectToRoute('invunidadmedida_index');
    }

    /**
     * Creates a form to delete a invUnidadMedida entity.
     *
     * @param InvUnidadMedida $invUnidadMedida The invUnidadMedida entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvUnidadMedida $invUnidadMedida)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invunidadmedida_delete', array('iumId' => $invUnidadMedida->getIumid())))
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
                $repo = $em->getRepository("AppBundle:InvUnidadMedida");   
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
