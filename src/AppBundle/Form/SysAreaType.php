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

class SysAreaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreSysArea',TextType::class, array("required"=>true,"label"=>"Nombre", 'attr'   =>  array('class'   => 'form-control')))
            ->add('descripcionSysArea',TextType::class, array("required"=>true,"label"=>"Descripcion", 'attr'   =>  array('class'   => 'form-control')))
             ->add('nombreCortoSysArea',TextType::class, array("required"=>true,"label"=>"Nombre Corto", 'attr'   =>  array('class'   => 'form-control')))
            ->add('estatusSysArea', CheckboxType::class, array("required"=>false,"label"=>"Estatus", 'attr'   =>  array('class'   => 'switch switch-success checkbox-emrx')))
           
            //->add('fechaCreacion', 'datetime')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysArea'
        ));
    }


}
