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

class SysSugerenciasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            
            ->add('sysArea', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                    "class" => "AppBundle:SysArea",
                    "attr"=>array( "class"=>"form-name form-control" ),
                    "label"=>"Seleccionar Areas"))
            ->add('sysInstitucion', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                    "class" => "AppBundle:SysInstitucion",
                    "attr"=>array( "class"=>"form-name form-control" ),
                    "label"=>"Seleccionar Areas"))
            ->add('comentarioSysSugerencia',TextareaType::class, array("required"=>true,"label"=>"Comentario", 'attr'   =>  array('class'   => 'form-control')))
            ->add('estatusSugerencia', CheckboxType::class, array("required"=>false,"label"=>"Estatus", 'attr'   =>  array('class'   => 'switch switch-success checkbox-emrx')))
            
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysSugerencias'
        ));
    }
}
