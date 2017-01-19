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
    private $estatusSysRoles;

    /**
     * @var \DateTime
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
     * Set estatusSysRoles
     *
     * @param boolean $estatusSysRoles
     *
     * @return SysRoles
     */
    public function setEstatusSysRoles($estatusSysRoles)
    {
        $this->estatusSysRoles = $estatusSysRoles;

        return $this;
    }

    /**
     * Get estatusSysRoles
     *
     * @return boolean
     */
    public function getEstatusSysRoles()
    {
        return $this->estatusSysRoles;
    }

    /**
     * Set fechaCreacionSysRoles
     *
     * @param \DateTime $fechaCreacionSysRoles
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
     * @return \DateTime
     */
    public function getFechaCreacionSysRoles()
    {
        return $this->fechaCreacionSysRoles;
    }
}
