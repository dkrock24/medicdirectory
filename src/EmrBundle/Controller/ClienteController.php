<?php

namespace EmrBundle\Controller;

use AppBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller
{
    /**
     * Lists all cliente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clientes = $em->getRepository('AppBundle:Cliente')->findAll();

        return $this->render('EmrBundle:cliente:index.html.twig', array(
            'clientes' => $clientes,
        ));
    }

    /**
     * Creates a new cliente entity.
     *
     */
    public function newAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		
        $cliente = new Cliente();
        $form = $this->createForm('EmrBundle\Form\ClienteType', $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush($cliente);

            return $this->redirectToRoute('cliente_show', array('id' => $cliente->getCliId()));
        }
		
		$methodPay = $em->getRepository('AppBundle:MetodoPago')->findBy( array("mepActivo"=>1) );
		

        return $this->render('EmrBundle:cliente:new.html.twig', array(
            'cliente' => $cliente,
			'methodPay'=> $methodPay,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cliente entity.
     *
     */
    public function showAction(Cliente $cliente)
    {
        $deleteForm = $this->createDeleteForm($cliente);

        return $this->render('EmrBundle:cliente:show.html.twig', array(
            'cliente' => $cliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cliente entity.
     *
     */
    public function editAction(Request $request, Cliente $cliente)
    {
        $deleteForm = $this->createDeleteForm($cliente);
        $editForm = $this->createForm('EmrBundle\Form\ClienteType', $cliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cliente_edit', array('id' => $cliente->getCliId()));
        }

        return $this->render('EmrBundle:cliente:edit.html.twig', array(
            'cliente' => $cliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cliente entity.
     *
     */
    public function deleteAction(Request $request, Cliente $cliente)
    {
        $form = $this->createDeleteForm($cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cliente);
            $em->flush();
        }

        return $this->redirectToRoute('cliente_index');
    }

    /**
     * Creates a form to delete a cliente entity.
     *
     * @param Cliente $cliente The cliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cliente $cliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cliente_delete', array('id' => $cliente->getCliId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
	
	
	//Starts customs actions
	public function checkAvailableUserAction( Request $request )
	{
		
		//$result = "";
		//$iCountryId = $request->get('id');
		$sUsername = $request->get("username");
		
		try
		{
			
			if( isset($sUsername) && !empty($sUsername) ) 
			{
				$em = $this->getDoctrine()->getManager();
				$RAW_QUERY = "SELECT * FROM usuario u WHERE usu_usuario =:username";

				$statement = $em->getConnection()->prepare($RAW_QUERY);
				$statement->bindValue("username", $sUsername);
				$statement->execute();
				$result = $statement->fetchAll();
			}

			if( count($result) == 0 )
			{
				echo 1; //is available
			}
			else
			{
				echo 0; //in not available
			}
		}
		catch (\Exception $e){
				echo ($e->getMessage());
		}
		
		
		exit();
		//return  $response = new JsonResponse($result);

	}
}
