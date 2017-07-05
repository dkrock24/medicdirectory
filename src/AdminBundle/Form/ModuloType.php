<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuloType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('modModulo', null, array(
            'label' => 'Modulo'
        ))
        ->add('modHashCode')
        ->add('modOrden', null, array(
            'label' => 'Orden en vista'
        ))
        ->add('modCosto', null, array(
            'label' => 'Costo'
        ))
        ->add('modActivo', null, array(
            'label' => 'Activo'
        ))
        ->add('modEsp', null, array(
            'label' => 'Especialidad'
        ));
        
        $builder->add( 'secciones', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, array(
            'entry_type' => EavModSeccionType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'error_bubbling' => true
        ) );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Modulo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_modulo';
    }


}
