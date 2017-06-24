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
        $builder->add('modCampNombre')
                ->add('modCampNombreCorto')
                ->add('modCampShowIfnull')
                ->add('modCampValorDefault')
                ->add('modCampEsCatalogo')
                ->add('modCampRequerido')
                ->add('modCampTipCampId')
                ->add('modCampOrden')
                ->add('modCampActivo')
//                ->add('modCampFechaCrea')
                ->add('modCampFechaMod')
                ->add('tipoCampos')
                ->add('seccionCampo')
                ->add('campoPadre')
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
