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
    /**
     * @var integer
     */
    private $usiUsuId;

    /**
     * @var string
     */
    private $usiInfoPerfil;

    /**
     * @var string
     */
    private $usiFb;

    /**
     * @var string
     */
    private $usiTwitter;

    /**
     * @var string
     */
    private $usiCorreo;

    /**
     * @var string
     */
    private $usiDiasTrabajo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $infoUsuarios;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->infoUsuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set usiUsuId
     *
     * @param integer $usiUsuId
     *
     * @return UsuarioInformacion
     */
    public function setUsiUsuId($usiUsuId)
    {
        $this->usiUsuId = $usiUsuId;

        return $this;
    }

    /**
     * Get usiUsuId
     *
     * @return integer
     */
    public function getUsiUsuId()
    {
        return $this->usiUsuId;
    }

    /**
     * Set usiInfoPerfil
     *
     * @param string $usiInfoPerfil
     *
     * @return UsuarioInformacion
     */
    public function setUsiInfoPerfil($usiInfoPerfil)
    {
        $this->usiInfoPerfil = $usiInfoPerfil;

        return $this;
    }

    /**
     * Get usiInfoPerfil
     *
     * @return string
     */
    public function getUsiInfoPerfil()
    {
        return $this->usiInfoPerfil;
    }

    /**
     * Set usiFb
     *
     * @param string $usiFb
     *
     * @return UsuarioInformacion
     */
    public function setUsiFb($usiFb)
    {
        $this->usiFb = $usiFb;

        return $this;
    }

    /**
     * Get usiFb
     *
     * @return string
     */
    public function getUsiFb()
    {
        return $this->usiFb;
    }

    /**
     * Set usiTwitter
     *
     * @param string $usiTwitter
     *
     * @return UsuarioInformacion
     */
    public function setUsiTwitter($usiTwitter)
    {
        $this->usiTwitter = $usiTwitter;

        return $this;
    }

    /**
     * Get usiTwitter
     *
     * @return string
     */
    public function getUsiTwitter()
    {
        return $this->usiTwitter;
    }

    /**
     * Set usiCorreo
     *
     * @param string $usiCorreo
     *
     * @return UsuarioInformacion
     */
    public function setUsiCorreo($usiCorreo)
    {
        $this->usiCorreo = $usiCorreo;

        return $this;
    }

    /**
     * Get usiCorreo
     *
     * @return string
     */
    public function getUsiCorreo()
    {
        return $this->usiCorreo;
    }

    /**
     * Set usiDiasTrabajo
     *
     * @param string $usiDiasTrabajo
     *
     * @return UsuarioInformacion
     */
    public function setUsiDiasTrabajo($usiDiasTrabajo)
    {
        $this->usiDiasTrabajo = $usiDiasTrabajo;

        return $this;
    }

    /**
     * Get usiDiasTrabajo
     *
     * @return string
     */
    public function getUsiDiasTrabajo()
    {
        return $this->usiDiasTrabajo;
    }

    /**
     * Add infoUsuario
     *
     * @param \AppBundle\Entity\Usuario $infoUsuario
     *
     * @return UsuarioInformacion
     */
    public function addInfoUsuario(\AppBundle\Entity\Usuario $infoUsuario)
    {
        $this->infoUsuarios[] = $infoUsuario;

        return $this;
    }

    /**
     * Remove infoUsuario
     *
     * @param \AppBundle\Entity\Usuario $infoUsuario
     */
    public function removeInfoUsuario(\AppBundle\Entity\Usuario $infoUsuario)
    {
        $this->infoUsuarios->removeElement($infoUsuario);
    }

    /**
     * Get infoUsuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInfoUsuarios()
    {
        return $this->infoUsuarios;
    }
    /**
     * @var string
     */
    private $usiEducacion;


    /**
     * Set usiEducacion
     *
     * @param string $usiEducacion
     *
     * @return UsuarioInformacion
     */
    public function setUsiEducacion($usiEducacion)
    {
        $this->usiEducacion = $usiEducacion;

        return $this;
    }

    /**
     * Get usiEducacion
     *
     * @return string
     */
    public function getUsiEducacion()
    {
        return $this->usiEducacion;
    }
}
