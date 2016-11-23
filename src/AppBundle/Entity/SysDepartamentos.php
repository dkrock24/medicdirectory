<?php

namespace AppBundle\Entity;

/**
 * SysDepartamentos
 */
class SysDepartamentos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreSysDepartamento;

    /**
     * @var string
     */
    private $codigoZonaSysDepartamento;

    /**
     * @var string
     */
    private $descripcionSysDepartamento;

    /**
     * @var string
     */
    private $prefijoSysDepartamento;

    /**
     * @var boolean
     */
    private $estatusSysDepartamento;

    /**
     * @var \AppBundle\Entity\SysPais
     */
    private $pais;


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
     * Set nombreSysDepartamento
     *
     * @param string $nombreSysDepartamento
     *
     * @return SysDepartamentos
     */
    public function setNombreSysDepartamento($nombreSysDepartamento)
    {
        $this->nombreSysDepartamento = $nombreSysDepartamento;

        return $this;
    }

    /**
     * Get nombreSysDepartamento
     *
     * @return string
     */
    public function getNombreSysDepartamento()
    {
        return $this->nombreSysDepartamento;
    }

    /**
     * Set codigoZonaSysDepartamento
     *
     * @param string $codigoZonaSysDepartamento
     *
     * @return SysDepartamentos
     */
    public function setCodigoZonaSysDepartamento($codigoZonaSysDepartamento)
    {
        $this->codigoZonaSysDepartamento = $codigoZonaSysDepartamento;

        return $this;
    }

    /**
     * Get codigoZonaSysDepartamento
     *
     * @return string
     */
    public function getCodigoZonaSysDepartamento()
    {
        return $this->codigoZonaSysDepartamento;
    }

    /**
     * Set descripcionSysDepartamento
     *
     * @param string $descripcionSysDepartamento
     *
     * @return SysDepartamentos
     */
    public function setDescripcionSysDepartamento($descripcionSysDepartamento)
    {
        $this->descripcionSysDepartamento = $descripcionSysDepartamento;

        return $this;
    }

    /**
     * Get descripcionSysDepartamento
     *
     * @return string
     */
    public function getDescripcionSysDepartamento()
    {
        return $this->descripcionSysDepartamento;
    }

    /**
     * Set prefijoSysDepartamento
     *
     * @param string $prefijoSysDepartamento
     *
     * @return SysDepartamentos
     */
    public function setPrefijoSysDepartamento($prefijoSysDepartamento)
    {
        $this->prefijoSysDepartamento = $prefijoSysDepartamento;

        return $this;
    }

    /**
     * Get prefijoSysDepartamento
     *
     * @return string
     */
    public function getPrefijoSysDepartamento()
    {
        return $this->prefijoSysDepartamento;
    }

    /**
     * Set estatusSysDepartamento
     *
     * @param boolean $estatusSysDepartamento
     *
     * @return SysDepartamentos
     */
    public function setEstatusSysDepartamento($estatusSysDepartamento)
    {
        $this->estatusSysDepartamento = $estatusSysDepartamento;

        return $this;
    }

    /**
     * Get estatusSysDepartamento
     *
     * @return boolean
     */
    public function getEstatusSysDepartamento()
    {
        return $this->estatusSysDepartamento;
    }

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\SysPais $pais
     *
     * @return SysDepartamentos
     */
    public function setPais(\AppBundle\Entity\SysPais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\SysPais
     */
    public function getPais()
    {
        return $this->pais;
    }
	
	public function __toString()
    {
        return $this->nombreSysDepartamento;
    }
}

