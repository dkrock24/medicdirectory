<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class SysDepartamentosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreSysDepartamento',TextType::class, array("required"=>true,"label"=>"Name", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('codigoZonaSysDepartamento', TextType::class, array("required"=>false,"label"=>"Código", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('descripcionSysDepartamento', TextType::class, array("required"=>false,"label"=>"Descripción", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('prefijoSysDepartamento', TextType::class, array("required"=>false,"label"=>"Prefijo", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('estatusSysDepartamento',CheckboxType::class, array("required"=>false,"label"=>"Es activo?", 'attr'   =>  array(
                                'class'   => 'switch switch-success checkbox-emrx')))
            ->add('pais', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
					"class" => "AppBundle:SysPais",
					"attr"=>array( "class"=>"form-name form-control" ),
					"label"=>"Seleccionar Pais"
					) )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysDepartamentos'
        ));
    }
}
