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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SysMunicipioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreSysMunicipo',TextType::class, array("required"=>true,"label"=>"Name", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('descripcionSysMunicipio',TextType::class, array("required"=>false,"label"=>"Descripción", 'attr'   =>  array(
                                'class'   => 'form-control')))
            
			
			->add('sysDepartamentos', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
					"class" => "AppBundle:SysDepartamentos",
					"attr"=>array( "class"=>"form-name form-control" ),
					"label"=>"Seleccionar Departamento"
					))
				
				/*
			->add('sysDepartamentos', ChoiceType::class, array(
					"attr"=>array( "class"=>"form-name form-control" ),
					"label"=>"Seleccionar Departamento"
					))
				*/
			->add('estatusSysMunicipo',CheckboxType::class, array("required"=>false,"label"=>"Es activo?", 'attr'   =>  array(
                                'class'   => 'switch switch-success checkbox-emrx')))
				
			->add('myExtraFieldCountry', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
								"class" => "AppBundle:SysPais",
								"required"=>false, "label"=>"Seleccione Pais", 'attr'  =>  array(
                                'class'   => 'form-control'),
								'mapped' => false
								))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysMunicipio'
        ));
    }
}
