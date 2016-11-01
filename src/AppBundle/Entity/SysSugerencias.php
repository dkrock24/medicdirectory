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
    private $esActivoSugerencia;

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
     * Set esActivoSugerencia
     *
     * @param boolean $esActivoSugerencia
     *
     * @return SysSugerencias
     */
    public function setEsActivoSugerencia($esActivoSugerencia)
    {
        $this->esActivoSugerencia = $esActivoSugerencia;

        return $this;
    }

    /**
     * Get esActivoSugerencia
     *
     * @return boolean
     */
    public function getEsActivoSugerencia()
    {
        return $this->esActivoSugerencia;
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
