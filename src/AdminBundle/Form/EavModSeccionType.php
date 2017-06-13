<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EavModSeccionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('modSeccModId')
                ->add('modSeccSeccion', null, array(
                    'label' => 'Nombre'
                ))
                ->add('modSeccOrden', null, array(
                    'label' => 'Orden'
                ))
                ->add('modSeccActivo', null, array(
                    'label' => 'Activa'
                ))
                ->add('modSeccFechaCrea')
                ->add('modSeccFechaMod')
                ->add('modulos')
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\EavModSeccion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_eavmodseccion';
    }


}
