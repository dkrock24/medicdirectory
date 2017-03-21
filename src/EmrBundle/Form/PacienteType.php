<?php

namespace EmrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PacienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pacNombre')
				->add('pacSegNombre')
				//->add('pacFechaMod')
				->add('pacApellido')
				->add('pacSegApellido')
				->add('pacGenero')
				->add('pacEmail')
				->add('pacDui')
				->add('pacEstadoCivil')
				->add('pacTipSangre')
				->add('pacTelTrabajo')
				->add('pacTelCelular')
				->add('pacTelCasa')
				->add('pacDireccion')
				->add('pacFechaNacimiento')
				->add('pacFoto')
				//->add('pacFechaCrea')
				->add('pacActivo')
				->add('pacCiu')
				->add('pacCli')
				->add('pacUsu');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Paciente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_paciente';
    }


}
