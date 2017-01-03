<?php

namespace AppBundle\Entity;

/**
 * SysSugerencias
 */
class SysSugerencias
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $comentarioSysSugerencia;

    /**
     * @var \DateTime
     */
    private $fechaCreacionSysSugerencia;

    /**
     * @var boolean
     */
    private $estatusSugerencia;

    /**
     * @var \AppBundle\Entity\SysArea
     */
    private $sysArea;

    /**
     * @var \AppBundle\Entity\SysInstitucion
     */
    private $sysInstitucion;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comentarioSysSugerencia
     *
     * @param string $comentarioSysSugerencia
     *
     * @return SysSugerencias
     */
    public function setComentarioSysSugerencia($comentarioSysSugerencia)
    {
        $this->comentarioSysSugerencia = $comentarioSysSugerencia;

        return $this;
    }

    /**
     * Get comentarioSysSugerencia
     *
     * @return string
     */
    public function getComentarioSysSugerencia()
    {
        return $this->comentarioSysSugerencia;
    }

    /**
     * Set fechaCreacionSysSugerencia
     *
     * @param \DateTime $fechaCreacionSysSugerencia
     *
     * @return SysSugerencias
     */
    public function setFechaCreacionSysSugerencia($fechaCreacionSysSugerencia)
    {
        $this->fechaCreacionSysSugerencia = $fechaCreacionSysSugerencia;

        return $this;
    }

    /**
     * Get fechaCreacionSysSugerencia
     *
     * @return \DateTime
     */
    public function getFechaCreacionSysSugerencia()
    {
        return $this->fechaCreacionSysSugerencia;
    }

    /**
     * Set estatusSugerencia
     *
     * @param boolean $estatusSugerencia
     *
     * @return SysSugerencias
     */
    public function setEstatusSugerencia($estatusSugerencia)
    {
        $this->estatusSugerencia = $estatusSugerencia;

        return $this;
    }

    /**
     * Get estatusSugerencia
     *
     * @return boolean
     */
    public function getEstatusSugerencia()
    {
        return $this->estatusSugerencia;
    }

    /**
     * Set sysArea
     *
     * @param \AppBundle\Entity\SysArea $sysArea
     *
     * @return SysSugerencias
     */
    public function setSysArea(\AppBundle\Entity\SysArea $sysArea = null)
    {
        $this->sysArea = $sysArea;

        return $this;
    }

    /**
     * Get sysArea
     *
     * @return \AppBundle\Entity\SysArea
     */
    public function getSysArea()
    {
        return $this->sysArea;
    }

    /**
     * Set sysInstitucion
     *
     * @param \AppBundle\Entity\SysInstitucion $sysInstitucion
     *
     * @return SysSugerencias
     */
    public function setSysInstitucion(\AppBundle\Entity\SysInstitucion $sysInstitucion = null)
    {
        $this->sysInstitucion = $sysInstitucion;

        return $this;
    }

    /**
     * Get sysInstitucion
     *
     * @return \AppBundle\Entity\SysInstitucion
     */
    public function getSysInstitucion()
    {
        return $this->sysInstitucion;
    }
}

