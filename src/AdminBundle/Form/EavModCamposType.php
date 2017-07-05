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
        ->add('modCampShowIfnull', null, array(
            'label' => 'Mostrar si vacio'
        ))
        ->add('modCampValorDefault', null, array(
            'label' => 'Valor por defecto'
        ))
        ->add('modCampEsCatalogo', null, array(
            'label' => 'Es catalogo'
        ))
        ->add('modCampRequerido', null, array(
            'label' => 'Es obligatorio'
        ))
        ->add('modCampTipCampId')
        ->add('modCampOrden', null, array(
            'label' => 'Orden en vista'
        ))
        ->add('modCampActivo', null, array(
            'label' => 'Activo'
        ))
//                ->add('modCampFechaCrea')
        ->add('modCampFechaMod')
        ->add('tipoCampos', null, array(
            'label' => 'Tipo de campo'
        ))
        ->add('seccionCampo', null, array(
            'label' => 'Seccion del campo'
        ))
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
