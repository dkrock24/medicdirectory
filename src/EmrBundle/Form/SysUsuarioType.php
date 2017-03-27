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

class SysUsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class, array("required"=>false,"label"=>"Email", 'attr'   =>  array(
                                'class'   => 'form-control')))
				->add('activo')
				//->add('password')
				->add('telefono' ,TextType::class, array("required"=>true,"label"=>"Telefono", 'attr'   =>  array(
                                'class'   => 'form-control')))
				//->add('tarjetaCredito')
				//->add('usuario')
				//->add('fechaActualizacion')
				->add('genero', ChoiceType::class, array(
					'attr'   =>  array(
					'class'   => 'form-control'),
					'choices'  => array(
						//'Maybe' => null,
						'Masculino' => "M",
						'Femenino' => "F",
					),
				))
				->add('ocupacion' ,TextType::class, array("required"=>true,"label"=>"Ocupacion", 'attr'   =>  array(
                                'class'   => 'form-control')))
				->add('direccion', TextareaType::class, array("required"=>false,"label"=>"Dirección", 'attr'   =>  array(
                                'class'   => 'form-control')))
				->add('responsableDePaciente' ,TextType::class, array("required"=>true,"label"=>"Responsable paciente", 'attr'   =>  array(
                                'class'   => 'form-control')))
				//->add('numeroAfp')
				//->add('numeroNup')
				->add('nombre',TextType::class, array("required"=>true,"label"=>"Nombre", 'attr'   =>  array(
                                'class'   => 'form-control')))
				->add('apellido' ,TextType::class, array("required"=>true,"label"=>"Apellido", 'attr'   =>  array(
                                'class'   => 'form-control')))
				//->add('fechaNacimiento')
				->add('celular' ,TextType::class, array("required"=>true,"label"=>"Celular", 'attr'   =>  array(
                                'class'   => 'form-control')))
				//->add('jvrm')
				->add('codigoPostal' ,TextType::class, array("required"=>true,"label"=>"Codigo postal", 'attr'   =>  array(
                                'class'   => 'form-control')))
				->add('dui' ,TextType::class, array("required"=>true,"label"=>"DUI", 'attr'   =>  array(
                                'class'   => 'form-control')))
				//->add('fechaCreacion')
				//->add('idMunicipio')
				//->add('idRol')
				;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysUsuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sysusuario';
    }


}
