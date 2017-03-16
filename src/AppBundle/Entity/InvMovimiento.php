<?php

namespace AppBundle\Entity;

/**
 * InvMovimiento
 */
class InvMovimiento
{
    /**
     * @var integer
     */
    private $imoId;

    /**
     * @var string
     */
    private $imoValor;

    /**
     * @var string
     */
    private $imoDescripcion;

    /**
     * @var \DateTime
     */
    private $imoFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $imoFechaMod;

    /**
     * @var boolean
     */
    private $imoActivo = '1';

    /**
     * @var \AppBundle\Entity\Inventario
     */
    private $imoInv;

    /**
     * @var \AppBundle\Entity\InvTipoMovimiento
     */
    private $imoItm;


    /**
     * Get imoId
     *
     * @return integer
     */
    public function getImoId()
    {
        return $this->imoId;
    }

    /**
     * Set imoValor
     *
     * @param string $imoValor
     *
     * @return InvMovimiento
     */
    public function setImoValor($imoValor)
    {
        $this->imoValor = $imoValor;

        return $this;
    }

    /**
     * Get imoValor
     *
     * @return string
     */
    public function getImoValor()
    {
        return $this->imoValor;
    }

    /**
     * Set imoDescripcion
     *
     * @param string $imoDescripcion
     *
     * @return InvMovimiento
     */
    public function setImoDescripcion($imoDescripcion)
    {
        $this->imoDescripcion = $imoDescripcion;

        return $this;
    }

    /**
     * Get imoDescripcion
     *
     * @return string
     */
    public function getImoDescripcion()
    {
        return $this->imoDescripcion;
    }

    /**
     * Set imoFechaCrea
     *
     * @param \DateTime $imoFechaCrea
     *
     * @return InvMovimiento
     */
    public function setImoFechaCrea($imoFechaCrea)
    {
        $this->imoFechaCrea = $imoFechaCrea;

        return $this;
    }

    /**
     * Get imoFechaCrea
     *
     * @return \DateTime
     */
    public function getImoFechaCrea()
    {
        return $this->imoFechaCrea;
    }

    /**
     * Set imoFechaMod
     *
     * @param \DateTime $imoFechaMod
     *
     * @return InvMovimiento
     */
    public function setImoFechaMod($imoFechaMod)
    {
        $this->imoFechaMod = $imoFechaMod;

        return $this;
    }

    /**
     * Get imoFechaMod
     *
     * @return \DateTime
     */
    public function getImoFechaMod()
    {
        return $this->imoFechaMod;
    }

    /**
     * Set imoActivo
     *
     * @param boolean $imoActivo
     *
     * @return InvMovimiento
     */
    public function setImoActivo($imoActivo)
    {
        $this->imoActivo = $imoActivo;

        return $this;
    }

    /**
     * Get imoActivo
     *
     * @return boolean
     */
    public function getImoActivo()
    {
        return $this->imoActivo;
    }

    /**
     * Set imoInv
     *
     * @param \AppBundle\Entity\Inventario $imoInv
     *
     * @return InvMovimiento
     */
    public function setImoInv(\AppBundle\Entity\Inventario $imoInv = null)
    {
        $this->imoInv = $imoInv;

        return $this;
    }

    /**
     * Get imoInv
     *
     * @return \AppBundle\Entity\Inventario
     */
    public function getImoInv()
    {
        return $this->imoInv;
    }

    /**
     * Set imoItm
     *
     * @param \AppBundle\Entity\InvTipoMovimiento $imoItm
     *
     * @return InvMovimiento
     */
    public function setImoItm(\AppBundle\Entity\InvTipoMovimiento $imoItm = null)
    {
        $this->imoItm = $imoItm;

        return $this;
    }

    /**
     * Get imoItm
     *
     * @return \AppBundle\Entity\InvTipoMovimiento
     */
    public function getImoItm()
    {
        return $this->imoItm;
    }
}
