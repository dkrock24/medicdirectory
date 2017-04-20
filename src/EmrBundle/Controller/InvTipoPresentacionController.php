<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvTipoPresentacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invtipopresentacion controller.
 *
 */
class InvTipoPresentacionController extends Controller
{
    /**
     * Lists all invTipoPresentacion entities.
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

        $invTipoPresentacions = $em->getRepository('AppBundle:InvTipoPresentacion')->findBy(array('itpCli' => $idCliente));

        return $this->render('EmrBundle:invtipopresentacion:index.html.twig', array(
            'invTipoPresentacions' => $invTipoPresentacions,
        ));
    }

    /**
     * Creates a new invTipoPresentacion entity.
     *
     */
    public function newAction(Request $request)
    {
        $invTipoPresentacion = new Invtipopresentacion();
        $form = $this->createForm('EmrBundle\Form\InvTipoPresentacionType', $invTipoPresentacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invTipoPresentacion->SetItpFechaCrea(new \DateTime());

            $idCliente = $this->get('session')->get('locationId');

            $id = $em->getRepository('AppBundle:Cliente')->find($idCliente);
            $invTipoPresentacion->SetItpCli($id);

            $em->persist($invTipoPresentacion);

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

            return $this->redirectToRoute('invtipopresentacion_show', array('itpId' => $invTipoPresentacion->getItpid()));
        }

        return $this->render('EmrBundle:invtipopresentacion:new.html.twig', array(
            'invTipoPresentacion' => $invTipoPresentacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invTipoPresentacion entity.
     *
     */
    public function showAction(InvTipoPresentacion $invTipoPresentacion)
    {
        $deleteForm = $this->createDeleteForm($invTipoPresentacion);

        return $this->render('EmrBundle:invtipopresentacion:show.html.twig', array(
            'invTipoPresentacion' => $invTipoPresentacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invTipoPresentacion entity.
     *
     */
    public function editAction(Request $request, InvTipoPresentacion $invTipoPresentacion)
    {
        $deleteForm = $this->createDeleteForm($invTipoPresentacion);
        $editForm = $this->createForm('EmrBundle\Form\InvTipoPresentacionType', $invTipoPresentacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invtipopresentacion_edit', array('itpId' => $invTipoPresentacion->getItpid()));
        }

        return $this->render('EmrBundle:invtipopresentacion:edit.html.twig', array(
            'invTipoPresentacion' => $invTipoPresentacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invTipoPresentacion entity.
     *
     */
    public function deleteAction(Request $request, InvTipoPresentacion $invTipoPresentacion)
    {
        $form = $this->createDeleteForm($invTipoPresentacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invTipoPresentacion);
            $em->flush();
        }

        return $this->redirectToRoute('invtipopresentacion_index');
    }

    /**
     * Creates a form to delete a invTipoPresentacion entity.
     *
     * @param InvTipoPresentacion $invTipoPresentacion The invTipoPresentacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvTipoPresentacion $invTipoPresentacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invtipopresentacion_delete', array('itpId' => $invTipoPresentacion->getItpid())))
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
                $repo = $em->getRepository("AppBundle:InvTipoPresentacion");   
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
