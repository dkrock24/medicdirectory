<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class wsLoginController extends Controller
{
    public function wsLoginAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $criteria = [];
        $criteria['usuUsuario'] = $request->request->get('usuario'); // POST
        $criteria['usuClave'] = $request->request->get('clave'); // POST
        $usuario = $em->getRepository("AppBundle:Usuario")->findOneBy($criteria);

        $json = [];
        $json['resultado'] = "0";
        
        if ($usuario instanceof Usuario) {
            $json['resultado'] = "1";
            $json['usuario'] = $usuario->getUsuNombre();
            $json['nombre1'] = $usuario->getUsuNombre();
            $json['nombre2'] = $usuario->getUsuSegundoNombre();
            $json['nombre3'] = $usuario->getUsuTercerNombre();
            $json['apellido1'] = $usuario->getUsuPrimerApellido();
            $json['apellido2'] = $usuario->getUsuSegundoApellido();
        }

        return new JsonResponse($json);
    }
}
