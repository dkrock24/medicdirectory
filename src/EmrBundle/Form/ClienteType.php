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
        $builder->add('cliNombre')
				->add('cliNombreFiscal')
				->add('cliNit')
				->add('cliTelefono1')
				->add('cliTelefono2')
				->add('cliDireccion')
				//->add('cliFechaRegistro')
				->add('cliIdVendedor')
				//->add('cliFechaCrea')
				//->add('cliFechaMod')
				//->add('cliActivo')
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
						"attr"=>array( "class"=>"select" )
						//'preferred_choices' => array('1')
					) )
				->add('cliTipCli')
				->add('cliMun', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
				
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
