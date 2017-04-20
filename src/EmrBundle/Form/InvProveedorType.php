<?php

namespace EmrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\InvProveedor;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class InvProveedorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        
        global $id_cliente ;
        $id_cliente = $options['security_context'];

        $builder->add('iprNombre',TextType::class, array("label"=>"Nombre :","required"=>true))
                ->add('iprNombreLegal',TextType::class, array("label"=>"Nombre Legal :","required"=>true))
                ->add('iprNombreAbreviado',TextType::class, array("label"=>"Nombre Corto:","required"=>true))
                ->add('iprTelefono1',TextType::class, array("label"=>"Telefono 1 :","required"=>true))
                ->add('iprTelefono2',TextType::class, array("label"=>"Telefono 2 :","required"=>true))
                ->add('iprEmail',TextType::class, array("label"=>"Email :","required"=>true))
                ->add('iprDireccion',TextareaType::class, array("label"=>"Dirección :","required"=>true))
                ->add('iprDescripcion',TextareaType::class, array("label"=>"Descripción :","required"=>true))
                ->add('iprItpr', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        "label"=>"Tipo Proveedor :",
                        "class" => "AppBundle:InvTipoProveedor",
                        'query_builder' => function (EntityRepository $er){
                            global $id_cliente;
                            return $er->createQueryBuilder('u')
                                ->where('u.itprCli = :n')
                                ->setParameter('n',$id_cliente);
                        },
                        'mapped'=>true,
                        'required'    => true,
                        'placeholder' => '',
                        'empty_data'  => null,
                        'multiple'=> false,
                        //'data' => array()
                    ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InvProveedor'
        ));
        $resolver->setRequired('security_context');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_invproveedor';
    }


}
