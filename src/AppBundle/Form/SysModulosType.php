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

class SysModulosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreSysModulo',TextType::class, array("required"=>true,"label"=>"Name", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('descripcionSysModulo',TextType::class, array("required"=>true,"label"=>"Prefijo", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('precioSysModulo',TextType::class, array("required"=>true,"label"=>"Código postal", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('codigoSysModulo',TextType::class, array("required"=>true,"label"=>"Continente", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('imagenModulo',FileType::class, array("required"=>true,"label"=>"ff", 'attr'   =>  array('class'   => 'form-control'),'data_class' => null))
            //->add('fechaCreacionSysModulo',DateType::class, array("required"=>true,"label"=>"Fecha", 'attr'   =>  array(
                                //'class'   => 'form-control')))
            ->add('estatusSysModulo', CheckboxType::class, array("required"=>false,"label"=>"Es activo?", 'attr'   =>  array(
                                'class'   => 'switch switch-success checkbox-emrx')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysModulos'
        ));
    }
}
