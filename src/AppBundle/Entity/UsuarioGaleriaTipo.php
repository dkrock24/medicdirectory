<?php

namespace AppBundle\Entity;

/**
 * UsuarioGaleriaTipo
 */
class UsuarioGaleriaTipo
{
    /**
     * @var integer
     */
    private $usuGalTipId;

    /**
     * @var string
     */
    private $usuGalTipNombre = '0';

    /**
     * @var boolean
     */
    private $usuGalTipActivo = '0';


    /**
     * Get usuGalTipId
     *
     * @return integer
     */
    public function getUsuGalTipId()
    {
        return $this->usuGalTipId;
    }

    /**
     * Set usuGalTipNombre
     *
     * @param string $usuGalTipNombre
     *
     * @return UsuarioGaleriaTipo
     */
    public function setUsuGalTipNombre($usuGalTipNombre)
    {
        $this->usuGalTipNombre = $usuGalTipNombre;

        return $this;
    }

    /**
     * Get usuGalTipNombre
     *
     * @return string
     */
    public function getUsuGalTipNombre()
    {
        return $this->usuGalTipNombre;
    }

    /**
     * Set usuGalTipActivo
     *
     * @param boolean $usuGalTipActivo
     *
     * @return UsuarioGaleriaTipo
     */
    public function setUsuGalTipActivo($usuGalTipActivo)
    {
        $this->usuGalTipActivo = $usuGalTipActivo;

        return $this;
    }

    /**
     * Get usuGalTipActivo
     *
     * @return boolean
     */
    public function getUsuGalTipActivo()
    {
        return $this->usuGalTipActivo;
    }
}
