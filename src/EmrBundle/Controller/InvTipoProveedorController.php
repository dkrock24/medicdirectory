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

        $idCliente = $this->get('session')->get('locationId');

        $invTipoProveedors = $em->getRepository('AppBundle:InvTipoProveedor')->findBy(array('itprCli' => $idCliente));

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

            $idCliente = $this->get('session')->get('locationId');

            $id = $em->getRepository('AppBundle:Cliente')->find($idCliente);
            $invTipoProveedor->SetItprCli($id);

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

        // Validar Registros Para Cliente
        $em = $this->getDoctrine()->getManager();
        $idCliente = $this->get('session')->get('locationId');

        $invList = $this->validarRegistros($invTipoProveedor,$idCliente);

        if($invList == null)
        {
            $msgBox = "No se pudo mostrar el elemento ";
            $status = "error";

            $invTipoProveedors = $em->getRepository('AppBundle:InvTipoProveedor')->findBy(array('itprCli' => $idCliente));

            $this->session->getFlashBag()->add($status,$msgBox);

            return $this->render('EmrBundle:invtipoproveedor:index.html.twig', array(
                'invTipoProveedors' => $invTipoProveedors,
            ));
        }
        // Fin de la Validacion

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

        // Validar Registros Para Cliente
        $em = $this->getDoctrine()->getManager();
        $idCliente = $this->get('session')->get('locationId');

        $invList = $this->validarRegistros($invTipoProveedor,$idCliente);

        if($invList == null)
        {
            $msgBox = "No se pudo mostrar el elemento ";
            $status = "error";

            $invTipoProveedors = $em->getRepository('AppBundle:InvTipoProveedor')->findBy(array('itprCli' => $idCliente));

            $this->session->getFlashBag()->add($status,$msgBox);

            return $this->render('EmrBundle:invtipoproveedor:index.html.twig', array(
                'invTipoProveedors' => $invTipoProveedors,
            ));
        }
        // Fin de la Validacion

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

    private function validarRegistros($invTipoProveedor,$idCliente){        

        $em = $this->getDoctrine()->getManager();        
        $RAW_QUERY = "SELECT *  FROM inv_tipo_proveedor where itpr_cli_id =:idCliente and itpr_id =:idInvTipoInventario";

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->bindValue("idCliente", $idCliente);
        $statement->bindValue("idInvTipoInventario", $invTipoProveedor->getItprId());
        $statement->execute();
        $invList = $statement->fetchAll();

        return $invList;
    }
}
