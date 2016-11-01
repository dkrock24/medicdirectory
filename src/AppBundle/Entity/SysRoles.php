<?php

namespace AppBundle\Entity;

/**
 * SysRoles
 */
class SysRoles
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreRolSysRoles;

    /**
     * @var boolean
     */
    private $esActivoSysRoles;

    /**
     * @var string
     */
    private $fechaCreacionSysRoles;


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
     * Set nombreRolSysRoles
     *
     * @param string $nombreRolSysRoles
     *
     * @return SysRoles
     */
    public function setNombreRolSysRoles($nombreRolSysRoles)
    {
        $this->nombreRolSysRoles = $nombreRolSysRoles;

        return $this;
    }

    /**
     * Get nombreRolSysRoles
     *
     * @return string
     */
    public function getNombreRolSysRoles()
    {
        return $this->nombreRolSysRoles;
    }

    /**
     * Set esActivoSysRoles
     *
     * @param boolean $esActivoSysRoles
     *
     * @return SysRoles
     */
    public function setEsActivoSysRoles($esActivoSysRoles)
    {
        $this->esActivoSysRoles = $esActivoSysRoles;

        return $this;
    }

    /**
     * Get esActivoSysRoles
     *
     * @return boolean
     */
    public function getEsActivoSysRoles()
    {
        return $this->esActivoSysRoles;
    }

    /**
     * Set fechaCreacionSysRoles
     *
     * @param string $fechaCreacionSysRoles
     *
     * @return SysRoles
     */
    public function setFechaCreacionSysRoles($fechaCreacionSysRoles)
    {
        $this->fechaCreacionSysRoles = $fechaCreacionSysRoles;

        return $this;
    }

    /**
     * Get fechaCreacionSysRoles
     *
     * @return string
     */
    public function getFechaCreacionSysRoles()
    {
        return $this->fechaCreacionSysRoles;
    }
}
