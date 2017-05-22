<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmrBundle\Services;

use \Symfony\Component\Form\Extension\Core\Type as Type;

/**
 * Description of servicioEav
 *
 * @author slacker
 */
class servicioEav {

    private static $aDataTypesMap = array(
        'text' => Type\TextType::class,
        'textarea' => Type\TextareaType::class,
        'email' => Type\EmailType::class,
        'hidden' => Type\HiddenType::class,
        'integer' => Type\IntegerType::class,
        'money' => Type\MoneyType::class,
        'number' => Type\NumberType::class,
        'password' => Type\PasswordType::class,
        'percent' => Type\PercentType::class,
        'url' => Type\UrlType::class,
        'choice' => Type\ChoiceType::class,
        'entity' => Type\EntityType::class,
        'country' => Type\CountryType::class,
        'language' => Type\LanguageType::class,
        'locale' => Type\LocaleType::class,
        'timezone' => Type\TimezoneType::class,
        'currency' => Type\CurrencyType::class,
        'date' => Type\DateType::class,
        'datetime' => Type\DateTimeType::class,
        'time' => Type\TimeType::class,
        'birthday' => Type\Birthday::class,
        'checkbox' => Type\Checkbox::class,
        'radio' => Type\RadioType::class,
        'file' => Type\FileType::class,
    );
    
    private $em;
    private $form_factory;
    
    function __construct( $em, $form_factory ) {
        $this->em = $em;
        $this->form_factory = $form_factory;
    }

    
    public function getPropModulo( $mod_hash ){
        
        $mod = $this->em->getRepository("AppBundle:Modulo")
                ->findOneBy( array('modHashCode' => $mod_hash) );
        
        $module = $mod->getModId();
        
        $sQuery = "SELECT 
            sec.mod_secc_seccion AS seccion,
            camp.mod_camp_id as camp_id,
            camp.mod_camp_nombre AS campo,
            camp.mod_camp_nombre_corto AS campo_corto,
            tc.tip_camp_tipo as tipo_campo,
            camp.mod_camp_show_ifnull AS show_ifnull,
            camp.mod_camp_valor_default AS valor_default,
            camp.mod_camp_requerido AS requerido,
            camp.mod_camp_campo_padre AS campo_padre
        FROM
            eav_mod_seccion sec
        inner join eav_mod_campos camp on sec.mod_secc_id = camp.mod_camp_mod_secc_id and camp.mod_camp_activo = 1
        inner join eav_tip_campos tc on camp.mod_camp_tip_camp_id = tc.tip_camp_id and tc.tip_camp_activo = 1
            where
            sec.mod_secc_mod_id = :mod_id
        ORDER BY sec.mod_secc_orden , camp.mod_camp_campo_padre , camp.mod_camp_orden
        ";
        
        $oStatement = $this->em->getConnection()->prepare($sQuery);
        $oStatement->bindValue('mod_id', $module);
        $oStatement->execute();
        
        $oResult = $oStatement->fetchAll();
        
        $aModProps = array();
        
        foreach( $oResult as $campo ){
            $aModProps[$campo["seccion"]][] = array(
                "campo" => $campo["campo"],
                "camp_id" => $campo["camp_id"],
                "campo_corto" => $campo["campo_corto"],
                "tipo_campo" => $campo["tipo_campo"],
                "show_ifnull" => $campo["show_ifnull"],
                "valor_default" => $campo["valor_default"],
                "requerido" => $campo["requerido"],
                "campo_padre" => $campo["campo_padre"]
            );
        }
        
        return $aModProps;
    }
    
    public function getUserModData( $user_id )
    {
        
    }
    
    
    public function buildModuleForm( $mod_props ){
        
        
        $aModSecc = array();
        
        foreach( $mod_props as $kseccion => $vcampo ){
            
            $oModuloForm = $this->form_factory->createBuilder()//$this->createFormBuilder()
                ->setAction( '' )
                ->setMethod( 'POST' ) 
            ;
            
            foreach( $vcampo as $key => $vcamp_props ){
                
                $oModuloForm->add( $vcamp_props["camp_id"],
                //Type\TextareaType::class,
                    self::$aDataTypesMap[ $vcamp_props["tipo_campo"] ],
                    array(
                        "label" => $vcamp_props["campo"],
                        //"disabled" => $vcampo["proReadOnly"],
                        "data" => null
                        //,"choices" => null
                    ) 
                );
            }
            
            $oModFormView = $oModuloForm->getForm()->createView();
            
            $aModSecc[$kseccion] = $oModFormView;
           
        }
        
        //return $oModFormView;
        return $aModSecc;
        
        
    }
    
    
}
