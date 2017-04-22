<?php

namespace EmrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\InvCategoria;
use AppBundle\Entity\InvUnidadMedida;
use AppBundle\Entity\InvArea;
use AppBundle\Entity\InvTipoPresentacion;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InventarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        global $id_cliente ;
        $id_cliente = $options['id_cliente'];

        $builder->add('invNombreComercial',TextType::class, array("label"=>"Nombre Comercial:","required"=>true))
                ->add('invNombreComponente',TextType::class, array("label"=>"Nombre Componente:","required"=>true))
                ->add('invContenido',TextType::class, array("label"=>"Contenido:","required"=>true))
                ->add('invLote',TextType::class, array("label"=>"Lote:","required"=>true))
                ->add('invEtiquetaAlmacenaje',TextType::class, array("label"=>"Etiqueta Almacenaje:","required"=>true))
                ->add('invMgs',TextType::class, array("label"=>"Mgs:","required"=>true))
                ->add('invCodigoProducto',TextType::class, array("label"=>"Codigo Producto:","required"=>true))
                ->add('invFechaVencimiento',DateType::class, array("label"=>"Vencimiento:","required"=>true))
                ->add('invDescripcionProducto',TextType::class, array("label"=>"Descripción:","required"=>true))
                ->add('invNotasProducto',TextType::class, array("label"=>"Notas Producto:","required"=>true))
                ->add('invPrecioUnitario',TextType::class, array("label"=>"Precio Unidad:","required"=>true))

                ->add('invPrecioUnitario',TextType::class, array("label"=>"Precio Unidad:","required"=>true))
                ->add('invTotalUnidades',TextType::class, array("label"=>"Total Unidad:","required"=>true))
                ->add('invPrecioVenta',TextType::class, array("label"=>"Precio Venta:","required"=>true))
                ->add('invPrecioMedioMayoreo',TextType::class, array("label"=>"Precio Medio Mayoreo:","required"=>true))
                ->add('invPrecioVentaMayoreo',TextType::class, array("label"=>"Precio Mayoreo:","required"=>true))
                ->add('invPrecioEspecial',TextType::class, array("label"=>"Precio Especial:","required"=>true))
                ->add('invPrecioDescuento',TextType::class, array("label"=>"Precio Descuento:","required"=>true))

                ->add('invCatInv', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        "label"=>"Categoria :",
                        "class" => "AppBundle:InvCategoria",
                        'query_builder' => function (EntityRepository $er){
                            global $id_cliente;
                            return $er->createQueryBuilder('u')
                                ->where('u.icaCli = :n')
                                ->setParameter('n',$id_cliente);
                        },
                        'mapped'=>true,
                        'required'    => true,
                        'placeholder' => '',
                        'empty_data'  => null,
                        'multiple'=> false,
                        //'data' => array()
                    ))
                ->add('invUmeInv', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        "label"=>"Unidad de Medida :",
                        "class" => "AppBundle:InvUnidadMedida",
                        'query_builder' => function (EntityRepository $er){
                            return $er->createQueryBuilder('u')
                                ;
                        },
                        'mapped'=>true,
                        'required'    => true,
                        'placeholder' => '',
                        'empty_data'  => null,
                        'multiple'=> false,
                        //'data' => array()
                    ))
                ->add('invAreaInv', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        "label"=>"Area :",
                        "class" => "AppBundle:InvArea",
                        'query_builder' => function (EntityRepository $er){
                            global $id_cliente;
                            return $er->createQueryBuilder('u')
                            ->where('u.iarCli = :n')
                            ->setParameter('n',$id_cliente);
                        },
                        'mapped'=>true,
                        'required'    => true,
                        'placeholder' => '',
                        'empty_data'  => null,
                        'multiple'=> false,
                        //'data' => array()
                    ))
                ->add('invTipPre', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        "label"=>"Tipo Presentacion :",
                        "class" => "AppBundle:InvTipoPresentacion",
                        'query_builder' => function (EntityRepository $er){
                            global $id_cliente;
                            return $er->createQueryBuilder('u')
                            ->where('u.itpCli = :n')
                            ->setParameter('n',$id_cliente);
                        },
                        'mapped'=>true,
                        'required'    => true,
                        'placeholder' => '',
                        'empty_data'  => null,
                        'multiple'=> false,
                        //'data' => array()
                    ))
                ->add('invProInv', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        "label"=>"Proveedor :",
                        "class" => "AppBundle:InvProveedor",
                        'query_builder' => function (EntityRepository $er){
                            global $id_cliente;
                            return $er->createQueryBuilder('u')
                            ->where('u.iprCli = :n')
                            ->setParameter('n',$id_cliente);
                        },
                        'mapped'=>true,
                        'required'    => true,
                        'placeholder' => '',
                        'empty_data'  => null,
                        'multiple'=> false,
                        //'data' => array()
                    ))
                ->add('invGrpInv', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                        "label"=>"Grupo Inventario :",
                        "class" => "AppBundle:InvGrupo",
                        'query_builder' => function (EntityRepository $er){
                            global $id_cliente;
                            return $er->createQueryBuilder('u')
                            ->where('u.igrCli = :n')
                            ->setParameter('n',$id_cliente);
                        },
                        'mapped'=>true,
                        'required'    => true,
                        'placeholder' => '',
                        'empty_data'  => null,
                        'multiple'=> false,
                        //'data' => array()
                    ))






                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Inventario'
        ));
        $resolver->setRequired('id_cliente');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_inventario';
    }


}
