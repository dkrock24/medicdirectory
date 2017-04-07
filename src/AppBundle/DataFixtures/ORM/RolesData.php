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
        /* php app/console doctrine:fixtures:load */

        /* Roles */

        $aRoles = ['ADMIN', 'CLIENTE', 'ASISTENTE', 'USUARIO'];

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