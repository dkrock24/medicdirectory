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

class SysAntecedentesEspecialidadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('antecedente',TextType::class, array("required"=>true,"label"=>"Nombre", 'attr'   =>  array('class'   => 'form-control')))
            ->add('valor',TextType::class, array("required"=>true,"label"=>"Nombre", 'attr'   =>  array('class'   => 'form-control')))
            ->add('descripcion',TextareaType::class, array("required"=>true,"label"=>"Nombre", 'attr'   =>  array('class'   => 'form-control')))           
            ->add('IdEspecialidad', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                    "class" => "AppBundle:SysEspecialidades",
                    "attr"=>array( "class"=>"form-name form-control" ),
                    "label"=>"Seleccionar Especialidad"
                    ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysAntecedentesEspecialidad'
        ));
    }
}
