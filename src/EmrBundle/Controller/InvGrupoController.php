<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvGrupo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invgrupo controller.
 *
 */
class InvGrupoController extends Controller
{
    /**
     * Lists all invGrupo entities.
     *
     */

    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $idCliente  = $this->get('session')->get('locationId');        
        $invGrupos  = $em->getRepository('AppBundle:InvGrupo')->findBy(array('igrCli' => $idCliente));

        return $this->render('EmrBundle:invgrupo:index.html.twig', array(
            'invGrupos' => $invGrupos,
        ));
    }

    /**
     * Creates a new invGrupo entity.
     *
     */
    public function newAction(Request $request)
    {
        $invGrupo = new Invgrupo();
        $form = $this->createForm('EmrBundle\Form\InvGrupoType', $invGrupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invGrupo->SetIgrFechaCreacion(new \DateTime());
            $idCliente = $this->get('session')->get('locationId');

            $id = $em->getRepository('AppBundle:Cliente')->find($idCliente);
            $invGrupo->SetIgrCli($id);

            $em->persist($invGrupo);
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

            return $this->redirectToRoute('invgrupo_show', array('igrId' => $invGrupo->getIgrid()));
        }

        return $this->render('EmrBundle:invgrupo:new.html.twig', array(
            'invGrupo' => $invGrupo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invGrupo entity.
     *
     */
    public function showAction(InvGrupo $invGrupo)
    {
        $deleteForm = $this->createDeleteForm($invGrupo);

        return $this->render('EmrBundle:invgrupo:show.html.twig', array(
            'invGrupo' => $invGrupo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invGrupo entity.
     *
     */
    public function editAction(Request $request, InvGrupo $invGrupo)
    {
        $deleteForm = $this->createDeleteForm($invGrupo);
        $editForm = $this->createForm('EmrBundle\Form\InvGrupoType', $invGrupo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invgrupo_edit', array('igrId' => $invGrupo->getIgrid()));
        }

        return $this->render('EmrBundle:invgrupo:edit.html.twig', array(
            'invGrupo' => $invGrupo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invGrupo entity.
     *
     */
    public function deleteAction(Request $request, InvGrupo $invGrupo)
    {
        $form = $this->createDeleteForm($invGrupo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invGrupo);
            $em->flush();
        }

        return $this->redirectToRoute('invgrupo_index');
    }

    /**
     * Creates a form to delete a invGrupo entity.
     *
     * @param InvGrupo $invGrupo The invGrupo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvGrupo $invGrupo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invgrupo_delete', array('igrId' => $invGrupo->getIgrid())))
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
                $repo = $em->getRepository("AppBundle:InvArea");   
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
