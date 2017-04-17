<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\Inventario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Inventario controller.
 *
 */
class InventarioController extends Controller
{
    /**
     * Lists all inventario entities.
     *
     */
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inventarios = $em->getRepository('AppBundle:Inventario')->findAll();

        return $this->render('EmrBundle:inventario:index.html.twig', array(
            'inventarios' => $inventarios,
        ));
    }

    /**
     * Creates a new inventario entity.
     *
     */
    public function newAction(Request $request)
    {
        $inventario = new Inventario();
        $form = $this->createForm('EmrBundle\Form\InventarioType', $inventario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $inventario->SetInvFechaCrea(new \DateTime());
            $em->persist($inventario);
            
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

            return $this->redirectToRoute('inventario_show', array('invId' => $inventario->getInvid()));
        }

        return $this->render('EmrBundle:inventario:new.html.twig', array(
            'inventario' => $inventario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a inventario entity.
     *
     */
    public function showAction(Inventario $inventario)
    {
        $deleteForm = $this->createDeleteForm($inventario);

        return $this->render('EmrBundle:inventario:show.html.twig', array(
            'inventario' => $inventario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing inventario entity.
     *
     */
    public function editAction(Request $request, Inventario $inventario)
    {
        $deleteForm = $this->createDeleteForm($inventario);
        $editForm = $this->createForm('AppBundle\Form\InventarioType', $inventario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inventario_edit', array('invId' => $inventario->getInvid()));
        }

        return $this->render('inventario/edit.html.twig', array(
            'inventario' => $inventario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a inventario entity.
     *
     */
    public function deleteAction(Request $request, Inventario $inventario)
    {
        $form = $this->createDeleteForm($inventario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($inventario);
            $em->flush();
        }

        return $this->redirectToRoute('inventario_index');
    }

    /**
     * Creates a form to delete a inventario entity.
     *
     * @param Inventario $inventario The inventario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Inventario $inventario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inventario_delete', array('invId' => $inventario->getInvid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
