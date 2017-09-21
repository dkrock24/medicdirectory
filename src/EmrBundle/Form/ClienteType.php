<?php

namespace EmrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;

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

class ClienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		//$builder = $this->createFormBuilder($article);
        $builder->add('cliNombre', TextType::class, array("label"=>"Nombre Comercial:","required"=>true, "attr"=>array( "class"=>"", "autocomplete"=>false )))
				->add('cliNombreFiscal')
				->add('cliNit')
				->add('cliTelefono1')
				->add('cliTelefono2')
				->add('cliDireccion')
				//->add('cliNombreComercial')
				->add('cliUbicacionLat', TextType::class, array("label"=>"Latitud:","required"=>false, "attr"=>array( "class"=>"", "autocomplete"=>false )))
				->add('cliUbicacionLon', TextType::class, array("label"=>"Longitud:","required"=>false, "attr"=>array( "class"=>"", "autocomplete"=>false )) )
				//->add('cliFechaRegistro')
				//->add('cliIdVendedor')
				//->add('cliFechaCrea')
				//->add('cliFechaMod')
				//->add('cliActivo')
				/*
				->add('cliEsp', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
				
						"class" => "AppBundle:Especialidad",
					
						'query_builder' => function (EntityRepository $er) {
							return $er->createQueryBuilder('u')
								->orderBy('u.espEspecialidad', 'ASC');
						},
						'required'    => true,
						//'empty_data'  => null,
						'multiple'=> true,
						//'data' => array(),
						"attr"=>array( "class"=>"select" ),
						//'preferred_choices' => array('108')
					) )
				*/
				->add('idEspecialidad')
				->add('cliTipCli', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
						"class" => "AppBundle:TipoCliente",
						//'required'    => true,
						//'empty_data'  => null,
						'multiple'=> false,
						//'data' => array(),
						"attr"=>array( "class"=>"select","data-placeholder"=>"Establecimiento" ),
						//'preferred_choices' => array('1')
                        "query_builder" => function(EntityRepository $repository) {
                            return $repository->createQueryBuilder('u')
                                ->where('u.tipCliActivo = ?1')
                                ->setParameter('1','1');
                        },
					))
				->add('cliMun', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
				
						"class" => "AppBundle:Municipio",
					
						'choice_label' => function ($pacMun) {
							return $pacMun->getMunNombre()." / ".$pacMun->getMunDep();
						},
						//'required'    => true,
						//'empty_data'  => null,
						'multiple'=> false,
						//'data' => array(),
						"attr"=>array( "class"=>"select","data-placeholder"=>"Minicipo" )
								
						//'preferred_choices' => array('1')
					))
				 /*
				->add('pacFechaNacimiento', DateType::class, array(
					'placeholder' => array(
						'year' => 'Año', 'month' => 'Mes', 'day' => 'Día'
					),
					'mapped'=>false,
					//'years' => range( (date("Y")-100), date("Y") )
					'years' => range( 1937, date("Y") )
					) )
				*/				
				;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Cliente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_cliente';
    }


}
