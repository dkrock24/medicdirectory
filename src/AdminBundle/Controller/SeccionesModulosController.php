<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeccionesModulosController extends Controller
{
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

    public function showAction()
    {
        return $this->render('AdminBundle:secciones_modulos:show.html.twig', array(
            // ...
        ));
    }

    public function newAction()
    {
        return $this->render('AdminBundle:secciones_modulos:new.html.twig', array(
            // ...
        ));
    }

    public function editAction()
    {
        return $this->render('AdminBundle:secciones_modulos:edit.html.twig', array(
            // ...
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
