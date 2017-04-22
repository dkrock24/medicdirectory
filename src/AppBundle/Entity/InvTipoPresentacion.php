<?php

namespace AppBundle\Entity;

/**
 * InvTipoPresentacion
 */
class InvTipoPresentacion
{
    /**
     * @var integer
     */
    private $itpId;

    /**
     * @var string
     */
    private $itpTipo;

    /**
     * @var string
     */
    private $itpDescripcion;

    /**
     * @var \DateTime
     */
    private $itpFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $itpFechaMod;

    /**
     * @var boolean
     */
    private $itpActivo = '1';


    /**
     * Get itpId
     *
     * @return integer
     */
    public function getItpId()
    {
        return $this->itpId;
    }

    /**
     * Set itpTipo
     *
     * @param string $itpTipo
     *
     * @return InvTipoPresentacion
     */
    public function setItpTipo($itpTipo)
    {
        $this->itpTipo = $itpTipo;

        return $this;
    }

    /**
     * Get itpTipo
     *
     * @return string
     */
    public function getItpTipo()
    {
        return $this->itpTipo;
    }

    /**
     * Set itpDescripcion
     *
     * @param string $itpDescripcion
     *
     * @return InvTipoPresentacion
     */
    public function setItpDescripcion($itpDescripcion)
    {
        $this->itpDescripcion = $itpDescripcion;

        return $this;
    }

    /**
     * Get itpDescripcion
     *
     * @return string
     */
    public function getItpDescripcion()
    {
        return $this->itpDescripcion;
    }

    /**
     * Set itpFechaCrea
     *
     * @param \DateTime $itpFechaCrea
     *
     * @return InvTipoPresentacion
     */
    public function setItpFechaCrea($itpFechaCrea)
    {
        $this->itpFechaCrea = $itpFechaCrea;

        return $this;
    }

    /**
     * Get itpFechaCrea
     *
     * @return \DateTime
     */
    public function getItpFechaCrea()
    {
        return $this->itpFechaCrea;
    }

    /**
     * Set itpFechaMod
     *
     * @param \DateTime $itpFechaMod
     *
     * @return InvTipoPresentacion
     */
    public function setItpFechaMod($itpFechaMod)
    {
        $this->itpFechaMod = $itpFechaMod;

        return $this;
    }

    /**
     * Get itpFechaMod
     *
     * @return \DateTime
     */
    public function getItpFechaMod()
    {
        return $this->itpFechaMod;
    }

    /**
     * Set itpActivo
     *
     * @param boolean $itpActivo
     *
     * @return InvTipoPresentacion
     */
    public function setItpActivo($itpActivo)
    {
        $this->itpActivo = $itpActivo;

        return $this;
    }

    /**
     * Get itpActivo
     *
     * @return boolean
     */
    public function getItpActivo()
    {
        return $this->itpActivo;
    }
    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $itpCli;


    /**
     * Set itpCli
     *
     * @param \AppBundle\Entity\Cliente $itpCli
     *
     * @return InvTipoPresentacion
     */
    public function setItpCli(\AppBundle\Entity\Cliente $itpCli = null)
    {
        $this->itpCli = $itpCli;

        return $this;
    }

    /**
     * Get itpCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getItpCli()
    {
        return $this->itpCli;
    }

    public function __toString() {
        return $this->itpTipo;
    }
}
