<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EmrBundle\Services;

use Symfony\Component\Form\Extension\Core\Type as Type;

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
        'birthday' => Type\BirthdayType::class,
        'checkbox' => Type\CheckboxType::class,
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
            gr.sec_gr_grupo as grupo,
            camp.mod_camp_nombre_corto AS campo_corto,
            tc.tip_camp_tipo as tipo_campo,
            camp.mod_camp_show_ifnull AS show_ifnull,
            camp.mod_camp_valor_default AS valor_default,
            camp.mod_camp_requerido AS requerido,
            camp.mod_camp_campo_padre AS campo_padre
        FROM
            eav_mod_seccion sec
        inner join eav_mod_sec_grupo gr on sec.mod_secc_id = gr.sec_gr_secc_id and gr.sec_gr_activo = 1
        inner join eav_mod_campos camp on gr.sec_gr_id = camp.mod_camp_sec_gr_id and camp.mod_camp_activo = 1
        inner join eav_tip_campos tc on camp.mod_camp_tip_camp_id = tc.tip_camp_id and tc.tip_camp_activo = 1
            where
            sec.mod_secc_mod_id = :mod_id
        ORDER BY sec.mod_secc_orden , gr.sec_gr_orden, camp.mod_camp_campo_padre , camp.mod_camp_orden
        ";
        
        $oStatement = $this->em->getConnection()->prepare($sQuery);
        $oStatement->bindValue('mod_id', $module);
        $oStatement->execute();
        
        $oResult = $oStatement->fetchAll();
        
        $aModProps = array();
        
        foreach( $oResult as $campo ){
            $aModProps[ $campo["seccion"] ] [ $campo["grupo"] ] [] = array(
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
    
    
    
    public function buildModuleForm( $mod_hash, 
            $usu_id,
            $pac_id,
            $cli_id,
            $cit_id,
            $mod_props ){
        
        $mod = $this->em->getRepository("AppBundle:Modulo")
        ->findOneBy( array('modHashCode' => $mod_hash) );

        $module = $mod->getModId();
        
        /* ***** QUERY FOR USER PROPS AND VALUES ******/
        $sUsrProVal = "
            select 
                c.mod_camp_id as id_campo,
                v.mod_dat_id as id_valor,
                cv.mod_cat_val_id as id_valor_catalogo,
                c.mod_camp_es_catalogo,
                case
                    when c.mod_camp_es_catalogo = 1 then cv.mod_cat_val_valor
                    when c.mod_camp_es_catalogo = 0 then v.mod_dat_dato_valor
                end as value
                ,cvt._ids_vals_array
            from 
            eav_mod_campos c 
            left join eav_mod_sec_grupo gr on gr.sec_gr_id = c.mod_camp_sec_gr_id
            left join eav_mod_datos v on 
                    v.mod_dat_usu_id = :usu_id and
                    v.mod_dat_pac_id = :pac_id and
                    v.mod_dat_cli_id = :cli_id and
                    
                    CIT_PLACE_HOLDER
                    
                    v.mod_dat_activo = 1 and 
                    v.mod_dat_mod_camp_id = c.mod_camp_id	
                    and
                    c.mod_camp_activo = 1 and 
                    gr.sec_gr_secc_id
                    in  (select mod_secc_id from eav_mod_seccion where mod_secc_mod_id = :mod_id and mod_secc_activo = 1)

            left join eav_mod_cat_valores cv on 
                    v.mod_dat_dato_valor = cv.mod_cat_val_id
            left join (
                    select 
                        mod_cat_val_camp_id,
                        group_concat( concat(mod_cat_val_id,':', mod_cat_val_valor) separator ', ' )
                        as _ids_vals_array
                    FROM
                    eav_mod_cat_valores
                    group by mod_cat_val_camp_id
            ) cvt on cvt.mod_cat_val_camp_id = c.mod_camp_id
        ";
        
        if( !is_null( $cit_id ) ){
            $sUsrProVal = str_replace('CIT_PLACE_HOLDER', 'v.mod_dat_cit_id = :cit_id and', $sUsrProVal);
            $oStatement = $this->em->getConnection()->prepare($sUsrProVal);
            $oStatement->bindValue('cit_id', $cit_id);
        }else{
            $sUsrProVal = str_replace('CIT_PLACE_HOLDER', '', $sUsrProVal);
            $oStatement = $this->em->getConnection()->prepare($sUsrProVal);
        }
        
        $oStatement->bindValue('usu_id', $usu_id);
        $oStatement->bindValue('pac_id', $pac_id);
        $oStatement->bindValue('cli_id', $cli_id);
        $oStatement->bindValue('mod_id', $module);
        $oStatement->execute();
        
        $oResult = $oStatement->fetchAll();
        
        
        $aFormCampData = array();
        
        
        
        foreach( $oResult as $campData ){
            
            $aCatValuesTemp = ( !is_null( $campData['_ids_vals_array'] ) ) ? explode(',', $campData['_ids_vals_array']) : null;
            $aCatVlues = null;
            
            if( !is_null( $aCatValuesTemp ) ){
                foreach( $aCatValuesTemp as $value ){
                    $aValues = explode(":", $value);
                    $aCatVlues[ trim( $aValues[1] ) ] = trim( $aValues[0] );
                    
                }
            }
            
            $aFormCampData[$campData['id_campo']] = array(
                'id_valor' => $campData['id_valor'],
                'id_valor_catalogo' => $campData['id_valor_catalogo'],
                'valor' => $campData['value'],
                'val_catalogo' => $aCatVlues,
            );
            
        }
        
        $aModSecc = array();
        
//        echo '<pre>';
//        var_dump( $mod_props );
//        die;
        
        foreach( $mod_props as $kseccion => $kgrupo ){ //$vcampo ){
            
//            $oModuloForm = $this->form_factory->createBuilder()
//                ->setAction( '' )
//                ->setMethod( 'POST' ) 
//            ;
            
            

            $bRequired = false;
            
            foreach( $kgrupo as $keygrupo => $vcampo ){
                
                $oModuloForm = $this->form_factory->createBuilder()
                    ->setAction( '' )
                    ->setMethod( 'POST' ) 
                ;
                
                foreach( $vcampo as $key => $vcamp_props ){
//                    echo '<pre>';
//                    var_dump( $vcamp_props );
//                    echo '<br>';
//                    var_dump( $aFormCampData );
//                    exit;
                    if( $vcamp_props["requerido"] == 1 ){
                        $bRequired = true;
                    }else{
                        $bRequired = false;
                    }

                    if( $vcamp_props['tipo_campo'] == 'choice' ){

                        $oModuloForm->add( $vcamp_props["camp_id"],
                            self::$aDataTypesMap[ $vcamp_props["tipo_campo"] ],
                            array(
                                "label" => $vcamp_props["campo"],
                                "data" => $aFormCampData[ $vcamp_props["camp_id"] ]["id_valor_catalogo"],
                                "choices" => $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"]
                            ) 
                        );

                    }else if( ($vcamp_props['tipo_campo'] == "checkbox" || $vcamp_props['tipo_campo'] == "radio") && !is_null( $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"] ) ){
                        // This is when we're handling a group of checkboxes or radio buttons.

                        // this holds the catalog value
                        $radioCatValue =  $aFormCampData[ $vcamp_props["camp_id"] ]["valor"];
                        // this holds the id from the catalog value
//                        var_dump($vcamp_props["camp_id"]);
//                        var_dump($radioCatValue);
//                        exit;
                        $radioValue = $radioCatValue != null ? $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"][$radioCatValue] : null;

                        $oModuloForm->add( $vcamp_props["camp_id"],
                                Type\ChoiceType::class,
                                array(
                                    "label" => $vcamp_props["campo"],
                                    "choices" => $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"],
                                    "data" => $radioValue,//$checkValue,
                                    "expanded" => true,
                                    "attr" => array(
                                        "input-group" => true
                                    )
                                )
                            );

                    }else if( ($vcamp_props['tipo_campo'] == "checkbox" || $vcamp_props['tipo_campo'] == "radio") && is_null( $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"] ) ){
                        // This is when the input is a single radio button or checkbox

                        $checkValue = (boolean) $aFormCampData[ $vcamp_props["camp_id"] ]["valor"];

                        $oModuloForm->add( $vcamp_props["camp_id"],
                                self::$aDataTypesMap[ $vcamp_props["tipo_campo"] ],
                                array(
                                    "label" => $vcamp_props["campo"],
                                    //"value" => $checkValue
                                    "data" => $checkValue
                                )
                            );

                    }else if( $vcamp_props['tipo_campo'] == "date" || $vcamp_props['tipo_campo'] == "datetime" ){
                        
                        $oModuloForm->add( $vcamp_props["camp_id"],
                            Type\TextType::class,
                            array(
                                "label" => $vcamp_props["campo"],
                                "data" => $aFormCampData[ $vcamp_props["camp_id"] ]["valor"],
                                'attr' => array(
                                    'data-value' => $aFormCampData[ $vcamp_props["camp_id"] ]["valor"]
                                    ,'class' => 'date-field'
                                )
                            ) 
                        );
                        
                    }else{

                        $oModuloForm->add( $vcamp_props["camp_id"],
                            self::$aDataTypesMap[ $vcamp_props["tipo_campo"] ],
                            array(
                                "label" => $vcamp_props["campo"],
                                "data" => $aFormCampData[ $vcamp_props["camp_id"] ]["valor"],
                                'attr' => array(
                                    'data-value' => $aFormCampData[ $vcamp_props["camp_id"] ]["valor"]
                                )
                            ) 
                        );

                    }
                }
                
                $oModFormView = $oModuloForm->getForm()->createView();
            
                $aModSecc[$kseccion][$keygrupo] = $oModFormView;
                
            }
            
            
            /*
            foreach( $vcampo as $key => $vcamp_props ){

                if( $vcamp_props["requerido"] == 1 ){
                    $bRequired = true;
                }else{
                    $bRequired = false;
                }
                
                if( $vcamp_props['tipo_campo'] == 'choice' ){
                    
                    $oModuloForm->add( $vcamp_props["camp_id"],
                        self::$aDataTypesMap[ $vcamp_props["tipo_campo"] ],
                        array(
                            "label" => $vcamp_props["campo"],
                            "data" => $aFormCampData[ $vcamp_props["camp_id"] ]["id_valor_catalogo"],
                            "choices" => $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"]
                        ) 
                    );
                    
                }else if( ($vcamp_props['tipo_campo'] == "checkbox" || $vcamp_props['tipo_campo'] == "radio") && !is_null( $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"] ) ){
                    // This is when we're handling a group of checkboxes or radio buttons.
                    
                    // this holds the catalog value
                    $radioCatValue =  $aFormCampData[ $vcamp_props["camp_id"] ]["valor"];
                    // this holds the id from the catalog value
                    $radioValue = $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"][$radioCatValue];
                    
                    $oModuloForm->add( $vcamp_props["camp_id"],
                            Type\ChoiceType::class,
                            array(
                                "label" => $vcamp_props["campo"],
                                "choices" => $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"],
                                "data" => $radioValue,//$checkValue,
                                "expanded" => true,
                                "attr" => array(
                                    "input-group" => true
                                )
                            )
                        );
                    
                }else if( ($vcamp_props['tipo_campo'] == "checkbox" || $vcamp_props['tipo_campo'] == "radio") && is_null( $aFormCampData[ $vcamp_props["camp_id"] ]["val_catalogo"] ) ){
                    // This is when the input is a single radio button or checkbox
                    
                    $checkValue = (boolean) $aFormCampData[ $vcamp_props["camp_id"] ]["valor"];

                    $oModuloForm->add( $vcamp_props["camp_id"],
                            self::$aDataTypesMap[ $vcamp_props["tipo_campo"] ],
                            array(
                                "label" => $vcamp_props["campo"],
                                //"value" => $checkValue
                                "data" => $checkValue
                            )
                        );
                    
                }else{
                    
                    $oModuloForm->add( $vcamp_props["camp_id"],
                        self::$aDataTypesMap[ $vcamp_props["tipo_campo"] ],
                        array(
                            "label" => $vcamp_props["campo"],
                            "data" => $aFormCampData[ $vcamp_props["camp_id"] ]["valor"],
                            'attr' => array(
                                'data-value' => $aFormCampData[ $vcamp_props["camp_id"] ]["valor"]
                            )
                        ) 
                    );
                    
                }
            }
            */
            /*
            $oModFormView = $oModuloForm->getForm()->createView();
            
            $aModSecc[$kseccion] = $oModFormView;
            */
        }
        
//        \Doctrine\Common\Util\Debug::dump( $aModSecc );
//        exit;
        
        
        return $aModSecc;
        
    }
    
    
}
