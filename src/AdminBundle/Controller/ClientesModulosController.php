<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ClientesModulosController extends Controller
{
    
    private $session;
    
    public function __construct() {
        $this->session = new Session();
    }
    
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository('AppBundle:Cliente')
                ->findBy(array('cliActivo' => 1))
                ;
        
        $cli_id = null;
        
        if( null !== $this->session->get('cliModNew_cli_id') ){
            $cli_id = $this->session->get('cliModNew_cli_id');
            $this->session->remove('cliModNew_cli_id');
        }
                
        return $this->render('AdminBundle:ClientesModulos:index.html.twig', array(
            'clientes' => $clientes,
            'cli_id' => $cli_id
        ));
    }

    public function newAction( Request $request )
    {
        $cliMod = new \AppBundle\Entity\ClienteModulo();
        
        $cli_id = null;
        
        $form = $this->createForm( 'AdminBundle\Form\ClienteModuloType', $cliMod );
        
        $form->handleRequest( $request );
        
        if( $form->isValid() && $form->isSubmitted() ){
            
            $em = $this->getDoctrine()->getManager();
            
            $cliMod->setCliModFechaCrea( new \DateTime() );
            $cli_id = $cliMod->getCliModCli()->getCliId();
            
            $em->persist($cliMod);
            $flush = $em->flush();            

            if( $flush == null ){
                    $msgBox = "Registro creado con éxito";
                    $status = "success";
            } else {
                    $msgBox = "No se pudo crear el registro ";
                    $status = "error";
            }

            $this->session->set('cliModNew_cli_id', $cli_id);
            $this->session->getFlashBag()->add($status,$msgBox);
            return $this->redirectToRoute('clientes_modulos_index');
            
        }
        
        return $this->render('AdminBundle:ClientesModulos:new.html.twig', array(
            'form' => $form->createView()
        ));
    }


    public function deleteAction( Request $request )
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $cliModId = $request->request->get('id');
        
        
        $cliente_modulo = $em->getRepository('AppBundle:ClienteModulo')
                ->find( $cliModId );
        
        $cliente_modulo->setCliModActivo( false );
        $cliente_modulo->setCliModFechaMod( new \DateTime() );
        
        $em->persist( $cliente_modulo );
        $flush = $em->flush();
        
        if ($flush == null){
            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
    
    public function tableListAction(Request $request){
        
        $get = $request->request->all();
        
        $rResult = $this->ajaxTable($get); 
        
        $records = array();
      
        foreach( $rResult as $cliMoRecord ){
            $fecha_crea = is_null($cliMoRecord->getCliModFechaCrea()) ? '' : $cliMoRecord->getCliModFechaCrea()->format('Y-m-d H:i:s');
            $fecha_mod = is_null($cliMoRecord->getCliModFechaMod()) ? '' : $cliMoRecord->getCliModFechaMod()->format('Y-m-d H:i:s');
            $records[] = array(
                $cliMoRecord->getCliMod(),
                $cliMoRecord->getCliModMod()->getModModulo(),
                $fecha_crea,
                $fecha_mod,
                $cliMoRecord->getCliModActivo()
            );
        }
        
        $output = array(
            'aaData' => $records
        );
        
        return new Response(
                json_encode($output)
        );
    }
    
  public function ajaxTable(array $get){
      
      $em = $this->getDoctrine()->getManager();
      
      $cliMo = $em->getRepository('AppBundle:ClienteModulo')
              ->findBy(array( 'cliModCliId' => $get['id']))
              ;
      
      return $cliMo;
   
  }

}
