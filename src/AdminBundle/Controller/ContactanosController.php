<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Contactanos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Contactano controller.
 *
 */
class ContactanosController extends Controller
{
    /**
     * Lists all contactano entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contactanos = $em->getRepository('AppBundle:Contactanos')->findAll();

        return $this->render('AdminBundle:Contactanos:index.html.twig', array(
            'contactanos' => $contactanos,
        ));
    }

    /**
     * Creates a new contactano entity.
     *
     */
    public function newAction(Request $request)
    {
        $contactano = new Contactano();
        $form = $this->createForm('AdminBundle\Form\ContactanosType', $contactano);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactano);
            $em->flush();

            return $this->redirectToRoute('contactanos_show', array('id' => $contactano->getId()));
        }

        return $this->render('AdminBundle:Contactanos:new.html.twig', array(
            'contactano' => $contactano,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contactano entity.
     *
     */
    public function showAction(Contactanos $contactano)
    {
        $deleteForm = $this->createDeleteForm($contactano);

        return $this->render('AdminBundle:Contactanos:show.html.twig', array(
            'contactano' => $contactano,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contactano entity.
     *
     */
    public function editAction(Request $request, Contactanos $contactano)
    {
        $deleteForm = $this->createDeleteForm($contactano);
        $editForm = $this->createForm('AdminBundle\Form\ContactanosType', $contactano);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contactanos_edit', array('id' => $contactano->getId()));
        }

        return $this->render('AdminBundle:Contactanos:edit.html.twig', array(
            'contactano' => $contactano,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contactano entity.
     *
     */
    public function deleteAction(Request $request, Contactanos $contactano)
    {
        $form = $this->createDeleteForm($contactano);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contactano);
            $em->flush();
        }

        return $this->redirectToRoute('contactanos_index');
    }

    /**
     * Creates a form to delete a contactano entity.
     *
     * @param Contactanos $contactano The contactano entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contactanos $contactano)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactanos_delete', array('id' => $contactano->getId())))
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
                $repo = $em->getRepository("AppBundle:Contactanos");   
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
