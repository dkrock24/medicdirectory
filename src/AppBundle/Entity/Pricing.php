<?php

namespace AppBundle\Entity;

/**
 * Pricing
 */
class Pricing
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $plan;

    /**
     * @var string
     */
    private $mes;

    /**
     * @var string
     */
    private $precio;

    /**
     * @var string
     */
    private $total;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $creado;

    /**
     * @var \DateTime
     */
    private $actualizado;

    /**
     * @var boolean
     */
    private $estado = '1';

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return (boolean)$this->estado;
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set plan.
     *
     * @param string $plan
     *
     * @return Pricing
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan.
     *
     * @return string
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set mes.
     *
     * @param string $mes
     *
     * @return Pricing
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes.
     *
     * @return string
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set precio.
     *
     * @param string $precio
     *
     * @return Pricing
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio.
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set total.
     *
     * @param string $total
     *
     * @return Pricing
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total.
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set descripcion.
     *
     * @param string $descripcion
     *
     * @return Pricing
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set creado.
     *
     * @param \DateTime $creado
     *
     * @return Pricing
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;

        return $this;
    }

    /**
     * Get creado.
     *
     * @return \DateTime
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * Set actualizado.
     *
     * @param \DateTime $actualizado
     *
     * @return Pricing
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado.
     *
     * @return \DateTime
     */
    public function getActualizado()
    {
        return $this->actualizado;
    }
}
