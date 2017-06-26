<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ModulosController extends Controller
{
    
    private $session;

    public function __construct() {
            $this->session = new Session();
    }
    
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $modulos = $em->getRepository('AppBundle:Modulo')->findAll();
        
        return $this->render('AdminBundle:modulos:index.html.twig', array(
            'modulos' => $modulos,
        ));
    }
    
    public function showAction(\AppBundle\Entity\Modulo $modulo)
    {
        $deleteForm = $this->createDeleteForm($modulo);

        return $this->render('AdminBundle:modulos:show.html.twig', array(
            'modulo' => $modulo,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    public function newAction( Request $request ){
        
        $modulo = new \AppBundle\Entity\Modulo();
        
        $form = $this->createForm('AdminBundle\Form\ModuloType', $modulo);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $modulo->setModFechaCrea(new \DateTime());
            
            foreach( $modulo->getSecciones()->toArray() as $mod_secc ){
                $mod_secc->setModSeccFechaCrea( new \DateTime() );
                $mod_secc->setModSeccModId( $modulo );
                
            }

            $em->persist($modulo);
            $flush = $em->flush($modulo);

            if ($flush == null)
            {
                    $msgBox = "Registro creado con éxito";
                    $status = "success";
            } else {
                    $msgBox = "No se pudo crear el registro ";
                    $status = "error";
            }

            $this->session->getFlashBag()->add($status,$msgBox);
            return $this->redirectToRoute('modulos_index');
        }
        
        
        return $this->render('AdminBundle:modulos:new.html.twig', array(
            'form' => $form->createView(),
        ));
        
    }
    
    public function editAction( Request $request, \AppBundle\Entity\Modulo $mod_id ){
        
        $em = $this->getDoctrine()->getManager();
        $modulo = $em->getRepository('AppBundle:Modulo')->find($mod_id);

        if (!$modulo) {
            throw $this->createNotFoundException('No modulo found for id '.$id);
        }
        
        $originalSecciones = new \Doctrine\Common\Collections\ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($modulo->getSecciones() as $seccion) {
            $originalSecciones->add($seccion);
        }
        
        $editForm = $this->createForm(\AdminBundle\Form\ModuloType::class, $modulo);
        
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            
            foreach( $modulo->getSecciones()->toArray() as $mod_secc ){
                $mod_secc->setModSeccFechaMod( new \DateTime() );
                $mod_secc->setModSeccModId( $modulo );
            }
            
            
             // remove the relationship between the tag and the Task
             foreach ($originalSecciones as $seccion) {
                 if (false === $modulo->getSecciones()->contains($seccion)) {
                     // if it was a many-to-one relationship, remove the relationship like this
                     $seccion->setModSeccActivo(false);

                     $em->persist($seccion);

                     // if you wanted to delete the Tag entirely, you can also do that
                     // $em->remove($tag);
                 }
             }             

             $em->persist($modulo);
             $em->flush();

             // redirect back to some edit page
                return $this->render('AdminBundle:modulos:edit.html.twig', array(
                    'modulo' => $mod_id,
                    'edit_form' => $editForm->createView()
                ));
         }
        
        return $this->render('AdminBundle:modulos:edit.html.twig', array(
            'modulo' => $mod_id,
            'edit_form' => $editForm->createView()
        ));
         
    }
    
    
    
    public function deleteAction(Request $request, \AppBundle\Entity\Modulo $modulo)
    {
        $form = $this->createDeleteForm($modulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $modulo->setModActivo(false);
            $em->persist($modulo);
            $flush = $em->flush();
			
			if ($flush == null)
			{
				$msgBox = "El registro fue eliminado con éxito";
				$status = "success";
			} else {
				$msgBox = "No se ha podido eliminar el registro ";
				$status = "error";
			}
			
			$this->session->getFlashBag()->add($status,$msgBox);
        }

        return $this->redirectToRoute('modulos_index');
    }
    
        /**
     * Creates a form to delete a modulo entity.
     *
     * @param Pais $pai The modulo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(\AppBundle\Entity\Modulo $modulo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modulos_delete', array('id' => $modulo->getModId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    public function deleteCustomAction( Request $request )
    {
            $iId = $request->request->get('id');

            if( isset($iId) && $iId > 0 )
            {

                    try
                    {
                            $em = $this->getDoctrine()->getManager();
                            $repo = $em->getRepository("AppBundle:Modulo");	
                            $item = $repo->find($iId);
                            $item->setModActivo(false);
                            $item->setModFechaMod( new \DateTime() );
                            $em->persist( $item );
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
