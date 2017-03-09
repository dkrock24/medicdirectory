<?php

namespace AppBundle\Entity;

/**
 * LogsAuditoria
 */
class LogsAuditoria
{
    /**
     * @var integer
     */
    private $logId;

    /**
     * @var string
     */
    private $logAccion;

    /**
     * @var string
     */
    private $logTabla;

    /**
     * @var string
     */
    private $logCampo;

    /**
     * @var string
     */
    private $logValorPrevio;

    /**
     * @var string
     */
    private $logValorNuevo;

    /**
     * @var \DateTime
     */
    private $logFechaEjecucion = 'CURRENT_TIMESTAMP';

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $logUsuAccion;


    /**
     * Get logId
     *
     * @return integer
     */
    public function getLogId()
    {
        return $this->logId;
    }

    /**
     * Set logAccion
     *
     * @param string $logAccion
     *
     * @return LogsAuditoria
     */
    public function setLogAccion($logAccion)
    {
        $this->logAccion = $logAccion;

        return $this;
    }

    /**
     * Get logAccion
     *
     * @return string
     */
    public function getLogAccion()
    {
        return $this->logAccion;
    }

    /**
     * Set logTabla
     *
     * @param string $logTabla
     *
     * @return LogsAuditoria
     */
    public function setLogTabla($logTabla)
    {
        $this->logTabla = $logTabla;

        return $this;
    }

    /**
     * Get logTabla
     *
     * @return string
     */
    public function getLogTabla()
    {
        return $this->logTabla;
    }

    /**
     * Set logCampo
     *
     * @param string $logCampo
     *
     * @return LogsAuditoria
     */
    public function setLogCampo($logCampo)
    {
        $this->logCampo = $logCampo;

        return $this;
    }

    /**
     * Get logCampo
     *
     * @return string
     */
    public function getLogCampo()
    {
        return $this->logCampo;
    }

    /**
     * Set logValorPrevio
     *
     * @param string $logValorPrevio
     *
     * @return LogsAuditoria
     */
    public function setLogValorPrevio($logValorPrevio)
    {
        $this->logValorPrevio = $logValorPrevio;

        return $this;
    }

    /**
     * Get logValorPrevio
     *
     * @return string
     */
    public function getLogValorPrevio()
    {
        return $this->logValorPrevio;
    }

    /**
     * Set logValorNuevo
     *
     * @param string $logValorNuevo
     *
     * @return LogsAuditoria
     */
    public function setLogValorNuevo($logValorNuevo)
    {
        $this->logValorNuevo = $logValorNuevo;

        return $this;
    }

    /**
     * Get logValorNuevo
     *
     * @return string
     */
    public function getLogValorNuevo()
    {
        return $this->logValorNuevo;
    }

    /**
     * Set logFechaEjecucion
     *
     * @param \DateTime $logFechaEjecucion
     *
     * @return LogsAuditoria
     */
    public function setLogFechaEjecucion($logFechaEjecucion)
    {
        $this->logFechaEjecucion = $logFechaEjecucion;

        return $this;
    }

    /**
     * Get logFechaEjecucion
     *
     * @return \DateTime
     */
    public function getLogFechaEjecucion()
    {
        return $this->logFechaEjecucion;
    }

    /**
     * Set logUsuAccion
     *
     * @param \AppBundle\Entity\Usuario $logUsuAccion
     *
     * @return LogsAuditoria
     */
    public function setLogUsuAccion(\AppBundle\Entity\Usuario $logUsuAccion = null)
    {
        $this->logUsuAccion = $logUsuAccion;

        return $this;
    }

    /**
     * Get logUsuAccion
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getLogUsuAccion()
    {
        return $this->logUsuAccion;
    }
}

