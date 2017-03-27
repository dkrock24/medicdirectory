<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DepartamentoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('depDepartamento', TextType::class, array("label"=>"Departamento:","required"=>true))
				->add('depCodigo',TextType::class, array("label"=>"Código:","required"=>false))
				->add('depAbreviatura',TextType::class, array("label"=>"Abreviatura:","required"=>false))
				//->add('depFechaCrea')
				//->add('depFechaMod')
				->add('depActivo',CheckboxType::class, array("label"=>"Activo", "required"=>false))
				->add('depPai', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
						//"label"=>"Menú padre:", "required"=>false
						"class" => "AppBundle:Pais",
						'mapped'=>true,
						'required'    => true,
						'placeholder' => '',
						'empty_data'  => null,
						'multiple'=> false,
						//'data' => array()
					));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Departamento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_departamento';
    }


}
