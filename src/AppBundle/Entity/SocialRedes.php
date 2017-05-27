<?php

namespace AppBundle\Entity;

/**
 * SocialRedes
 */
class SocialRedes
{
    /**
     * @var integer
     */
    private $idSocRed;

    /**
     * @var string
     */
    private $socRedNombre = '0';

    /**
     * @var string
     */
    private $socPatron = '0';

    /**
     * @var boolean
     */
    private $socRedActivo = '0';


    /**
     * Get idSocRed
     *
     * @return integer
     */
    public function getIdSocRed()
    {
        return $this->idSocRed;
    }

    /**
     * Set socRedNombre
     *
     * @param string $socRedNombre
     *
     * @return SocialRedes
     */
    public function setSocRedNombre($socRedNombre)
    {
        $this->socRedNombre = $socRedNombre;

        return $this;
    }

    /**
     * Get socRedNombre
     *
     * @return string
     */
    public function getSocRedNombre()
    {
        return $this->socRedNombre;
    }

    /**
     * Set socPatron
     *
     * @param string $socPatron
     *
     * @return SocialRedes
     */
    public function setSocPatron($socPatron)
    {
        $this->socPatron = $socPatron;

        return $this;
    }

    /**
     * Get socPatron
     *
     * @return string
     */
    public function getSocPatron()
    {
        return $this->socPatron;
    }

    /**
     * Set socRedActivo
     *
     * @param boolean $socRedActivo
     *
     * @return SocialRedes
     */
    public function setSocRedActivo($socRedActivo)
    {
        $this->socRedActivo = $socRedActivo;

        return $this;
    }

    /**
     * Get socRedActivo
     *
     * @return boolean
     */
    public function getSocRedActivo()
    {
        return $this->socRedActivo;
    }
}

