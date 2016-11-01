<?php

namespace AppBundle\Entity;

/**
 * SysExamenesMedicos
 */
class SysExamenesMedicos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreExamen;

    /**
     * @var string
     */
    private $tipoExamen;

    /**
     * @var integer
     */
    private $estadoExamen;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;


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
     * Set nombreExamen
     *
     * @param string $nombreExamen
     *
     * @return SysExamenesMedicos
     */
    public function setNombreExamen($nombreExamen)
    {
        $this->nombreExamen = $nombreExamen;

        return $this;
    }

    /**
     * Get nombreExamen
     *
     * @return string
     */
    public function getNombreExamen()
    {
        return $this->nombreExamen;
    }

    /**
     * Set tipoExamen
     *
     * @param string $tipoExamen
     *
     * @return SysExamenesMedicos
     */
    public function setTipoExamen($tipoExamen)
    {
        $this->tipoExamen = $tipoExamen;

        return $this;
    }

    /**
     * Get tipoExamen
     *
     * @return string
     */
    public function getTipoExamen()
    {
        return $this->tipoExamen;
    }

    /**
     * Set estadoExamen
     *
     * @param integer $estadoExamen
     *
     * @return SysExamenesMedicos
     */
    public function setEstadoExamen($estadoExamen)
    {
        $this->estadoExamen = $estadoExamen;

        return $this;
    }

    /**
     * Get estadoExamen
     *
     * @return integer
     */
    public function getEstadoExamen()
    {
        return $this->estadoExamen;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysExamenesMedicos
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
}

