<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\SysRoles;

class LoadRolesData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $aRoles = ['ADMIN', 'CLIENTE', 'ASISTENTE', 'USUARIO'];

        foreach ($aRoles as $rol) {
            // Objeto para insertar todos los roles
            $oRol = new SysRoles();
            $oRol->setFechaCreacionSysRoles(new \DateTime());
            $oRol->setEstatusSysRoles(true);
            $oRol->setNombreRolSysRoles($rol);
            $manager->persist($oRol);
            $manager->flush();
        }
        
    }
}