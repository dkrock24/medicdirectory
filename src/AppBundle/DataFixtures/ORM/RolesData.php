<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rol;
use AppBundle\Entity\TipoCliente;

class RolesData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* php bin/console doctrine:fixtures:load */

        /* Roles */

        /*
         * ADMIN = nosotros
         * CLIENTE = Rol para el usuario representante, facturacion, etc.
         * USUARIO = Visitante
         * VENDEDOR = Rol especial que permite usar el sistema completamente para demos
         * DOCTOR, FARMACIA, VISITADOR, HOSPITAL, LABORATORIO y SEGURO = auto explicados
         */
        $aRoles = ['ADMIN', 'CLIENTE', 'ASISTENTE', 'USUARIO', 'VENDEDOR', 'DOCTOR', 'FARMACIA', 'VISITADOR', 'HOSPITAL', 'LABORATORIO', 'SEGURO'];

        foreach ($aRoles as $rol) {
            // Objeto para insertar todos los roles
            $oRol = new Rol();
            $oRol->setRolFechaCrea(new \DateTime());
            $oRol->setRolFechaMod(new \DateTime());
            $oRol->setRolActivo(true);
            $oRol->setRolRol($rol);
            $manager->persist($oRol);
            $manager->flush();
        }
    }
}