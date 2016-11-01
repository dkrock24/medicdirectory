<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpKernel\Exception\HttpNotFoundException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }
	
	public function generateMedicosAction(Request $request, $number)
    {
		//echo $number;
		if($number > 0)
		{
			for($i=0; $i < $number; $i++){
				//echo $i."-";
				
				$em = $this->getDoctrine()->getManager();
				
				$user = new \AppBundle\Entity\SysUsuario();
				$user->setNombreSysUsuario( $this->generateRandomString($length = 20) );
				$user->setApellidoSysUsuario( $this->generateRandomString($length = 15) );
				$user->setEmailSysUsuario( $this->generateRandomString($length = 15) );
				$user->setEsActivoSysUsuario(1);
				$user->setTelefonoSysUsuariocol( $this->generateNumero() );
				$user->setCelularSysUsuario( $this->generateNumero() );
				$user->setJvrmSysUsuario( $this->generateNumero(5) );
				$user->setTarjetaCreditoSysUsuario( $this->generateNumero(10) );
				$user->setSysUsuario( $this->generateUser() );
				$user->setCodigoPostalSysUsuario("1101");
				$user->setDuiSysUsuario( $this->generateNumero(8) );
				$user->setPasswordSysUsuario( $this->generateUser(3) );
				$user->setNumeroAfp( $this->generateNumero(6) );
				$user->setNumeroNup( $this->generateNumero(6) );
				$user->setDireccion( trim($this->generateRandomString($length = 40)) );
				$user->setGenero( $this->generatGenero() );
				$fecha = new \DateTime("now");
				$user->setFechaCreacionSysUsuario( $fecha );
				$em->persist($user);
				$flush = $em->flush();
				
				if( $flush == null )
				{
					$status = "Registros creados con éxito ";
				}
				else{
					$status = "No se pudo crear el registro ";
				}
				
				
				//echo $this->generateRandomString($length = 20);
			}
			echo $status."<br>";
			
		}
		
        return $this->render('AdminBundle:Default:generateMedicos.html.twig');
    }
	
	//Método con rand()
	function generateRandomString($num = 10) {
		$caracteres = $this->string(); 
		$cadena = substr(str_shuffle($caracteres), 0, $num); 
		return $cadena; 
	}
	
	function generateUser($num = 8) {
		$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
		$cadena = substr(str_shuffle($caracteres), 0, $num); 
		return $cadena; 
	}
	
	function generateNumero($num = 8) {
		$caracteres = "1234567890"; //posibles caracteres a usar
		$cadena = substr(str_shuffle($caracteres), 0, $num); 
		return $cadena; 
	}
	
	function generatGenero() {
		$caracteres = "MF"; //posibles caracteres a usar
		$cadena = substr(str_shuffle($caracteres), 0, 1); 
		return $cadena; 
	}
	
	function string(){
		return $cadena = "
						Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.
						Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my ass, 'cause I'll kill the motherfucker, know what I'm sayin'?
						Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.
						Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.
						Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you. But I can't give you this case, it don't belong to me. Besides, I've already been through too much shit this morning over this case to hand it over to your dumb ass.
						Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.
						Look, just because I don't be givin' no man a foot massage don't make it right for Marsellus to throw Antwone into a glass motherfuckin' house, fuckin' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my ass, 'cause I'll kill the motherfucker, know what I'm sayin'?
						Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.
						Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you. But I can't give you this case, it don't belong to me. Besides, I've already been through too much shit this morning over this case to hand it over to your dumb ass.";
	}
}
