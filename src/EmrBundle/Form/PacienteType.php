<?php

namespace EmrBundle\Form;

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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class PacienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pacNombre')
				->add('pacSegNombre')
				//->add('pacFechaMod')
				->add('pacApellido')
				->add('pacSegApellido')
				->add('pacGenero', ChoiceType::class, array(
					'attr'   =>  array(
					'class'   => 'form-control select'),
					'choices'  => array(
						//'Maybe' => null,
						'Masculino' => "M",
						'Femenino' => "F",
					),
				))
				->add('pacEmail', TextType::class, array("label"=>"Email:","required"=>false, "attr"=>array( "class"=>"", "autocomplete"=>false )))
				->add('pacDui')
				->add('pacEstadoCivil')
				->add('pacTipSangre', ChoiceType::class, array(
					'required' => false,
					'attr'   =>  array(
					'class'   => 'form-control select'),
					'choices'  => array(
						//'Maybe' => null,
						'A-positivo' => "A-positivo",
						'A-negativo' => "A-negativo",
						'B-positivo'=> "B-positivo",
						'B-negativo' => "B-negativo",
						"O-positivo" => "O-positivo",
						"O-negativo" => "O-negativo",
						"AB-positivo" => "AB-positivo",
						"AB-negativo" => "AB-negativo",
					),
				))
				->add('pacTelTrabajo')
				->add('pacTelCelular')
				->add('pacTelCasa')
				->add('pacMun', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
				
						"class" => "AppBundle:Municipio",
					
						'choice_label' => function ($pacMun) {
							return $pacMun->getMunNombre()." / ".$pacMun->getMunDep();
						},
						'required'    => false,
						//'empty_data'  => null,
						'multiple'=> false,
						//'data' => array(),
						"attr"=>array( "class"=>"select" )
						//'preferred_choices' => array('1')
					))
				->add('pais', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
				
						"class" => "AppBundle:Pais",
						'mapped'=>false,
						'required'    => false,
						//'placeholder' => 'Seleccione el pais',
						//'empty_data'  => null,
						'multiple'=> false,
						"attr"=>array( "class"=>"select" ),
						'data' => array()
						//'preferred_choices' => array('1')
					)
				)
				->add('pacDireccion')
				//->add('pacFechaNacimiento')
				->add('pacFechaNacimiento', DateType::class, array(
					/*
						'placeholder' => array(
							'year' => 'Año', 'month' => 'Mes', 'day' => 'Día'
						),
						//'years' => range( (date("Y")-100), date("Y") )
						'years' => range( 1917, date("Y") )
					 * 
					 */
						'widget' => 'single_text',
						'html5' => false,

						// add a class that can be selected in JavaScript
						'attr' => ['class' => 'birth_date', 'readonly'=>"readonly"],

					) 
						
				)
								
				->add('pacFoto', HiddenType::class, array("label"=>"foto:","required"=>false, "attr"=>array( "class"=>"imgbase64", "autocomplete"=>false )))
				//->add('pacFechaCrea')
				->add('pacActivo',CheckboxType::class, array("label"=>"Activo", "required"=>false, "attr"=>array("class"=>"styled")))
				//->add('pacCli')
				//->add('pacUsu')
				;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Paciente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_paciente';
    }


}
