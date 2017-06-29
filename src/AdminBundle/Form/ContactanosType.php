<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ContactanosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('conNombre',TextType::class, array("label"=>"Nombre:","required"=>true))
                ->add('conEmail',TextType::class, array("label"=>"Email:","required"=>true))
                ->add('conTipo',TextType::class, array("label"=>"Tipo:","required"=>true))
                ->add('conIp',TextType::class, array("label"=>"IP:","required"=>true))
                ->add('conMensaje',TextareaType::class, array("label"=>"Mensaje:","required"=>true))
                ->add('conActivo',CheckboxType::class, array("label"=>"Activo:","required"=>false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contactanos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contactanos';
    }


}
