<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\EmailType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
//use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use \Symfony\Component\Form\Extension\Core\Type\NumberType;

class MenuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('menNombre', TextType::class, array("label"=>"Nombre:","required"=>true))
				//->add('menIcono', TextType::class, array("label"=>"Icono:"))
				->add('menIcono', TextType::class, array( "label"=>"Icono", "required"=>"", "attr"=>array( "class"=>"form-name", 'data-toggle'=>"modal", 'data-target'=>".bs-example-modal-lg", "autocomplete"=>false ) ) )	
				->add('menEnlace', TextType::class, array("label"=>"Enlace:"))
				->add('menOrden', NumberType::class, array("label"=>"Orden:", 'scale' => 5))
				->add('menBackend', CheckboxType::class, array("label"=>"Backend"))
				//->add('menFechaCrea')
				//->add('menFechaMod')
				->add('menActivo', CheckboxType::class, array("label"=>"Activo"))
				->add('menPadre', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
						//"label"=>"Menú padre:", "required"=>false
						"class" => "AppBundle:Menu",
						'mapped'=>true,
						'required'    => false,
						'placeholder' => '',
						'empty_data'  => null,
						'multiple'=> false,
						'data' => array()
					)
				)
				//->add('menPadre')
				->add('permisos', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
				
						"class" => "AppBundle:Rol",
						'mapped'=>false,
						'required'    => false,
						'placeholder' => 'Seleccione el permiso',
						'empty_data'  => null,
						'multiple'=> true,
						'data' => array()
						//'preferred_choices' => array('1')

					)
				)
				;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Menu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_menu';
    }


}
