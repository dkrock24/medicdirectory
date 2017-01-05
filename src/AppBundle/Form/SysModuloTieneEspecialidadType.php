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

class SysModuloTieneEspecialidadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('sysModulos', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                    "class" => "AppBundle:SysModulos",
                    "attr"=>array( "class"=>"form-name form-control" ),
                    "label"=>"Seleccionar Pais"
                    ) )
            ->add('sysEspecialidades', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                    "class" => "AppBundle:SysEspecialidades",
                    "attr"=>array( "class"=>"form-name form-control" ),
                    "label"=>"Seleccionar Pais"
                    ) )
            ->add('sysEstatus', CheckboxType::class, array("required"=>false,"label"=>"Estatus", 'attr'   =>  array('class'   => 'switch switch-success checkbox-emrx')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysModuloTieneEspecialidad'
        ));
    }
}
