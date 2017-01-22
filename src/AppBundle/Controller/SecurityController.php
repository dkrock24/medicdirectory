<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of SecurityController
 *
 * @author vladimir
 */
class SecurityController extends Controller {

    public function loginAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
		/*
		$user = new \AppBundle\Entity\SysUsuario();
		$form = $this->createForm(\AppBundle\Form\SysUsuarioType::class, $user);
		$factory = $this->get("security.encoder_factory");
				$encoder = $factory->getEncoder($user);
			echo	$password = $encoder->encodePassword( $form->get("password")->getData(), "" );
		*/
        return $this->render('AppBundle:Session:login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => $error,
        ));
    }

}
