<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteModuloType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder//->add('cliModFechaCrea')
                //->add('cliModFechaMod')
                ->add('cliModMod', null, array(
            'label' => 'Modulo'
        ))
                ->add('cliModCli', null, array(
            'label' => 'Cliente'
        ))
                ->add('cliModActivo', null, array(
            'label' => 'Activo'
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ClienteModulo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_clientemodulo';
    }


}
