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
     * @var \AppBundle\Entity\Usuario
     */
    private $visUsuario;


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
     * Set visUsuario
     *
     * @param \AppBundle\Entity\Usuario $visUsuario
     *
     * @return UsuarioVistas
     */
    public function setVisUsuario(\AppBundle\Entity\Usuario $visUsuario = null)
    {
        $this->visUsuario = $visUsuario;

        return $this;
    }

    /**
     * Get visUsuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getVisUsuario()
    {
        return $this->visUsuario;
    }
}
