<?php

namespace Services;

use \AppBundle\Entity\Menu;

class DinamicMenu {
	
	/* @var $em \Doctrine\ORM\EntityManager */
	/*
    private $em;

    function __construct($em) {
        $this->em = $em;
    }
	
	public function showMenu(){
		return  $dinamicMenu = $this->get_main_parent();
	}
	
	function get_main_parent(){
		
		$app_repo = $this->em->createQuery(
				'SELECT m
				FROM AppBundle:Menu m
				WHERE m.menActivo = 1
				ORDER BY m.menOrden ASC'
			)->getResult();
		$nav = "";
		if( count($app_repo) > 0)
		{
			$nav .= "<ul class='sortablex nav navbar-nav'>";
			foreach ($app_repo as $menu)
			{
				if( $menu->getMenPadre() == ""){
					
					$hasChildren = $this->countChildren($menu->getMenId()) ;
					$dropdown = ( $hasChildren == 1 )?"dropdown":false;
					
					$nav .= "<li id='list_".$menu->getMenId()."' class='".$dropdown."'>";
					if( $dropdown )
					{
						$nav .= "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>";
						$nav .= "<i class='".$menu->getMenIcono()."'></i> ".$menu->getMenNombre()."<span class='caret'></span>";
						$nav .= "</a>";
						$nav .= $this->get_children($menu->getMenId(), true);
					}
					else
					{
						$nav .= "<a href=''>".$menu->getMenNombre()."</a>";
						$nav .= $this->get_children($menu->getMenId());
					}
					//$nav .= $this->get_children($menu->getMenId());
					$nav .= "</li>";
				}
			}
			$nav .= "</ul>";
		}
		return $nav;
		
		//$this->get_children($parentId=null);
	}
	
	function get_children($parentId=0, $hasDropdown=false)
	{

		$children = $this->em->createQuery(
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
					
					$list .=  "<li class='".$dropdown."'><a href=''><i class='".$child->getMenIcono()."'></i>" . $child->getMenNombre()."</a>";
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
		$app_repo = $this->em->createQuery(
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
	*/
}
