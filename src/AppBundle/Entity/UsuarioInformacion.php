<?php

namespace AppBundle\Entity;

/**
 * UsuarioInformacion
 */
class UsuarioInformacion
{
    /**
     * @var integer
     */
    private $usiId;

    /**
     * @var string
     */
    private $usiDireccion;

    /**
     * @var string
     */
    private $usiTelefono;

    /**
     * @var string
     */
    private $usiDescripcion;


    /**
     * Get usiId
     *
     * @return integer
     */
    public function getUsiId()
    {
        return $this->usiId;
    }

    /**
     * Set usiDireccion
     *
     * @param string $usiDireccion
     *
     * @return UsuarioInformacion
     */
    public function setUsiDireccion($usiDireccion)
    {
        $this->usiDireccion = $usiDireccion;

        return $this;
    }

    /**
     * Get usiDireccion
     *
     * @return string
     */
    public function getUsiDireccion()
    {
        return $this->usiDireccion;
    }

    /**
     * Set usiTelefono
     *
     * @param string $usiTelefono
     *
     * @return UsuarioInformacion
     */
    public function setUsiTelefono($usiTelefono)
    {
        $this->usiTelefono = $usiTelefono;

        return $this;
    }

    /**
     * Get usiTelefono
     *
     * @return string
     */
    public function getUsiTelefono()
    {
        return $this->usiTelefono;
    }

    /**
     * Set usiDescripcion
     *
     * @param string $usiDescripcion
     *
     * @return UsuarioInformacion
     */
    public function setUsiDescripcion($usiDescripcion)
    {
        $this->usiDescripcion = $usiDescripcion;

        return $this;
    }

    /**
     * Get usiDescripcion
     *
     * @return string
     */
    public function getUsiDescripcion()
    {
        return $this->usiDescripcion;
    }
}
