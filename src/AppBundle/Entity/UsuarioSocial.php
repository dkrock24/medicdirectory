<?php

namespace AppBundle\Entity;

/**
 * UsuarioSocial
 */
class UsuarioSocial
{
    /**
     * @var integer
     */
    private $idUsuSoc;

    /**
     * @var integer
     */
    private $idSocialRed = '0';

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $idUsuario;


    /**
     * Get idUsuSoc
     *
     * @return integer
     */
    public function getIdUsuSoc()
    {
        return $this->idUsuSoc;
    }

    /**
     * Set idSocialRed
     *
     * @param integer $idSocialRed
     *
     * @return UsuarioSocial
     */
    public function setIdSocialRed($idSocialRed)
    {
        $this->idSocialRed = $idSocialRed;

        return $this;
    }

    /**
     * Get idSocialRed
     *
     * @return integer
     */
    public function getIdSocialRed()
    {
        return $this->idSocialRed;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\Usuario $idUsuario
     *
     * @return UsuarioSocial
     */
    public function setIdUsuario(\AppBundle\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
