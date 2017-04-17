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
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InventarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('invNombreComercial',TextType::class, array("label"=>"Nombre Comercial:","required"=>true))
                ->add('invNombreComponente',TextType::class, array("label"=>"Nombre Componente:","required"=>true))
                ->add('invContenido',TextType::class, array("label"=>"Contenido:","required"=>true))
                ->add('invLote',TextType::class, array("label"=>"Lote:","required"=>true))
                ->add('invMgs',TextType::class, array("label"=>"Mgs:","required"=>true))
                ->add('invCodigoProducto',TextType::class, array("label"=>"Codigo Producto:","required"=>true))
                ->add('invFechaVencimiento',DateType::class, array("label"=>"Vencimiento:","required"=>true))
                ->add('invDescripcionProducto',TextType::class, array("label"=>"Descripción:","required"=>true))
                ->add('invNotasProducto',TextType::class, array("label"=>"Notas Producto:","required"=>true))
                ->add('invPrecioUnitario',TextType::class, array("label"=>"Precio Unidad:","required"=>true))

                ->add('invPrecioUnitario',TextType::class, array("label"=>"Precio Unidad:","required"=>true))
                ->add('invTotalUnidades',TextType::class, array("label"=>"Total Unidad:","required"=>true))
                ->add('invPrecioVenta',TextType::class, array("label"=>"Precio Venta:","required"=>true))
                ->add('invPrecioMedioMayoreo',TextType::class, array("label"=>"Precio Mayoreo:","required"=>true))


                ->add('invPrecioEspecial',TextType::class, array("label"=>"Precio Especial:","required"=>true))
                ->add('invPrecioDescuento',TextType::class, array("label"=>"Precio Descuento:","required"=>true));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Inventario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_inventario';
    }


}
