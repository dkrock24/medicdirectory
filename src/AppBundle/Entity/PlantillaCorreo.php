<?php

namespace AppBundle\Entity;

/**
 * PlantillaCorreo
 */
class PlantillaCorreo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $plantilla;

    /**
     * @var bool
     */
    private $activo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PlantillaCorreo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set plantilla
     *
     * @param string $plantilla
     *
     * @return PlantillaCorreo
     */
    public function setPlantilla($plantilla)
    {
        $this->plantilla = $plantilla;

        return $this;
    }

    /**
     * Get plantilla
     *
     * @return string
     */
    public function getPlantilla()
    {
        return $this->plantilla;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return PlantillaCorreo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return bool
     */
    public function getActivo()
    {
        return $this->activo;
    }
    /**
     * @var string
     */
    private $asunto;


    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return PlantillaCorreo
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }
}
