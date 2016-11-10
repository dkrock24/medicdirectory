<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SysTipoInstitucionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreTipoSysInstitucion')
            ->add('descripcionSysTipoInstitucion')
            ->add('estadoSysTipoInstitucion')
            ->add('codigoSysTipoInstitucion')
            ->add('fechaCrecionSysTipoInstitucion', 'date')
            ->add('idMunicipio')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysTipoInstitucion'
        ));
    }
}
