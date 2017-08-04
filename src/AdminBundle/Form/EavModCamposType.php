<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EavModCamposType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('modCampNombre', null, array(
            'label' => 'Nombre del campo'
        ))
        ->add('modCampNombreCorto')
        ->add('modCampTipCampId')
        ->add('modCampOrden', null, array(
            'label' => 'Orden en vista'
        ))
        ->add('modCampActivo', null, array(
            'label' => 'Activo'
        ))
        ->add('grupoCampo', null, array(
            'label' => 'Grupo'
        ))
        ->add('modCampFechaMod')
        ->add('tipoCampos', null, array(
            'label' => 'Tipo de campo'
        ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EavModCampos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_eavmodcampos';
    }


}
