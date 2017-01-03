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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SysUsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreSysUsuario',TextType::class, array("required"=>true,"label"=>"Nombres", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('apellidoSysUsuario',TextType::class, array("required"=>true,"label"=>"Apellidos", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('emailSysUsuario',EmailType::class, array("required"=>true,"label"=>"Email", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('passwordSysUsuario',PasswordType::class, array("required"=>true,"label"=>"Password", 'attr'   =>  array(
                                'class'   => 'form-control')))
            //->add('fechaNacimientoSysUsuario', 'date')
            ->add('telefonoSysUsuario',TextType::class, array("required"=>false,"label"=>"Telefono", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('celularSysUsuario',TextType::class, array("required"=>false,"label"=>"Celular", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('jvrmSysUsuario',TextType::class, array("required"=>false,"label"=>"JVRM", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('tarjetaCreditoSysUsuario',TextType::class, array("required"=>false,"label"=>"Tarjeta de crédido", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('sysUsuario',TextType::class, array("required"=>true,"label"=>"Username", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('codigoPostalSysUsuario',TextType::class, array("required"=>false,"label"=>"Código Postal", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('duiSysUsuario',TextType::class, array("required"=>false,"label"=>"DUI", 'attr'   =>  array(
                                'class'   => 'form-control')))
            //->add('fechaCreacionSysUsuario', 'date')
            //->add('fechaActualizacionSysUsuario', 'datetime')
            ->add('genero',TextType::class, array("required"=>true,"label"=>"Genero", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('ocupacion',TextType::class, array("required"=>false,"label"=>"Ocupacion", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('direccion',TextType::class, array("required"=>false,"label"=>"Dirección", 'attr'   =>  array(
                                'class'   => 'form-control')))
            /* ->add('responsableDePaciente',TextType::class, array("required"=>false,"label"=>"Responsable", 'attr'   =>  array(
                                'class'   => 'form-control')))
				*/
            ->add('numeroAfp',TextType::class, array("required"=>false,"label"=>"AFP", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('numeroNup',TextType::class, array("required"=>false,"label"=>"NUP", 'attr'   =>  array(
                                'class'   => 'form-control')))
            ->add('idMunicipioSysUsuario', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
								"class" => "AppBundle:SysMunicipio",
								"required"=>false, "label"=>"Seleccione Pais", 'attr'  =>  array(
                                'class'   => 'form-control'),
								'mapped' => true
								))
            ->add('idRol', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
								"class" => "AppBundle:SysRoles",
								"required"=>true, "label"=>"Seleccione Pais", 'attr'  =>  array(
                                'class'   => 'form-control'),
								'mapped' => true
								))
			->add('estatusSysUsuario',CheckboxType::class, array("required"=>false,"label"=>"Es activo?", 'attr'   =>  array(
                                'class'   => 'switch switch-success')))	
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysUsuario'
        ));
    }
}
