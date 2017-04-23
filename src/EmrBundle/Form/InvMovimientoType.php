<?php

namespace EmrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\InvTipoMovimiento;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class InvMovimientoType extends AbstractType
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
        $id_cliente = $options['id_cliente_session'];

        $builder->add('imoValor',TextType::class, array("label"=>"Valor:","required"=>true))
        ->add('imoDescripcion',TextareaType::class, array("label"=>"Descripción:","required"=>true))
        ->add('imoItm', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        "label"=>"Tipo Movimiento :",
                        "class" => "AppBundle:InvTipoMovimiento",
                        'query_builder' => function (EntityRepository $er){
                            global $id_cliente;
                            return $er->createQueryBuilder('u')
                                ->where('u.itmCli = :n')
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
            'data_class' => 'AppBundle\Entity\InvMovimiento'
        ));
        $resolver->setRequired('id_cliente_session');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_invmovimiento';
    }


}
