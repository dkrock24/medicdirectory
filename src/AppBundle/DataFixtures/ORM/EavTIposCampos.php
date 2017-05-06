<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\EavTipCampos;
/**
 * Description of EavTIposCampos
 *
 * @author slacker
 */
class EavTIposCampos implements FixtureInterface {
    

    public function load(ObjectManager $manager) {
        
        $aTipoCampos = array(
            "text",
            "textarea",
            "email",
            "hidden",
            "integer",
            "money",
            "number",
            "password",
            "percent",
            "url",
            "choice",
            "entity",
            "country",
            "language",
            "locale",
            "timezone",
            "currency",
            "date",
            "datetime",
            "time",
            "birthday",
            "checkbox",
            "radio",
            "file"
        );
        
        foreach( $aTipoCampos as $tipo_campo ){
            $eav_tip_campo = new EavTipCampos();
            $eav_tip_campo->setTipCampTipo($tipo_campo);
            $eav_tip_campo->setTipCampFechaCrea( new \DateTime() );
            $manager->persist( $eav_tip_campo );
            $manager->flush();
        }
        
    }

}
