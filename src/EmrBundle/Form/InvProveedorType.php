<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvProveedorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('iprNombre')->add('iprNombreLegal')->add('iprNombreAbreviado')->add('iprTelefono1')->add('iprTelefono2')->add('iprEmail')->add('iprDireccion')->add('iprDescripcion')->add('iprFechaCrea')->add('iprFechaMod')->add('iprActivo')->add('iprItpr');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InvProveedor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_invproveedor';
    }


}
