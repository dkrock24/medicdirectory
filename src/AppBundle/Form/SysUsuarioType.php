<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SysUsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreSysUsuario')
            ->add('apellidoSysUsuario')
            ->add('emailSysUsuario')
            ->add('esActivoSysUsuario')
            ->add('passwordSysUsuario')
            ->add('fechaNacimientoSysUsuario', 'date')
            ->add('telefonoSysUsuariocol')
            ->add('celularSysUsuario')
            ->add('jvrmSysUsuario')
            ->add('tarjetaCreditoSysUsuario')
            ->add('sysUsuario')
            ->add('codigoPostalSysUsuario')
            ->add('duiSysUsuario')
            ->add('fechaCreacionSysUsuario', 'date')
            ->add('fechaActualizacionSysUsuario', 'datetime')
            ->add('genero')
            ->add('ocupacion')
            ->add('direccion')
            ->add('responsableDePaciente')
            ->add('numeroAfp')
            ->add('numeroNup')
            ->add('idMunicipioSysUsuario')
            ->add('idRol')
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
