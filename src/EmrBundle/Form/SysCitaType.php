<?php

namespace EmrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SysCitaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('fechaCitaSysCita', 'datetime')
            ->add('comentario')
            ->add('estadoCita')
            //->add('fechaCita', 'datetime')
            ->add('sysInstTieneArea')
            ->add('sysUsuarioMedico')
            ->add('sysUsuarioPaciente')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SysCita'
        ));
    }
}
