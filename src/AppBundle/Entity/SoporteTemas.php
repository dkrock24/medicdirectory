<?php

namespace AppBundle\Entity;

/**
 * SoporteTemas
 */
class SoporteTemas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $tema = '';

    /**
     * @var boolean
     */
    private $activo = '0';


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
     * Set tema
     *
     * @param string $tema
     *
     * @return SoporteTemas
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return SoporteTemas
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
