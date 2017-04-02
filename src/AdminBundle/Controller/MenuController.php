<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\MenuRol;
/**
 * Menu controller.
 *
 */
class MenuController extends Controller
{
	
	private $session;
	
	public function __construct() {
		$this->session = new Session();
	}
    /**
     * Lists all menu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $menus = $em->getRepository('AppBundle:Menu')->findAll();

		$dinamicMenu = $this->get_main_parent();
		
        return $this->render('menu/index.html.twig', array(
            'menus' => $menus,
			'dinamicMenu' => $dinamicMenu
        ));
    }

    /**
     * Creates a new menu entity.
     *
     */
    public function newAction(Request $request)
    {
        $menu = new Menu();
        $form = $this->createForm('AdminBundle\Form\MenuType', $menu);
        $form->handleRequest($request);
		
		$permisos = $form['permisos']->getData();
		//$permisos = $form->get("permisos")->getData();

				
		
        if ($form->isSubmitted() && $form->isValid()) {
			
			//exit();
	
            $em = $this->getDoctrine()->getManager();
			
			$menu->setMenFechaCrea(new \DateTime());
			
            $em->persist($menu);			
			$flush = $em->flush();

			if ($flush == null) {

				$msgBox = "Registro creado con éxito";
				$status = "success";
				
				for($i=0; $i < count($permisos); $i++)
				{
					//$name = $permisos[$i]['id']."-";
					$idPermiso = $permisos[$i]->getRolId();
					
					$lastId = $menu->getMenId();
					
					$em = $this->getDoctrine()->getManager();
					$menu_repo = $em->getRepository("AppBundle:Menu")->find($lastId);
					$permiso_repo = $em->getRepository("AppBundle:Rol")->find($idPermiso);

					$men_per = new MenuRol();
					$men_per->setMenRolMen( $menu_repo ); //Id del menu creado
					$men_per->setMenRolRol( $permiso_repo ); //Id del permiso
					$men_per->setMenRolActivo( 1 ); //Id del permiso
					$men_per->setMenRolFechaCrea( new \Datetime());
					$em->persist($men_per);			
					$flush = $em->flush();
					if ($flush != null)
					{
						$msgBox = "No se pudieron crear los roles ";
						$status = "error";
					}
				}
				
			} else {
				$msgBox = "No se pudo crear el registro ";
				$status = "error";
			}
			
			$this->session->getFlashBag()->add($status,$msgBox);
			return $this->redirectToRoute('menu_show', array('id' => $menu->getMenId()));
        }

        return $this->render('menu/new.html.twig', array(
            'menu' => $menu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a menu entity.
     *
     */
    public function showAction(Menu $menu)
    {
		
		$deleteForm = $this->createDeleteForm($menu);
		
		$em = $this->getDoctrine()->getManager();

		$permisosActuales = $em->getRepository('AppBundle:MenuRol')
						->findByMenRolMen($menu->getMenId());

		
        return $this->render('menu/show.html.twig', array(
            'menu' => $menu,
            'delete_form' => $deleteForm->createView(),
			'currentPermissions'=> $permisosActuales
        ));
    }

    /**
     * Displays a form to edit an existing menu entity.
     *
     */
    public function editAction(Request $request, Menu $menu)
    {
		$deleteForm = $this->createDeleteForm($menu);
        $editForm = $this->createForm('AdminBundle\Form\MenuType', $menu);
        $editForm->handleRequest($request);
		
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
			$em = $this->getDoctrine()->getManager();
			
			//Update field pai_fecha_mod
			$id = $editForm->getData()->getMenId();
			$item = $em->getRepository('AppBundle:Menu')->find($id);
			$item->setMenFechaMod(new \DateTime());
			//end
			
            $em->persist($menu);
            $flush = $em->flush($item);
			
			if ($flush == null)
			{
				$msgBox = "Registro actualizado con éxito";
				$status = "success";
			} else {
				$msgBox = "No se ha podido actualizar el registro ";
				$status = "error";
			}
			
			$this->session->getFlashBag()->add($status,$msgBox);
			
			$oPermisos = $editForm->get("permisos")->getData();
			//echo count($oPermisos);
			$this->checkPermissions($menu->getMenId(), $oPermisos);
			//exit();
            return $this->redirectToRoute('menu_edit', array('id' => $menu->getMenId()));
			
        }
		//echo $menu->getMenId();
		//$permisosActuales = $this->getDoctrine()->getManager()->getRepository('AppBundle:MenuRol')->findOneBy( array("menRolMen"=>$menu->getMenId(), "menRolActivo"=>1) );
		//$repo = $em->getRepository();
		$permisosActuales = $this->getDoctrine()->getManager()->createQuery(
							"SELECT z
							FROM AppBundle:MenuRol z
							WHERE z.menRolMen = :id and z.menRolActivo = 1"
						)
						->setParameter('id',$menu->getMenId())->getResult();
		//echo count($permisosActuales);
		
        return $this->render('menu/edit.html.twig', array(
            'menu' => $menu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
			'currentPermissions'=> $permisosActuales
        ));
    }

    /**
     * Deletes a menu entity.
     *
     */
    public function deleteAction(Request $request, Menu $menu)
    {
        $form = $this->createDeleteForm($menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($menu);			
			$flush = $em->flush();
			
			if ($flush == null)
			{
				$msgBox = "El registro fue eliminado con éxito";
				$status = "success";
			} else {
				$msgBox = "No se ha podido eliminar el registro ";
				$status = "error";
			}
        }

        return $this->redirectToRoute('menu_index');
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
				$repo = $em->getRepository("AppBundle:Menu");	
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
	

    /**
     * Creates a form to delete a menu entity.
     *
     * @param Menu $menu The menu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Menu $menu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('menu_delete', array('id' => $menu->getMenId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
	
	
	public function menuTreeAction()
	{
		$dinamicMenu = $this->get_main_parent();
		
        return $this->render('menu/tree.html.twig', array(
			'dinamicMenu' => $dinamicMenu
        ));
	}
	
	function checkPermissions($id,$oPermisos)
	{
		$em = $this->getDoctrine()->getManager();
		$pros = array();
		//echo $id;
		//Get all permission of this menu
		$current = $this->getDoctrine()->getManager()->getRepository('AppBundle:MenuRol')->findBy( array("menRolMen"=>$id ) );
		
		
		foreach ( $oPermisos as $p )
		{
			//echo $p->getMolId()."-";
			$men_per = $em->getRepository('AppBundle:MenuRol')->findOneBy( array("menRolMen"=>$id, "menRolRol"=>$p->getRolId() ) );
			//$men_per = $em->getRepository('AppBundle:MenuRol')->findOneByMenRolMenIdAndMenRolMrolId($id, $p->getMolId()  );
			//echo $men_per->getMenRolId();
			if( !$men_per )
			{
				
				$menu_repo = $em->getRepository("AppBundle:Menu")->find($id);
				//$permiso_repo = $em->getRepository("AppBundle:MenRol")->find($idPermiso);
				$permiso_repo = $p;
				$men_per = new \AppBundle\Entity\MenuRol();
				$men_per->setMenRolMen( $menu_repo ); //Id del menu creado
				$men_per->setMenRolRol( $permiso_repo ); //Id del permiso
				$men_per->setMenRolFechaCrea( new \Datetime()); //Fecha de creacion
				$men_per->setMenRolActivo( 1 ); // Active the item
			}
			else
			{
				$men_per = $this->getDoctrine()->getRepository('AppBundle:MenuRol')->find( $men_per->getMenRolId() );
				$men_per->setMenRolActivo( 1 ); //Id del permiso
			}
			
			$em->persist($men_per);
			$flush = $em->flush();
			//if ($flush != null)
			//{
				$pros[] = $p->getRolId();
				
			//}echo $p->getMolId()."- ";
		}

		
		$arr = array();
		foreach( $current as $c => $k)
		{
			$arr[] = $k->getMenRolRol()->getRolId(); //Get id Rol
		}
		$resultado = array_diff($arr, $pros);

		$q = $em->createQuery("UPDATE AppBundle:MenuRol m SET m.menRolActivo = 0 WHERE m.menRolRol IN (:ids) AND m.menRolMen = $id")
				->setParameter(':ids', $resultado, \Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
				$numUpdated = $q->execute();
				
	}
	
	function get_main_parent(){
		
		$em = $this->getDoctrine()->getManager();
		$app_repo = $em->createQuery(
				'SELECT m
				FROM AppBundle:Menu m
				WHERE m.menActivo = 1
				ORDER BY m.menOrden ASC'
			)->getResult();
		$nav = "";
		if( count($app_repo) > 0)
		{
			$nav .= "<ol class='sortable'>";
			foreach ($app_repo as $menu)
			{
				if( $menu->getMenPadre() == ""){
					$nav .= "<li id='list_".$menu->getMenId()."' ><div>".$menu->getMenNombre()."</div>";
					$nav .= $this->get_children($menu->getMenId());
					$nav .= "</li>";
				}
			}
			$nav .= "</ol>";
		}
		return $nav;
	}
	
	function get_children($parentId=0)
	{
		$em = $this->getDoctrine()->getManager();
		$children = $em->createQuery(
						'SELECT m
							FROM AppBundle:Menu m
							WHERE m.menPadre =:filter
							AND m.menActivo = 1
							ORDER BY m.menOrden ASC'
				)
				->setParameter('filter', $parentId)
				->getResult();
		$list = "";
		if( count($children) > 0)
		{
			$list .= "<ol>";
			foreach ($children as $child)
			{
				$id = $child->getMenId();
				if( $child->getMenPadre() != "" )
				{
					$list .=  "<li id='list_".$child->getMenId()."'><div>" . $child->getMenNombre()."</div>";
							if( $child->getMenPadre() != "")
							{
								$list .= $this->get_children($id);
							}
					$list .=  "</li>";
				}
			}
			$list .= "</ol>";
			return $list;
		}
	}
	
	public function menuOrderAction( Request $request )
	{
		//$parameter = $_POST['list'];
		$parameter = $request->get('list');
		//echo gettype($parameter);
		//for($i=0; $i < count($parameter); $i++)
		if( count($parameter) > 0)
		{
			$em = $this->getDoctrine()->getManager();
			$aArrMenu = array();
			foreach ($parameter as $id => $parentId)
			{
				//echo $id."-".$parentId."<br>";
				$parentId = ( $parentId > 0 )?$parentId:0; //0 = NULL
				$aArrMenu[ $parentId ][] = $id;

			}
			
			foreach ($aArrMenu as $parentId => $ids)
			{

				$parentId = ( $parentId > 0 )?$parentId:NULL;
				for($i = 0; $i < count($ids); $i++)
				{
					$id = $ids[$i];
					$orden = $i+1;
					$menu = $em->createQuery( 'UPDATE  AppBundle:Menu m SET m.menPadre =:parent, m.menOrden =:orden, m.menFechaMod=:mod WHERE m.menId =:id ')
							->setParameter('parent', $parentId)
							->setParameter('id', $id)
							->setParameter('mod', date("Y-m-d H:i:s"))
							->setParameter('orden', $orden)
							->getResult();
					
				}
			}
			/*
			$this->session->getFlashBag()->add("status",$status);
			return $this->redirectToRoute("menu_tree");
			*/
		}
		exit();
	}
}
