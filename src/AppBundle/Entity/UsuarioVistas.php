<?php

namespace AppBundle\Entity;

/**
 * UsuarioVistas
 */
class UsuarioVistas
{

    /**
     * @var integer
     */
    private $visId;

    /**
     * @var string
     */
    private $visReferencia;

    /**
     * @var \DateTime
     */
    private $visFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * Get visId
     *
     * @return integer
     */
    public function getVisId()
    {
        return $this->visId;
    }

    /**
     * Set visReferencia
     *
     * @param string $visReferencia
     *
     * @return UsuarioVistas
     */
    public function setVisReferencia($visReferencia)
    {
        $this->visReferencia = $visReferencia;

        return $this;
    }

    /**
     * Get visReferencia
     *
     * @return string
     */
    public function getVisReferencia()
    {
        return $this->visReferencia;
    }

    /**
     * Set visFechaCrea
     *
     * @param \DateTime $visFechaCrea
     *
     * @return UsuarioVistas
     */
    public function setVisFechaCrea($visFechaCrea)
    {
        $this->visFechaCrea = $visFechaCrea;

        return $this;
    }

    /**
     * Get visFechaCrea
     *
     * @return \DateTime
     */
    public function getVisFechaCrea()
    {
        return $this->visFechaCrea;
    }

    /**
     * @var \AppBundle\Entity\ClienteUsuario
     */
    private $visUsu;


    /**
     * Set visUsu
     *
     * @param \AppBundle\Entity\ClienteUsuario $visUsu
     *
     * @return UsuarioVistas
     */
    public function setVisUsu(\AppBundle\Entity\ClienteUsuario $visUsu = null)
    {
        $this->visUsu = $visUsu;

        return $this;
    }

    /**
     * Get visUsu
     *
     * @return \AppBundle\Entity\ClienteUsuario
     */
    public function getVisUsu()
    {
        return $this->visUsu;
    }
}
