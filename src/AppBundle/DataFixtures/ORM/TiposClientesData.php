<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rol;
use AppBundle\Entity\TipoCliente;

class TiposClientesData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* php app/console doctrine:fixtures:load */

        /* Tipos de clientes */

        $aTiposCliente = ['CLINICA', 'HOSPITAL', 'FARMACIA', 'VISITADOR', 'LABORATORIO'];

        foreach ($aTiposCliente as $tipoCliente) {
            $oTipoCliente = new TipoCliente();
            $oTipoCliente->setTipCliActivo(TRUE);
            $oTipoCliente->setTipCliFechaCrea(new \DateTime());
            $oTipoCliente->setTipCliFechaMod(new \DateTime());
            $oTipoCliente->setTipCliTipo($tipoCliente);
            $manager->persist($oTipoCliente);
            $manager->flush();
        }  
    }
}