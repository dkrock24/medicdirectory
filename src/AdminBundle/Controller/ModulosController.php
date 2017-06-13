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
		//exit("x");
//        echo '<pre>';
//        \Doctrine\Common\Util\Debug::dump($modulos);
//        exit;
        return $this->render('AdminBundle:modulos:index.html.twig', array(
            'modulos' => $modulos,
        ));
    }
    
    public function newAction( Request $request ){
        
        $modulo = new \AppBundle\Entity\Modulo();
        
        $form = $this->createForm('AdminBundle\Form\ModuloType', $modulo);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) { //&& $form->isValid()
            
            $em = $this->getDoctrine()->getManager();

            $form_data = $request->get('appbundle_modulo');
            
            $mod_esp = $this->getDoctrine()->getManager()
                    ->getRepository('AppBundle:Especialidad')
                    ->find( $form_data['modEsp'] );
            
            $modulo->setModModulo( $form_data['modModulo'] );
            $modulo->setModEsp( $mod_esp );
            $modulo->setModActivo( $form_data['modActivo'] );
            $modulo->setModFechaCrea(new \DateTime());
            
            $em->persist( $modulo );
            $em->flush();
            
            $modulo->setModHashCode( sha1( $modulo->getModId().$modulo->getModModulo() ) );
            
            $em->persist( $modulo );
            $flush = $em->flush();

            if( !empty($form_data['secciones']) )
            {
                foreach( $form_data['secciones'] as $secc ){
                    
                    $mod_secc = new \AppBundle\Entity\EavModSeccion();
                    
                    $mod = $this->getDoctrine()->getManager()
                    ->getRepository('AppBundle:Modulo')
                    ->find( $modulo->getModId() );
                    
                    $mod_secc->setModulos( $mod );
                    //$mod_secc->setModSeccModId( $modulo );
                    $mod_secc->setModSeccSeccion( $secc['modSeccSeccion'] );
                    $mod_secc->setModSeccOrden( $secc['modSeccOrden'] );
                    $mod_secc->setModSeccActivo( $secc['modSeccActivo'] );
                    $mod_secc->setModSeccFechaCrea( new \DateTime() );
                    
                    $em->persist($mod_secc);
                    $flush = $em->flush($mod_secc);
                    
                }
            }

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
            //'modulo' => $modulo,
            'form' => $form->createView(),
        ));
        
    }
    
    public function editAction( Request $request, \AppBundle\Entity\Modulo $mod_id ){
        
        $deleteForm = $this->createDeleteForm($mod_id);
        $editForm = $this->createForm('AdminBundle\Form\ModuloType', $mod_id);
        $editForm->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $secciones = $em->getRepository('AppBundle:EavModSeccion')
                ->findBy( array('modSeccModId' => $mod_id) );
        
//        echo '<pre>';
//        \Doctrine\Common\Util\Debug::dump($editForm);
//        exit;
        
        return $this->render('AdminBundle:modulos:edit.html.twig', array(
            'modulo' => $mod_id,
            'edit_form' => $editForm->createView(),
            'secciones' => $secciones,
            'delete_form' => $deleteForm->createView()
        ));
         
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
    
}
