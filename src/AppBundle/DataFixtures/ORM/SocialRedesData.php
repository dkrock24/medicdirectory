<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\SocialRedes;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rol;
use AppBundle\Entity\UsuarioGaleriaTipo;

class SocialRedesData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* php bin/console doctrine:fixtures:load */

        /* Tipos de tipos de galeria */

        $aTipos = ['Sitio web', 'Facebook.com', 'Twitter.com', 'YouTube.com', 'Instagram.com'];

        foreach ($aTipos as $sTipo) {
            $oSocialRedes = new SocialRedes();
            $oSocialRedes->setSocPatron('');
            $oSocialRedes->getSocRedNombre($sTipo);
            $oSocialRedes->setSocRedActivo(true);
            $manager->persist($oSocialRedes);
            $manager->flush();
        }  
    }
}