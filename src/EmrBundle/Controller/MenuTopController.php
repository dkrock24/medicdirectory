<?php

namespace EmrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MenuTopController extends Controller
{
	
	public function listShowAction( Request $request )
    {
		
		$em = $this->getDoctrine()->getManager();
		
		
		$oMenu = $em->createQuery( " SELECT mr FROM AppBundle:Menu m  WHERE  m.menActivo = 1")
								->getResult();
		
		
		foreach ($oMenu as $value)
		{
			//echo $value->get
		}
		
		/*
		$permisosActuales = $em->getRepository('AppBundle:MenuRol')
								->findByMenRolMen($menu->getMenId());
						
		*/
		/*
        return $this->render('menu/show.html.twig', array(
            'menu' => $menu,
            'delete_form' => $deleteForm->createView(),
			'currentPermissions'=> $permisosActuales
        ));
		
		*/
		
        //return $this->render('EmrBundle:Session:login.html.twig', array());
		
		exit("sali");
    }
}
