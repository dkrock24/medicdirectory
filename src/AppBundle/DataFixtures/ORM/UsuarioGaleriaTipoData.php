<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rol;
use AppBundle\Entity\UsuarioGaleriaTipo;

class UsuarioGaleriaTipoData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* php bin/console doctrine:fixtures:load */

        /* Tipos de tipos de galeria */

        $aUsuarioGaleriaTipos = ['PERFIL', 'GALERIA', 'PUBLICITARIA', 'INFORMACION'];

        foreach ($aUsuarioGaleriaTipos as $aUsuarioGaleriaTipo) {
            $oUsuarioGaleriaTipo = new UsuarioGaleriaTipo ();
            $oUsuarioGaleriaTipo->setUsuGalTipActivo(TRUE);
            $oUsuarioGaleriaTipo->setUsuGalTipNombre($aUsuarioGaleriaTipo);
            $manager->persist($oUsuarioGaleriaTipo);
            $manager->flush();
        }  
    }
}