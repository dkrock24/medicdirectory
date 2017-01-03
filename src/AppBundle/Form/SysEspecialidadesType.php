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

class SysEspecialidadesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoriaSysEspecialidad',TextType::class, array("required"=>true,"label"=>"Name", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('nombreSysEspecialidades',TextType::class, array("required"=>true,"label"=>"Name", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('descripcionSysEspecialidades',TextType::class, array("required"=>true,"label"=>"Name", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('codigoSysEspecialidades',TextType::class, array("required"=>true,"label"=>"Name", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('estatusSysEspecialidad',CheckboxType::class, array("required"=>false,"label"=>"Es activo?", 'attr'   =>  array(
                                'class'   => 'switch switch-success checkbox-emrx')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysEspecialidades'
        ));
    }
}
