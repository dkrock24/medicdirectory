<?php

namespace EmrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class InvProveedorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('iprNombre',TextType::class, array("label"=>"Nombre :","required"=>true))
                ->add('iprNombreLegal',TextType::class, array("label"=>"Nombre Legal :","required"=>true))
                ->add('iprNombreAbreviado',TextType::class, array("label"=>"Nombre Corto:","required"=>true))
                ->add('iprTelefono1',TextType::class, array("label"=>"Telefono 1 :","required"=>true))
                ->add('iprTelefono2',TextType::class, array("label"=>"Telefono 2 :","required"=>true))
                ->add('iprEmail',TextType::class, array("label"=>"Email :","required"=>true))
                ->add('iprDireccion',TextareaType::class, array("label"=>"Dirección :","required"=>true))
                ->add('iprDescripcion',TextareaType::class, array("label"=>"Descripción :","required"=>true));
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
