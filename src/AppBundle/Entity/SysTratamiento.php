<?php

namespace AppBundle\Entity;

/**
 * SysTratamiento
 */
class SysTratamiento
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $via = '0';

    /**
     * @var string
     */
    private $docis = '0';

    /**
     * @var string
     */
    private $preriocidad = '0';

    /**
     * @var integer
     */
    private $idCita = '0';

    /**
     * @var string
     */
    private $tipoTratamiento = '0';


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
     * Set via
     *
     * @param string $via
     *
     * @return SysTratamiento
     */
    public function setVia($via)
    {
        $this->via = $via;

        return $this;
    }

    /**
     * Get via
     *
     * @return string
     */
    public function getVia()
    {
        return $this->via;
    }

    /**
     * Set docis
     *
     * @param string $docis
     *
     * @return SysTratamiento
     */
    public function setDocis($docis)
    {
        $this->docis = $docis;

        return $this;
    }

    /**
     * Get docis
     *
     * @return string
     */
    public function getDocis()
    {
        return $this->docis;
    }

    /**
     * Set preriocidad
     *
     * @param string $preriocidad
     *
     * @return SysTratamiento
     */
    public function setPreriocidad($preriocidad)
    {
        $this->preriocidad = $preriocidad;

        return $this;
    }

    /**
     * Get preriocidad
     *
     * @return string
     */
    public function getPreriocidad()
    {
        return $this->preriocidad;
    }

    /**
     * Set idCita
     *
     * @param integer $idCita
     *
     * @return SysTratamiento
     */
    public function setIdCita($idCita)
    {
        $this->idCita = $idCita;

        return $this;
    }

    /**
     * Get idCita
     *
     * @return integer
     */
    public function getIdCita()
    {
        return $this->idCita;
    }

    /**
     * Set tipoTratamiento
     *
     * @param string $tipoTratamiento
     *
     * @return SysTratamiento
     */
    public function setTipoTratamiento($tipoTratamiento)
    {
        $this->tipoTratamiento = $tipoTratamiento;

        return $this;
    }

    /**
     * Get tipoTratamiento
     *
     * @return string
     */
    public function getTipoTratamiento()
    {
        return $this->tipoTratamiento;
    }
}

