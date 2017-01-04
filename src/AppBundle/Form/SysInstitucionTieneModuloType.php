<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SysInstitucionTieneModuloType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('fechaInicioSysUtm', DateType::class, array("required"=>false,"label"=>"fechaInicio", 'attr'   =>  array('class'   => '')))
            ->add('fechaFinSysUtm', DateType::class, array("required"=>false,"label"=>"fechaFin", 'attr'   =>  array('class'   => '')))
            ->add('totalCostoEspecialSysUtm',TextType::class, array("required"=>true,"label"=>"Prefijo", 'attr'   =>  array('class'   => 'form-control')))
            ->add('totalMesesSysUsuarioTieneModulo',TextType::class, array("required"=>true,"label"=>"Prefijo", 'attr'   =>  array('class'   => 'form-control')))
            ->add('sysModulo', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                    "class" => "AppBundle:SysModulos",
                    "attr"=>array( "class"=>"form-name form-control" ),
                    "label"=>"Seleccionar Pais"
                    ) )
            ->add('sysInstitucion', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                    "class" => "AppBundle:SysInstitucion",
                    "attr"=>array( "class"=>"form-name form-control" ),
                    "label"=>"Seleccionar Pais"
                    ) )
            ->add('estatusSysUtm', CheckboxType::class, array("required"=>false,"label"=>"Estatus", 'attr'   =>  array('class'   => 'switch switch-success checkbox-emrx')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysInstitucionTieneModulo'
        ));
    }
}
