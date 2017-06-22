<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeccionesModulosController extends Controller
{
    
    private $session;

    public function __construct() {
            $this->session = new Session();
    }
    
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $modulos = $em->getRepository('AppBundle:Modulo')
                ->findBy(array('modActivo' => 1))
                ;
        
                
        return $this->render('AdminBundle:secciones_modulos:index.html.twig', array(
            'modulos' => $modulos
        ));
    }

    public function showAction(\AppBundle\Entity\EavModSeccion $seccion)
    {
       
        $deleteForm = $this->createDeleteForm($seccion);
        
        return $this->render('AdminBundle:secciones_modulos:show.html.twig', array(
            'seccion' => $seccion,
            'delete_form' => $deleteForm->createView()
        ));
    }
    
    private function createDeleteForm(\AppBundle\Entity\EavModSeccion $seccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('secciones_modulos_delete', array('id' => $seccion->getModSeccId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function newAction( Request $request )
    {
        $seccion = new \AppBundle\Entity\EavModSeccion();
        
        $form = $this->createForm('AdminBundle\Form\EavModSeccionType', $seccion);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $seccion->setModSeccFechaCrea(new \DateTime());

            $em->persist($seccion);
            $flush = $em->flush($seccion);

            if ($flush == null)
            {
                    $msgBox = "Registro creado con éxito";
                    $status = "success";
            } else {
                    $msgBox = "No se pudo crear el registro ";
                    $status = "error";
            }

            $this->session->getFlashBag()->add($status,$msgBox);
            return $this->redirectToRoute('secciones_modulos_index');
        }
        
        
        return $this->render('AdminBundle:secciones_modulos:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction( Request $request, \AppBundle\Entity\EavModSeccion $secc_id )
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $seccion = $em->getRepository('AppBundle:EavModSeccion')->find($secc_id);
        
        if (!$seccion) {
            throw $this->createNotFoundException('No modulo found for id '.$id);
        }
        
        $editForm = $this->createForm(\AdminBundle\Form\EavModSeccionType::class, $seccion);
        
        $editForm->handleRequest( $request );
        
        if( $editForm->isSubmitted() && $editForm->isValid() ){
            
            $seccion->setModSeccFechaMod( new \DateTime() );
            
            $em->persist($seccion);
            
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
            
            return $this->redirectToRoute('secciones_modulos_edit', array('id' => $seccion->getModSeccId()) );
            
        }
        
        return $this->render('AdminBundle:secciones_modulos:edit.html.twig', array(
            'seccion' => $secc_id,
            'edit_form' => $editForm->createView()
        ));
    }

    public function deleteAction()
    {
        return $this->render('AdminBundle:secciones_modulos:delete.html.twig', array(
            // ...
        ));
    }
    
    public function listAction(Request $request){
        
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $get = $request->request->all();
        
        
        
        $columns = array('modSeccId', 'modSeccSeccion', 'modSeccOrden', 'modSeccFechaCrea', 'modSeccFechaMod', 'modSeccActivo');
        $get['columns'] = &$columns;
        
        $rResult = $this->ajaxTable($get, true)->getArrayResult(); 
        
        /* Data set length after filtering */
        $iFilteredTotal = count($rResult);
        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($get['sEcho']),
            "iTotalRecords" => $iFilteredTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($columns); $i++) {
                if ($columns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$columns[$i]] == "0") ? '-' : $aRow[$columns[$i]];
                } elseif ($columns[$i] != ' ') {
                    /* General output */
                    // mrivas                     
                    if( is_a($aRow[$columns[$i]], 'DateTime') ){
//                        echo 'column: '.$columns[$i],"  ";
//                        var_dump( $aRow[$columns[$i]]->format('Y-m-d H:i:s') );
                        $aRow[$columns[$i]] = $aRow[$columns[$i]]->format('Y-m-d H:i:s');
                    }else if(is_null( $aRow[$columns[$i]] ) ){
                        $aRow[$columns[$i]] = 'N/A';
                    }
                    // mrivas
                    $row[] = $aRow[$columns[$i]];
                }
            }
            $output['aaData'][] = $row;
        }
        unset($rResult);
        return new Response(
                json_encode($output)
        );
    }
    
      /**
   * @param array $get
   * @param bool $flag
   * @return array|\Doctrine\ORM\Query
   */
  public function ajaxTable(array $get, $flag = false){
    /* Indexed column (used for fast and accurate table cardinality) */
    $alias = 'a';
    /* DB table to use */
    $tableObjectName = 'AppBundle:EavModSeccion';
    /**
     * Set to default
     */
    if(!isset($get['columns']) || empty($get['columns']))
      $get['columns'] = array('id');
    $aColumns = array();
    foreach($get['columns'] as $value) $aColumns[] = $alias .'.'. $value;
    
    $cb = $this->getDoctrine()->getManager()
      ->getRepository($tableObjectName)
      ->createQueryBuilder($alias)
      ->select(str_replace(" , ", " ", implode(", ", $aColumns)))
      ->where( $alias.'.modSeccModId = '.$get['id'] )
            ;
    
    /*if ( isset( $get['iDisplayStart'] ) && $get['iDisplayLength'] != '-1' ){
      $cb->setFirstResult( (int)$get['iDisplayStart'] )
        ->setMaxResults( (int)$get['iDisplayLength'] );
    }

    // ordering.
    if ( isset( $get['iSortCol_0'] ) ){
      for ( $i=0 ; $i<intval( $get['iSortingCols'] ) ; $i++ ){
        if ( $get[ 'bSortable_'.intval($get['iSortCol_'.$i]) ] == "true" ){
          $cb->orderBy($aColumns[ (int)$get['iSortCol_'.$i] ], $get['sSortDir_'.$i]);
        }
      }
    }*/
    /*
       * Filtering
       * NOTE this does not match the built-in DataTables filtering which does it
       * word by word on any field. It's possible to do here, but concerned about efficiency
       * on very large tables, and MySQL's regex functionality is very limited
       */
    /*
    if ( isset($get['sSearch']) && $get['sSearch'] != '' ){
      $aLike = array();
      for ( $i=0 ; $i<count($aColumns) ; $i++ ){
        if ( isset($get['bSearchable_'.$i]) && $get['bSearchable_'.$i] == "true" ){
          $aLike[] = $cb->expr()->like($aColumns[$i], '\'%'. $get['sSearch'] .'%\'');
        }
      }
      if(count($aLike) > 0) $cb->andWhere(new Expr\Orx($aLike));
      else unset($aLike);
    }
    */
    /*
     * SQL queries
     * Get data to display
     */
    $query = $cb->getQuery();
    if($flag)
      return $query;
    else
      return $query->getResult();
  }

}
