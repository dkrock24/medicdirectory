<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;

class ModuloType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('modModulo', null, array(
                    'label' => 'Nombre'
                ))
                ->add('modEsp', null, array(
                    'label' => 'Especialidad'
                ))
                //->add('modHashCode')
                ->add('modOrden', null, array(
                    'label' => 'Orden'
                ))
                ->add('modCosto', null, array(
                    'label' => 'Costo'
                ))
                //->add('modFechaCrea')
                //->add('modFechaMod')
                ->add('secciones', Type\CollectionType::class
                    ,array(
                        'entry_type' => EavModSeccionType::class,
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false
                    ) 
                )
                ->add('modActivo', null, array(
                    'label' => 'Activo'
                ))
                ;
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
        return 'appbundle_modulo';
    }


}
