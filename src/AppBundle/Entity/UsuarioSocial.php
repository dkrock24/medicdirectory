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
     * @var string
     */
    private $usuSocUrl = '';

    /**
     * @var \AppBundle\Entity\SocialRedes
     */
    private $idSocialRed;

    /**
     * @var \AppBundle\Entity\ClienteUsuario
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
     * Set usuSocUrl
     *
     * @param string $usuSocUrl
     *
     * @return UsuarioSocial
     */
    public function setUsuSocUrl($usuSocUrl)
    {
        $this->usuSocUrl = $usuSocUrl;

        return $this;
    }

    /**
     * Get usuSocUrl
     *
     * @return string
     */
    public function getUsuSocUrl()
    {
        return $this->usuSocUrl;
    }

    /**
     * Set idSocialRed
     *
     * @param \AppBundle\Entity\SocialRedes $idSocialRed
     *
     * @return UsuarioSocial
     */
    public function setIdSocialRed(\AppBundle\Entity\SocialRedes $idSocialRed = null)
    {
        $this->idSocialRed = $idSocialRed;

        return $this;
    }

    /**
     * Get idSocialRed
     *
     * @return \AppBundle\Entity\SocialRedes
     */
    public function getIdSocialRed()
    {
        return $this->idSocialRed;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\ClienteUsuario $idUsuario
     *
     * @return UsuarioSocial
     */
    public function setIdUsuario(\AppBundle\Entity\ClienteUsuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\ClienteUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
