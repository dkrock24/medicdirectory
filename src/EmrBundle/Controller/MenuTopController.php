<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MenuTopController extends Controller
{
	
	public $createRoute = "";
	
	public function listShowAction( Request $request ,$menu)
    {
		
		$dinamicMenu = $this->get_main_parent($menu); 
		//$this->get('srv_DinamicMenu');
		//$menu = $dinamicMenu->showMenu();
		
        return $this->render('EmrBundle:paciente:renderMenu.html.twig', array( "menu"=>$dinamicMenu));

    }
	
	
	
	function get_main_parent($menu){
		
		//get absolute path of this route
		$this->createRoute = $this->generateUrl('emr_controller_url_menu_top', array('route'=>"{}"), UrlGeneratorInterface::ABSOLUTE_URL);
		
		$em = $this->getDoctrine()->getManager();
		$app_repo = $em->createQuery(
				'SELECT m
				FROM AppBundle:Menu m
				WHERE m.menActivo = 1  and m.menBackend=:menu ORDER BY m.menOrden ASC')
				->setParameter('menu', $menu)
				->getResult();
		$nav = "";
		if( count($app_repo) > 0)
		{
			$nav .= "<ul class='sortablex nav navbar-nav'>";
			foreach ($app_repo as $menu)
			{
				if( $menu->getMenPadre() == ""){
					
					$hasChildren = $this->countChildren($menu->getMenId()) ;
					$dropdown = ( $hasChildren == 1 )?"dropdown":false;
					
					$square_bracket = array("{}");
					$route =  str_replace($square_bracket, $menu->getMenEnlace(), urldecode($this->createRoute));
					
					$nav .= "<li id='list_".$menu->getMenId()."' class='".$dropdown."'>";
					if( $dropdown )
					{
						$nav .= "<a href='".$route."' class='dropdown-toggle' data-toggle='dropdown'>";
						$nav .= "<i class='".$menu->getMenIcono()."'></i> ".$menu->getMenNombre()."<span class='caret'></span>";
						$nav .= "</a>";
						$nav .= $this->get_children($menu->getMenId(), true);
					}
					else
					{
						$nav .= "<a href='".$route."'><i class='".$menu->getMenIcono()."'></i> ".$menu->getMenNombre()."</a>";
						$nav .= $this->get_children($menu->getMenId());
					}
					$nav .= "</li>";
				}
			}
			$nav .= "</ul>";
		}
		return $nav;
	}
	
	function get_children($parentId=0, $hasDropdown=false)
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
			$hasDropdown = ( $hasDropdown == true)?"dropdown-menu":"";
			$list .= "<ul class='".$hasDropdown."'>";
			foreach ($children as $child)
			{
				$id = $child->getMenId();
				if( $child->getMenPadre() != "" )
				{
					$hasChildren = $this->countChildren($child->getMenId()) ;
					$dropdown = ( $hasChildren == 1 )?"dropdown-submenu":false;
					
					$square_bracket = array("{}");
					$route =  str_replace($square_bracket, $child->getMenEnlace(), urldecode($this->createRoute));
					
					$list .=  "<li class='".$dropdown."'><a href='".$route."'><i class='".$child->getMenIcono()."'></i>" . $child->getMenNombre()."</a>";
							if( $child->getMenPadre() != "")
							{
								$list .= $this->get_children($id, $dropdown);
							}
					$list .=  "</li>";
				}
			}
			$list .= "</ul>";
			return $list;
		}
	}
	
	
	function countChildren($id)
	{
		$em = $this->getDoctrine()->getManager();
		$app_repo = $em->createQuery(
				"SELECT m
				FROM AppBundle:Menu m
				WHERE m.menActivo = 1 and m.menPadre = $id
				ORDER BY m.menOrden ASC"
			)->getResult();
		
		if( count($app_repo) > 0 )
		{
			return 1;
		}
		return 0;
	}
}
