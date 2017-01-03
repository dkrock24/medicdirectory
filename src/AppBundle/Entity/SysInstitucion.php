<?php

namespace AppBundle\Entity;

/**
 * SysInstitucion
 */
class SysInstitucion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreSysInstitucion;

    /**
     * @var string
     */
    private $direccionSysInstitucion;

    /**
     * @var string
     */
    private $latitudSysInstitucion;

    /**
     * @var string
     */
    private $longitudSysInstitucion;

    /**
     * @var string
     */
    private $prefijoSysInstitucion;

    /**
     * @var string
     */
    private $telefono1SysInstitucion;

    /**
     * @var string
     */
    private $telefono2SysInstitucion;

    /**
     * @var \AppBundle\Entity\SysTipoInstitucion
     */
    private $sysTipoInstitucion;

    /**
     * @var \AppBundle\Entity\SysMunicipio
     */
    private $sysMunicipio;

    /**
     * @var \AppBundle\Entity\SysUsuario
     */
    private $sysUsuario;


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
     * Set nombreSysInstitucion
     *
     * @param string $nombreSysInstitucion
     *
     * @return SysInstitucion
     */
    public function setNombreSysInstitucion($nombreSysInstitucion)
    {
        $this->nombreSysInstitucion = $nombreSysInstitucion;

        return $this;
    }

    /**
     * Get nombreSysInstitucion
     *
     * @return string
     */
    public function getNombreSysInstitucion()
    {
        return $this->nombreSysInstitucion;
    }

    /**
     * Set direccionSysInstitucion
     *
     * @param string $direccionSysInstitucion
     *
     * @return SysInstitucion
     */
    public function setDireccionSysInstitucion($direccionSysInstitucion)
    {
        $this->direccionSysInstitucion = $direccionSysInstitucion;

        return $this;
    }

    /**
     * Get direccionSysInstitucion
     *
     * @return string
     */
    public function getDireccionSysInstitucion()
    {
        return $this->direccionSysInstitucion;
    }

    /**
     * Set latitudSysInstitucion
     *
     * @param string $latitudSysInstitucion
     *
     * @return SysInstitucion
     */
    public function setLatitudSysInstitucion($latitudSysInstitucion)
    {
        $this->latitudSysInstitucion = $latitudSysInstitucion;

        return $this;
    }

    /**
     * Get latitudSysInstitucion
     *
     * @return string
     */
    public function getLatitudSysInstitucion()
    {
        return $this->latitudSysInstitucion;
    }

    /**
     * Set longitudSysInstitucion
     *
     * @param string $longitudSysInstitucion
     *
     * @return SysInstitucion
     */
    public function setLongitudSysInstitucion($longitudSysInstitucion)
    {
        $this->longitudSysInstitucion = $longitudSysInstitucion;

        return $this;
    }

    /**
     * Get longitudSysInstitucion
     *
     * @return string
     */
    public function getLongitudSysInstitucion()
    {
        return $this->longitudSysInstitucion;
    }

    /**
     * Set prefijoSysInstitucion
     *
     * @param string $prefijoSysInstitucion
     *
     * @return SysInstitucion
     */
    public function setPrefijoSysInstitucion($prefijoSysInstitucion)
    {
        $this->prefijoSysInstitucion = $prefijoSysInstitucion;

        return $this;
    }

    /**
     * Get prefijoSysInstitucion
     *
     * @return string
     */
    public function getPrefijoSysInstitucion()
    {
        return $this->prefijoSysInstitucion;
    }

    /**
     * Set telefono1SysInstitucion
     *
     * @param string $telefono1SysInstitucion
     *
     * @return SysInstitucion
     */
    public function setTelefono1SysInstitucion($telefono1SysInstitucion)
    {
        $this->telefono1SysInstitucion = $telefono1SysInstitucion;

        return $this;
    }

    /**
     * Get telefono1SysInstitucion
     *
     * @return string
     */
    public function getTelefono1SysInstitucion()
    {
        return $this->telefono1SysInstitucion;
    }

    /**
     * Set telefono2SysInstitucion
     *
     * @param string $telefono2SysInstitucion
     *
     * @return SysInstitucion
     */
    public function setTelefono2SysInstitucion($telefono2SysInstitucion)
    {
        $this->telefono2SysInstitucion = $telefono2SysInstitucion;

        return $this;
    }

    /**
     * Get telefono2SysInstitucion
     *
     * @return string
     */
    public function getTelefono2SysInstitucion()
    {
        return $this->telefono2SysInstitucion;
    }

    /**
     * Set sysTipoInstitucion
     *
     * @param \AppBundle\Entity\SysTipoInstitucion $sysTipoInstitucion
     *
     * @return SysInstitucion
     */
    public function setSysTipoInstitucion(\AppBundle\Entity\SysTipoInstitucion $sysTipoInstitucion = null)
    {
        $this->sysTipoInstitucion = $sysTipoInstitucion;

        return $this;
    }

    /**
     * Get sysTipoInstitucion
     *
     * @return \AppBundle\Entity\SysTipoInstitucion
     */
    public function getSysTipoInstitucion()
    {
        return $this->sysTipoInstitucion;
    }

    /**
     * Set sysMunicipio
     *
     * @param \AppBundle\Entity\SysMunicipio $sysMunicipio
     *
     * @return SysInstitucion
     */
    public function setSysMunicipio(\AppBundle\Entity\SysMunicipio $sysMunicipio = null)
    {
        $this->sysMunicipio = $sysMunicipio;

        return $this;
    }

    /**
     * Get sysMunicipio
     *
     * @return \AppBundle\Entity\SysMunicipio
     */
    public function getSysMunicipio()
    {
        return $this->sysMunicipio;
    }

    /**
     * Set sysUsuario
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuario
     *
     * @return SysInstitucion
     */
    public function setSysUsuario(\AppBundle\Entity\SysUsuario $sysUsuario = null)
    {
        $this->sysUsuario = $sysUsuario;

        return $this;
    }

    /**
     * Get sysUsuario
     *
     * @return \AppBundle\Entity\SysUsuario
     */
    public function getSysUsuario()
    {
        return $this->sysUsuario;
    }
}

