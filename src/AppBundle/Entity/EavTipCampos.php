<?php

namespace AppBundle\Entity;

/**
 * EavTipCampos
 */
class EavTipCampos
{
    /**
     * @var integer
     */
    private $tipCampId;

    /**
     * @var string
     */
    private $tipCampTipo;

    /**
     * @var integer
     */
    private $tipCampActivo = 1;

    /**
     * @var \DateTime
     */
    private $tipCampFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $tipCampFechaMod;


    /**
     * Get tipCampId
     *
     * @return integer
     */
    public function getTipCampId()
    {
        return $this->tipCampId;
    }

    /**
     * Set tipCampTipo
     *
     * @param string $tipCampTipo
     *
     * @return EavTipCampos
     */
    public function setTipCampTipo($tipCampTipo)
    {
        $this->tipCampTipo = $tipCampTipo;

        return $this;
    }

    /**
     * Get tipCampTipo
     *
     * @return string
     */
    public function getTipCampTipo()
    {
        return $this->tipCampTipo;
    }

    /**
     * Set tipCampActivo
     *
     * @param integer $tipCampActivo
     *
     * @return EavTipCampos
     */
    public function setTipCampActivo($tipCampActivo)
    {
        $this->tipCampActivo = $tipCampActivo;

        return $this;
    }

    /**
     * Get tipCampActivo
     *
     * @return integer
     */
    public function getTipCampActivo()
    {
        return $this->tipCampActivo;
    }

    /**
     * Set tipCampFechaCrea
     *
     * @param \DateTime $tipCampFechaCrea
     *
     * @return EavTipCampos
     */
    public function setTipCampFechaCrea($tipCampFechaCrea)
    {
        $this->tipCampFechaCrea = $tipCampFechaCrea;

        return $this;
    }

    /**
     * Get tipCampFechaCrea
     *
     * @return \DateTime
     */
    public function getTipCampFechaCrea()
    {
        return $this->tipCampFechaCrea;
    }

    /**
     * Set tipCampFechaMod
     *
     * @param \DateTime $tipCampFechaMod
     *
     * @return EavTipCampos
     */
    public function setTipCampFechaMod($tipCampFechaMod)
    {
        $this->tipCampFechaMod = $tipCampFechaMod;

        return $this;
    }

    /**
     * Get tipCampFechaMod
     *
     * @return \DateTime
     */
    public function getTipCampFechaMod()
    {
        return $this->tipCampFechaMod;
    }
}
