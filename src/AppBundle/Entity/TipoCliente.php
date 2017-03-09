<?php

namespace AppBundle\Entity;

/**
 * TipoCliente
 */
class TipoCliente
{
    /**
     * @var integer
     */
    private $tipCliId;

    /**
     * @var string
     */
    private $tipCliTipo;

    /**
     * @var \DateTime
     */
    private $tipCliFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $tipCliFechaMod;

    /**
     * @var boolean
     */
    private $tipCliActivo = '1';


    /**
     * Get tipCliId
     *
     * @return integer
     */
    public function getTipCliId()
    {
        return $this->tipCliId;
    }

    /**
     * Set tipCliTipo
     *
     * @param string $tipCliTipo
     *
     * @return TipoCliente
     */
    public function setTipCliTipo($tipCliTipo)
    {
        $this->tipCliTipo = $tipCliTipo;

        return $this;
    }

    /**
     * Get tipCliTipo
     *
     * @return string
     */
    public function getTipCliTipo()
    {
        return $this->tipCliTipo;
    }

    /**
     * Set tipCliFechaCrea
     *
     * @param \DateTime $tipCliFechaCrea
     *
     * @return TipoCliente
     */
    public function setTipCliFechaCrea($tipCliFechaCrea)
    {
        $this->tipCliFechaCrea = $tipCliFechaCrea;

        return $this;
    }

    /**
     * Get tipCliFechaCrea
     *
     * @return \DateTime
     */
    public function getTipCliFechaCrea()
    {
        return $this->tipCliFechaCrea;
    }

    /**
     * Set tipCliFechaMod
     *
     * @param \DateTime $tipCliFechaMod
     *
     * @return TipoCliente
     */
    public function setTipCliFechaMod($tipCliFechaMod)
    {
        $this->tipCliFechaMod = $tipCliFechaMod;

        return $this;
    }

    /**
     * Get tipCliFechaMod
     *
     * @return \DateTime
     */
    public function getTipCliFechaMod()
    {
        return $this->tipCliFechaMod;
    }

    /**
     * Set tipCliActivo
     *
     * @param boolean $tipCliActivo
     *
     * @return TipoCliente
     */
    public function setTipCliActivo($tipCliActivo)
    {
        $this->tipCliActivo = $tipCliActivo;

        return $this;
    }

    /**
     * Get tipCliActivo
     *
     * @return boolean
     */
    public function getTipCliActivo()
    {
        return $this->tipCliActivo;
    }
}

