<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\InvCategoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Invcategorium controller.
 *
 */
class InvCategoriaController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }
    /**
     * Lists all invCategorium entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$invCategorias = $em->getRepository('AppBundle:InvCategoria')->findAll();
        //$invCategorias = $em->$repository->findBy(array('icaCategoria' => 'IS'));
        $idCliente = $this->get('session')->get('locationId');

        $invCategorias = $em->getRepository('AppBundle:InvCategoria')->findBy(array('icaCli' => $idCliente));

        return $this->render('EmrBundle:invcategoria:index.html.twig', array(
            'invCategorias' => $invCategorias,
        ));
    }

    /**
     * Creates a new invCategorium entity.
     *
     */
    public function newAction(Request $request)
    {
        $idUser =  $this->getUser()->getUsuId();


        $invCategorium = new InvCategoria();
        $form = $this->createForm('EmrBundle\Form\InvCategoriaType', $invCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $cliente = $em->getRepository('AppBundle:Cliente')->find($idUser);
            $invCategorium->SetIcaFechaCrea(new \DateTime());

            $idCliente = $this->get('session')->get('locationId');
            $id = $em->getRepository('AppBundle:Cliente')->find($idCliente);

            $invCategorium->SetIcaCli($id);

            $em->persist($invCategorium);

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
            return $this->redirectToRoute('invcategoria_show', array('icaId' => $invCategorium->getIcaid()));
        }

        return $this->render('EmrBundle:invcategoria:new.html.twig', array(
            'invCategorium' => $invCategorium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a invCategorium entity.
     *
     */
    public function showAction(InvCategoria $invCategorium)
    {
        $deleteForm = $this->createDeleteForm($invCategorium);

        // Validar Registros Para Cliente
        $em = $this->getDoctrine()->getManager();
        $idCliente = $this->get('session')->get('locationId');

        $invList = $this->validarRegistros($invCategorium,$idCliente);

        if($invList == null)
        {
            $msgBox = "No se pudo mostrar el elemento ";
            $status = "error";

            $invCategorias = $em->getRepository('AppBundle:InvCategoria')->findBy(array('icaCli' => $idCliente));

            $this->session->getFlashBag()->add($status,$msgBox);

            return $this->render('EmrBundle:invcategoria:index.html.twig', array(
                'invCategorias' => $invCategorias,
            ));
        }
        // Fin de la Validacion

        return $this->render('EmrBundle:invcategoria:show.html.twig', array(
            'invCategorium' => $invCategorium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing invCategorium entity.
     *
     */
    public function editAction(Request $request, InvCategoria $invCategorium)
    {
        $deleteForm = $this->createDeleteForm($invCategorium);

        // Validar Registros Para Cliente
        $em = $this->getDoctrine()->getManager();
        $idCliente = $this->get('session')->get('locationId');

        $invList = $this->validarRegistros($invCategorium,$idCliente);

        if($invList == null)
        {
            $msgBox = "No se pudo mostrar el elemento ";
            $status = "error";

            $invCategorias = $em->getRepository('AppBundle:InvCategoria')->findBy(array('icaCli' => $idCliente));

            $this->session->getFlashBag()->add($status,$msgBox);

            return $this->render('EmrBundle:invcategoria:index.html.twig', array(
                'invCategorias' => $invCategorias,
            ));
        }
        // Fin de la Validacion


        $editForm = $this->createForm('EmrBundle\Form\InvCategoriaType', $invCategorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $invCategorium->SetIcaFechaMod(new \DateTime());

            $flush = $em->flush();

            if ($flush == null)
            {
                $msgBox = "Registro actualizado con éxito";
                $status = "success";
            } else {
                $msgBox = "No se ha podido actualizar el registro ";
                $status = "error";
            }
            
            $this->session->getFlashBag()->add($status,$msgBox);

            return $this->redirectToRoute('invcategoria_edit', array('icaId' => $invCategorium->getIcaid()));
        }

        return $this->render('EmrBundle:invcategoria:edit.html.twig', array(
            'invCategorium' => $invCategorium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a invCategorium entity.
     *
     */
    public function deleteAction(Request $request, InvCategoria $invCategorium)
    {
        $form = $this->createDeleteForm($invCategorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invCategorium);
            $em->flush();
        }

        return $this->redirectToRoute('invcategoria_index');
    }

    /**
     * Creates a form to delete a invCategorium entity.
     *
     * @param InvCategoria $invCategorium The invCategorium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvCategoria $invCategorium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invcategoria_delete', array('icaId' => $invCategorium->getIcaid())))
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
                $repo = $em->getRepository("AppBundle:InvCategoria");   
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

    private function validarRegistros($invCategorium,$idCliente){        

        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = "SELECT *  FROM inv_categoria where ica_cli_id =:idCliente and ica_id =:idInvCategoria";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->bindValue("idCliente", $idCliente);
        $statement->bindValue("idInvCategoria", $invCategorium->getIcaId());
        $statement->execute();
        $invList = $statement->fetchAll();

        return $invList;
    }
}
