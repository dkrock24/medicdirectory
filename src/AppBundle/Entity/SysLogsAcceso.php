<?php

namespace AppBundle\Entity;

/**
 * SysLogsAcceso
 */
class SysLogsAcceso
{
    /**
     * @var integer
     */
    private $idSysLogsAcceso;

    /**
     * @var string
     */
    private $fechaAcceso;

    /**
     * @var string
     */
    private $ipSysLogsAcceso;

    /**
     * @var \AppBundle\Entity\SysUsuario
     */
    private $sysUsuario;


    /**
     * Get idSysLogsAcceso
     *
     * @return integer
     */
    public function getIdSysLogsAcceso()
    {
        return $this->idSysLogsAcceso;
    }

    /**
     * Set fechaAcceso
     *
     * @param string $fechaAcceso
     *
     * @return SysLogsAcceso
     */
    public function setFechaAcceso($fechaAcceso)
    {
        $this->fechaAcceso = $fechaAcceso;

        return $this;
    }

    /**
     * Get fechaAcceso
     *
     * @return string
     */
    public function getFechaAcceso()
    {
        return $this->fechaAcceso;
    }

    /**
     * Set ipSysLogsAcceso
     *
     * @param string $ipSysLogsAcceso
     *
     * @return SysLogsAcceso
     */
    public function setIpSysLogsAcceso($ipSysLogsAcceso)
    {
        $this->ipSysLogsAcceso = $ipSysLogsAcceso;

        return $this;
    }

    /**
     * Get ipSysLogsAcceso
     *
     * @return string
     */
    public function getIpSysLogsAcceso()
    {
        return $this->ipSysLogsAcceso;
    }

    /**
     * Set sysUsuario
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuario
     *
     * @return SysLogsAcceso
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
