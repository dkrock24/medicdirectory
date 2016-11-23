<?php

namespace AppBundle\Entity;

/**
 * SysPais
 */
class SysPais
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreSysPais;

    /**
     * @var string
     */
    private $prefijoSysPais;

    /**
     * @var integer
     */
    private $codigoPostalSysPais;

    /**
     * @var string
     */
    private $continentePaisSysPais;

    /**
     * @var boolean
     */
    private $estatusSysPais;


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
     * Set nombreSysPais
     *
     * @param string $nombreSysPais
     *
     * @return SysPais
     */
    public function setNombreSysPais($nombreSysPais)
    {
        $this->nombreSysPais = $nombreSysPais;

        return $this;
    }

    /**
     * Get nombreSysPais
     *
     * @return string
     */
    public function getNombreSysPais()
    {
        return $this->nombreSysPais;
    }

    /**
     * Set prefijoSysPais
     *
     * @param string $prefijoSysPais
     *
     * @return SysPais
     */
    public function setPrefijoSysPais($prefijoSysPais)
    {
        $this->prefijoSysPais = $prefijoSysPais;

        return $this;
    }

    /**
     * Get prefijoSysPais
     *
     * @return string
     */
    public function getPrefijoSysPais()
    {
        return $this->prefijoSysPais;
    }

    /**
     * Set codigoPostalSysPais
     *
     * @param integer $codigoPostalSysPais
     *
     * @return SysPais
     */
    public function setCodigoPostalSysPais($codigoPostalSysPais)
    {
        $this->codigoPostalSysPais = $codigoPostalSysPais;

        return $this;
    }

    /**
     * Get codigoPostalSysPais
     *
     * @return integer
     */
    public function getCodigoPostalSysPais()
    {
        return $this->codigoPostalSysPais;
    }

    /**
     * Set continentePaisSysPais
     *
     * @param string $continentePaisSysPais
     *
     * @return SysPais
     */
    public function setContinentePaisSysPais($continentePaisSysPais)
    {
        $this->continentePaisSysPais = $continentePaisSysPais;

        return $this;
    }

    /**
     * Get continentePaisSysPais
     *
     * @return string
     */
    public function getContinentePaisSysPais()
    {
        return $this->continentePaisSysPais;
    }

    /**
     * Set estatusSysPais
     *
     * @param boolean $estatusSysPais
     *
     * @return SysPais
     */
    public function setEstatusSysPais($estatusSysPais)
    {
        $this->estatusSysPais = $estatusSysPais;

        return $this;
    }

    /**
     * Get estatusSysPais
     *
     * @return boolean
     */
    public function getEstatusSysPais()
    {
        return $this->estatusSysPais;
    }
	
	public function __toString()
    {
        return $this->nombreSysPais;
    }
}

