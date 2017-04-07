<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Rol;
use \AppBundle\Entity\MetodoPago;

class MetodosPagoData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* php app/console doctrine:fixtures:load */

        /* Metodos de pago */

        $aMetodosPago = ['EFECTIVO', 'TCREDITO', 'CHEQUE', 'DBANCO', 'PAYPAL'];

        foreach ($aMetodosPago as $metodoPago) {
            $oMetodoPago = new MetodoPago();
            $oMetodoPago->setMepActivo(TRUE);
            $oMetodoPago->setMepFechaCrea(new \DateTime());
            $oMetodoPago->setMepFechaMod(new \DateTime());
            $oMetodoPago->setMepMetodoPago($metodoPago);
            $manager->persist($oMetodoPago);
            $manager->flush();
        }  
    }
}