<?php

namespace AppBundle\Entity;

/**
 * Inventario
 */
class Inventario
{
    /**
     * @var integer
     */
    private $invId;

    /**
     * @var string
     */
    private $invNombreComercial;

    /**
     * @var string
     */
    private $invNombreComponente;

    /**
     * @var string
     */
    private $invContenido;

    /**
     * @var string
     */
    private $invLote;

    /**
     * @var string
     */
    private $invMgs;

    /**
     * @var string
     */
    private $invCodigoProducto;

    /**
     * @var \DateTime
     */
    private $invFechaVencimiento;

    /**
     * @var string
     */
    private $invImagenProducto;

    /**
     * @var string
     */
    private $invDescripcionProducto;

    /**
     * @var string
     */
    private $invNotasProducto;

    /**
     * @var string
     */
    private $invEtiquetaAlmacenaje;

    /**
     * @var string
     */
    private $invPrecioUnitario;

    /**
     * @var integer
     */
    private $invTotalUnidades;

    /**
     * @var string
     */
    private $invPrecioVenta;

    /**
     * @var string
     */
    private $invPrecioMedioMayoreo;

    /**
     * @var string
     */
    private $invPrecioVentaMayoreo;

    /**
     * @var string
     */
    private $invPrecioEspecial;

    /**
     * @var string
     */
    private $invPrecioDescuento;

    /**
     * @var \DateTime
     */
    private $invFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $invFechaMod;

    /**
     * @var boolean
     */
    private $invActivo = '1';

    /**
     * @var \AppBundle\Entity\InvArea
     */
    private $invAreaInv;

    /**
     * @var \AppBundle\Entity\InvCategoria
     */
    private $invCatInv;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $invCli;

    /**
     * @var \AppBundle\Entity\InvGrupo
     */
    private $invGrpInv;

    /**
     * @var \AppBundle\Entity\InvProveedor
     */
    private $invProInv;

    /**
     * @var \AppBundle\Entity\InvTipoPresentacion
     */
    private $invTipPre;

    /**
     * @var \AppBundle\Entity\InvUnidadMedida
     */
    private $invUmeInv;


    /**
     * Get invId
     *
     * @return integer
     */
    public function getInvId()
    {
        return $this->invId;
    }

    /**
     * Set invNombreComercial
     *
     * @param string $invNombreComercial
     *
     * @return Inventario
     */
    public function setInvNombreComercial($invNombreComercial)
    {
        $this->invNombreComercial = $invNombreComercial;

        return $this;
    }

    /**
     * Get invNombreComercial
     *
     * @return string
     */
    public function getInvNombreComercial()
    {
        return $this->invNombreComercial;
    }

    /**
     * Set invNombreComponente
     *
     * @param string $invNombreComponente
     *
     * @return Inventario
     */
    public function setInvNombreComponente($invNombreComponente)
    {
        $this->invNombreComponente = $invNombreComponente;

        return $this;
    }

    /**
     * Get invNombreComponente
     *
     * @return string
     */
    public function getInvNombreComponente()
    {
        return $this->invNombreComponente;
    }

    /**
     * Set invContenido
     *
     * @param string $invContenido
     *
     * @return Inventario
     */
    public function setInvContenido($invContenido)
    {
        $this->invContenido = $invContenido;

        return $this;
    }

    /**
     * Get invContenido
     *
     * @return string
     */
    public function getInvContenido()
    {
        return $this->invContenido;
    }

    /**
     * Set invLote
     *
     * @param string $invLote
     *
     * @return Inventario
     */
    public function setInvLote($invLote)
    {
        $this->invLote = $invLote;

        return $this;
    }

    /**
     * Get invLote
     *
     * @return string
     */
    public function getInvLote()
    {
        return $this->invLote;
    }

    /**
     * Set invMgs
     *
     * @param string $invMgs
     *
     * @return Inventario
     */
    public function setInvMgs($invMgs)
    {
        $this->invMgs = $invMgs;

        return $this;
    }

    /**
     * Get invMgs
     *
     * @return string
     */
    public function getInvMgs()
    {
        return $this->invMgs;
    }

    /**
     * Set invCodigoProducto
     *
     * @param string $invCodigoProducto
     *
     * @return Inventario
     */
    public function setInvCodigoProducto($invCodigoProducto)
    {
        $this->invCodigoProducto = $invCodigoProducto;

        return $this;
    }

    /**
     * Get invCodigoProducto
     *
     * @return string
     */
    public function getInvCodigoProducto()
    {
        return $this->invCodigoProducto;
    }

    /**
     * Set invFechaVencimiento
     *
     * @param \DateTime $invFechaVencimiento
     *
     * @return Inventario
     */
    public function setInvFechaVencimiento($invFechaVencimiento)
    {
        $this->invFechaVencimiento = $invFechaVencimiento;

        return $this;
    }

    /**
     * Get invFechaVencimiento
     *
     * @return \DateTime
     */
    public function getInvFechaVencimiento()
    {
        return $this->invFechaVencimiento;
    }

    /**
     * Set invImagenProducto
     *
     * @param string $invImagenProducto
     *
     * @return Inventario
     */
    public function setInvImagenProducto($invImagenProducto)
    {
        $this->invImagenProducto = $invImagenProducto;

        return $this;
    }

    /**
     * Get invImagenProducto
     *
     * @return string
     */
    public function getInvImagenProducto()
    {
        return $this->invImagenProducto;
    }

    /**
     * Set invDescripcionProducto
     *
     * @param string $invDescripcionProducto
     *
     * @return Inventario
     */
    public function setInvDescripcionProducto($invDescripcionProducto)
    {
        $this->invDescripcionProducto = $invDescripcionProducto;

        return $this;
    }

    /**
     * Get invDescripcionProducto
     *
     * @return string
     */
    public function getInvDescripcionProducto()
    {
        return $this->invDescripcionProducto;
    }

    /**
     * Set invNotasProducto
     *
     * @param string $invNotasProducto
     *
     * @return Inventario
     */
    public function setInvNotasProducto($invNotasProducto)
    {
        $this->invNotasProducto = $invNotasProducto;

        return $this;
    }

    /**
     * Get invNotasProducto
     *
     * @return string
     */
    public function getInvNotasProducto()
    {
        return $this->invNotasProducto;
    }

    /**
     * Set invEtiquetaAlmacenaje
     *
     * @param string $invEtiquetaAlmacenaje
     *
     * @return Inventario
     */
    public function setInvEtiquetaAlmacenaje($invEtiquetaAlmacenaje)
    {
        $this->invEtiquetaAlmacenaje = $invEtiquetaAlmacenaje;

        return $this;
    }

    /**
     * Get invEtiquetaAlmacenaje
     *
     * @return string
     */
    public function getInvEtiquetaAlmacenaje()
    {
        return $this->invEtiquetaAlmacenaje;
    }

    /**
     * Set invPrecioUnitario
     *
     * @param string $invPrecioUnitario
     *
     * @return Inventario
     */
    public function setInvPrecioUnitario($invPrecioUnitario)
    {
        $this->invPrecioUnitario = $invPrecioUnitario;

        return $this;
    }

    /**
     * Get invPrecioUnitario
     *
     * @return string
     */
    public function getInvPrecioUnitario()
    {
        return $this->invPrecioUnitario;
    }

    /**
     * Set invTotalUnidades
     *
     * @param integer $invTotalUnidades
     *
     * @return Inventario
     */
    public function setInvTotalUnidades($invTotalUnidades)
    {
        $this->invTotalUnidades = $invTotalUnidades;

        return $this;
    }

    /**
     * Get invTotalUnidades
     *
     * @return integer
     */
    public function getInvTotalUnidades()
    {
        return $this->invTotalUnidades;
    }

    /**
     * Set invPrecioVenta
     *
     * @param string $invPrecioVenta
     *
     * @return Inventario
     */
    public function setInvPrecioVenta($invPrecioVenta)
    {
        $this->invPrecioVenta = $invPrecioVenta;

        return $this;
    }

    /**
     * Get invPrecioVenta
     *
     * @return string
     */
    public function getInvPrecioVenta()
    {
        return $this->invPrecioVenta;
    }

    /**
     * Set invPrecioMedioMayoreo
     *
     * @param string $invPrecioMedioMayoreo
     *
     * @return Inventario
     */
    public function setInvPrecioMedioMayoreo($invPrecioMedioMayoreo)
    {
        $this->invPrecioMedioMayoreo = $invPrecioMedioMayoreo;

        return $this;
    }

    /**
     * Get invPrecioMedioMayoreo
     *
     * @return string
     */
    public function getInvPrecioMedioMayoreo()
    {
        return $this->invPrecioMedioMayoreo;
    }

    /**
     * Set invPrecioVentaMayoreo
     *
     * @param string $invPrecioVentaMayoreo
     *
     * @return Inventario
     */
    public function setInvPrecioVentaMayoreo($invPrecioVentaMayoreo)
    {
        $this->invPrecioVentaMayoreo = $invPrecioVentaMayoreo;

        return $this;
    }

    /**
     * Get invPrecioVentaMayoreo
     *
     * @return string
     */
    public function getInvPrecioVentaMayoreo()
    {
        return $this->invPrecioVentaMayoreo;
    }

    /**
     * Set invPrecioEspecial
     *
     * @param string $invPrecioEspecial
     *
     * @return Inventario
     */
    public function setInvPrecioEspecial($invPrecioEspecial)
    {
        $this->invPrecioEspecial = $invPrecioEspecial;

        return $this;
    }

    /**
     * Get invPrecioEspecial
     *
     * @return string
     */
    public function getInvPrecioEspecial()
    {
        return $this->invPrecioEspecial;
    }

    /**
     * Set invPrecioDescuento
     *
     * @param string $invPrecioDescuento
     *
     * @return Inventario
     */
    public function setInvPrecioDescuento($invPrecioDescuento)
    {
        $this->invPrecioDescuento = $invPrecioDescuento;

        return $this;
    }

    /**
     * Get invPrecioDescuento
     *
     * @return string
     */
    public function getInvPrecioDescuento()
    {
        return $this->invPrecioDescuento;
    }

    /**
     * Set invFechaCrea
     *
     * @param \DateTime $invFechaCrea
     *
     * @return Inventario
     */
    public function setInvFechaCrea($invFechaCrea)
    {
        $this->invFechaCrea = $invFechaCrea;

        return $this;
    }

    /**
     * Get invFechaCrea
     *
     * @return \DateTime
     */
    public function getInvFechaCrea()
    {
        return $this->invFechaCrea;
    }

    /**
     * Set invFechaMod
     *
     * @param \DateTime $invFechaMod
     *
     * @return Inventario
     */
    public function setInvFechaMod($invFechaMod)
    {
        $this->invFechaMod = $invFechaMod;

        return $this;
    }

    /**
     * Get invFechaMod
     *
     * @return \DateTime
     */
    public function getInvFechaMod()
    {
        return $this->invFechaMod;
    }

    /**
     * Set invActivo
     *
     * @param boolean $invActivo
     *
     * @return Inventario
     */
    public function setInvActivo($invActivo)
    {
        $this->invActivo = $invActivo;

        return $this;
    }

    /**
     * Get invActivo
     *
     * @return boolean
     */
    public function getInvActivo()
    {
        return $this->invActivo;
    }

    /**
     * Set invAreaInv
     *
     * @param \AppBundle\Entity\InvArea $invAreaInv
     *
     * @return Inventario
     */
    public function setInvAreaInv(\AppBundle\Entity\InvArea $invAreaInv = null)
    {
        $this->invAreaInv = $invAreaInv;

        return $this;
    }

    /**
     * Get invAreaInv
     *
     * @return \AppBundle\Entity\InvArea
     */
    public function getInvAreaInv()
    {
        return $this->invAreaInv;
    }

    /**
     * Set invCatInv
     *
     * @param \AppBundle\Entity\InvCategoria $invCatInv
     *
     * @return Inventario
     */
    public function setInvCatInv(\AppBundle\Entity\InvCategoria $invCatInv = null)
    {
        $this->invCatInv = $invCatInv;

        return $this;
    }

    /**
     * Get invCatInv
     *
     * @return \AppBundle\Entity\InvCategoria
     */
    public function getInvCatInv()
    {
        return $this->invCatInv;
    }

    /**
     * Set invCli
     *
     * @param \AppBundle\Entity\Cliente $invCli
     *
     * @return Inventario
     */
    public function setInvCli(\AppBundle\Entity\Cliente $invCli = null)
    {
        $this->invCli = $invCli;

        return $this;
    }

    /**
     * Get invCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getInvCli()
    {
        return $this->invCli;
    }

    /**
     * Set invGrpInv
     *
     * @param \AppBundle\Entity\InvGrupo $invGrpInv
     *
     * @return Inventario
     */
    public function setInvGrpInv(\AppBundle\Entity\InvGrupo $invGrpInv = null)
    {
        $this->invGrpInv = $invGrpInv;

        return $this;
    }

    /**
     * Get invGrpInv
     *
     * @return \AppBundle\Entity\InvGrupo
     */
    public function getInvGrpInv()
    {
        return $this->invGrpInv;
    }

    /**
     * Set invProInv
     *
     * @param \AppBundle\Entity\InvProveedor $invProInv
     *
     * @return Inventario
     */
    public function setInvProInv(\AppBundle\Entity\InvProveedor $invProInv = null)
    {
        $this->invProInv = $invProInv;

        return $this;
    }

    /**
     * Get invProInv
     *
     * @return \AppBundle\Entity\InvProveedor
     */
    public function getInvProInv()
    {
        return $this->invProInv;
    }

    /**
     * Set invTipPre
     *
     * @param \AppBundle\Entity\InvTipoPresentacion $invTipPre
     *
     * @return Inventario
     */
    public function setInvTipPre(\AppBundle\Entity\InvTipoPresentacion $invTipPre = null)
    {
        $this->invTipPre = $invTipPre;

        return $this;
    }

    /**
     * Get invTipPre
     *
     * @return \AppBundle\Entity\InvTipoPresentacion
     */
    public function getInvTipPre()
    {
        return $this->invTipPre;
    }

    /**
     * Set invUmeInv
     *
     * @param \AppBundle\Entity\InvUnidadMedida $invUmeInv
     *
     * @return Inventario
     */
    public function setInvUmeInv(\AppBundle\Entity\InvUnidadMedida $invUmeInv = null)
    {
        $this->invUmeInv = $invUmeInv;

        return $this;
    }

    /**
     * Get invUmeInv
     *
     * @return \AppBundle\Entity\InvUnidadMedida
     */
    public function getInvUmeInv()
    {
        return $this->invUmeInv;
    }
}

