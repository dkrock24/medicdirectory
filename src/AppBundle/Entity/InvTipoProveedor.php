<?php

namespace AppBundle\Entity;

/**
 * InvTipoProveedor
 */
class InvTipoProveedor
{
    /**
     * @var integer
     */
    private $itprId;

    /**
     * @var string
     */
    private $itprTipo;

    /**
     * @var string
     */
    private $itprDescripcion;

    /**
     * @var \DateTime
     */
    private $itprFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $itprFechaMod;

    /**
     * @var boolean
     */
    private $itprActivo = '1';


    /**
     * Get itprId
     *
     * @return integer
     */
    public function getItprId()
    {
        return $this->itprId;
    }

    /**
     * Set itprTipo
     *
     * @param string $itprTipo
     *
     * @return InvTipoProveedor
     */
    public function setItprTipo($itprTipo)
    {
        $this->itprTipo = $itprTipo;

        return $this;
    }

    /**
     * Get itprTipo
     *
     * @return string
     */
    public function getItprTipo()
    {
        return $this->itprTipo;
    }

    /**
     * Set itprDescripcion
     *
     * @param string $itprDescripcion
     *
     * @return InvTipoProveedor
     */
    public function setItprDescripcion($itprDescripcion)
    {
        $this->itprDescripcion = $itprDescripcion;

        return $this;
    }

    /**
     * Get itprDescripcion
     *
     * @return string
     */
    public function getItprDescripcion()
    {
        return $this->itprDescripcion;
    }

    /**
     * Set itprFechaCrea
     *
     * @param \DateTime $itprFechaCrea
     *
     * @return InvTipoProveedor
     */
    public function setItprFechaCrea($itprFechaCrea)
    {
        $this->itprFechaCrea = $itprFechaCrea;

        return $this;
    }

    /**
     * Get itprFechaCrea
     *
     * @return \DateTime
     */
    public function getItprFechaCrea()
    {
        return $this->itprFechaCrea;
    }

    /**
     * Set itprFechaMod
     *
     * @param \DateTime $itprFechaMod
     *
     * @return InvTipoProveedor
     */
    public function setItprFechaMod($itprFechaMod)
    {
        $this->itprFechaMod = $itprFechaMod;

        return $this;
    }

    /**
     * Get itprFechaMod
     *
     * @return \DateTime
     */
    public function getItprFechaMod()
    {
        return $this->itprFechaMod;
    }

    /**
     * Set itprActivo
     *
     * @param boolean $itprActivo
     *
     * @return InvTipoProveedor
     */
    public function setItprActivo($itprActivo)
    {
        $this->itprActivo = $itprActivo;

        return $this;
    }

    /**
     * Get itprActivo
     *
     * @return boolean
     */
    public function getItprActivo()
    {
        return $this->itprActivo;
    }
}

