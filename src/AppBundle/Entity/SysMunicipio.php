<?php

namespace AppBundle\Entity;

/**
 * SysMunicipio
 */
class SysMunicipio
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreSysMunicipo;

    /**
     * @var boolean
     */
    private $esActivoSysMunicipo;

    /**
     * @var string
     */
    private $descripcionSysMunicipio;

    /**
     * @var \AppBundle\Entity\SysDepartamentos
     */
    private $sysDepartamentos;


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
     * Set nombreSysMunicipo
     *
     * @param string $nombreSysMunicipo
     *
     * @return SysMunicipio
     */
    public function setNombreSysMunicipo($nombreSysMunicipo)
    {
        $this->nombreSysMunicipo = $nombreSysMunicipo;

        return $this;
    }

    /**
     * Get nombreSysMunicipo
     *
     * @return string
     */
    public function getNombreSysMunicipo()
    {
        return $this->nombreSysMunicipo;
    }

    /**
     * Set esActivoSysMunicipo
     *
     * @param boolean $esActivoSysMunicipo
     *
     * @return SysMunicipio
     */
    public function setEsActivoSysMunicipo($esActivoSysMunicipo)
    {
        $this->esActivoSysMunicipo = $esActivoSysMunicipo;

        return $this;
    }

    /**
     * Get esActivoSysMunicipo
     *
     * @return boolean
     */
    public function getEsActivoSysMunicipo()
    {
        return $this->esActivoSysMunicipo;
    }

    /**
     * Set descripcionSysMunicipio
     *
     * @param string $descripcionSysMunicipio
     *
     * @return SysMunicipio
     */
    public function setDescripcionSysMunicipio($descripcionSysMunicipio)
    {
        $this->descripcionSysMunicipio = $descripcionSysMunicipio;

        return $this;
    }

    /**
     * Get descripcionSysMunicipio
     *
     * @return string
     */
    public function getDescripcionSysMunicipio()
    {
        return $this->descripcionSysMunicipio;
    }

    /**
     * Set sysDepartamentos
     *
     * @param \AppBundle\Entity\SysDepartamentos $sysDepartamentos
     *
     * @return SysMunicipio
     */
    public function setSysDepartamentos(\AppBundle\Entity\SysDepartamentos $sysDepartamentos = null)
    {
        $this->sysDepartamentos = $sysDepartamentos;

        return $this;
    }

    /**
     * Get sysDepartamentos
     *
     * @return \AppBundle\Entity\SysDepartamentos
     */
    public function getSysDepartamentos()
    {
        return $this->sysDepartamentos;
    }
}
