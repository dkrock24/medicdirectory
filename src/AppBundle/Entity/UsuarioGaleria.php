<?php

namespace AppBundle\Entity;

/**
 * UsuarioGaleria
 */
class UsuarioGaleria
{
    /**
     * @var integer
     */
    private $ugaId;

    /**
     * @var string
     */
    private $ugaHash;

    /**
     * @var \DateTime
     */
    private $ugaFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $ugaFechaMod;

    /**
     * @var boolean
     */
    private $ugaActivo = '1';


    /**
     * Get ugaId
     *
     * @return integer
     */
    public function getUgaId()
    {
        return $this->ugaId;
    }

    /**
     * Set ugaHash
     *
     * @param string $ugaHash
     *
     * @return UsuarioGaleria
     */
    public function setUgaHash($ugaHash)
    {
        $this->ugaHash = $ugaHash;

        return $this;
    }

    /**
     * Get ugaHash
     *
     * @return string
     */
    public function getUgaHash()
    {
        return $this->ugaHash;
    }

    /**
     * Set ugaFechaCrea
     *
     * @param \DateTime $ugaFechaCrea
     *
     * @return UsuarioGaleria
     */
    public function setUgaFechaCrea($ugaFechaCrea)
    {
        $this->ugaFechaCrea = $ugaFechaCrea;

        return $this;
    }

    /**
     * Get ugaFechaCrea
     *
     * @return \DateTime
     */
    public function getUgaFechaCrea()
    {
        return $this->ugaFechaCrea;
    }

    /**
     * Set ugaFechaMod
     *
     * @param \DateTime $ugaFechaMod
     *
     * @return UsuarioGaleria
     */
    public function setUgaFechaMod($ugaFechaMod)
    {
        $this->ugaFechaMod = $ugaFechaMod;

        return $this;
    }

    /**
     * Get ugaFechaMod
     *
     * @return \DateTime
     */
    public function getUgaFechaMod()
    {
        return $this->ugaFechaMod;
    }

    /**
     * Set ugaActivo
     *
     * @param boolean $ugaActivo
     *
     * @return UsuarioGaleria
     */
    public function setUgaActivo($ugaActivo)
    {
        $this->ugaActivo = $ugaActivo;

        return $this;
    }

    /**
     * Get ugaActivo
     *
     * @return boolean
     */
    public function getUgaActivo()
    {
        return $this->ugaActivo;
    }
    /**
     * @var integer
     */
    private $galId;

    /**
     * @var \DateTime
     */
    private $galFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $galFechaMod;

    /**
     * @var boolean
     */
    private $galActivo = '1';

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $galUsuario;


    /**
     * Get galId
     *
     * @return integer
     */
    public function getGalId()
    {
        return $this->galId;
    }

    /**
     * Set galFechaCrea
     *
     * @param \DateTime $galFechaCrea
     *
     * @return UsuarioGaleria
     */
    public function setGalFechaCrea($galFechaCrea)
    {
        $this->galFechaCrea = $galFechaCrea;

        return $this;
    }

    /**
     * Get galFechaCrea
     *
     * @return \DateTime
     */
    public function getGalFechaCrea()
    {
        return $this->galFechaCrea;
    }

    /**
     * Set galFechaMod
     *
     * @param \DateTime $galFechaMod
     *
     * @return UsuarioGaleria
     */
    public function setGalFechaMod($galFechaMod)
    {
        $this->galFechaMod = $galFechaMod;

        return $this;
    }

    /**
     * Get galFechaMod
     *
     * @return \DateTime
     */
    public function getGalFechaMod()
    {
        return $this->galFechaMod;
    }

    /**
     * Set galActivo
     *
     * @param boolean $galActivo
     *
     * @return UsuarioGaleria
     */
    public function setGalActivo($galActivo)
    {
        $this->galActivo = $galActivo;

        return $this;
    }

    /**
     * Get galActivo
     *
     * @return boolean
     */
    public function getGalActivo()
    {
        return $this->galActivo;
    }

    /**
     * Set galUsuario
     *
     * @param \AppBundle\Entity\Usuario $galUsuario
     *
     * @return UsuarioGaleria
     */
    public function setGalUsuario(\AppBundle\Entity\Usuario $galUsuario = null)
    {
        $this->galUsuario = $galUsuario;

        return $this;
    }

    /**
     * Get galUsuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getGalUsuario()
    {
        return $this->galUsuario;
    }
    /**
     * @var string
     */
    private $galHash;

    /**
     * @var \AppBundle\Entity\Modulo
     */
    private $galModulo;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $galCliente;


    /**
     * Set galHash
     *
     * @param string $galHash
     *
     * @return UsuarioGaleria
     */
    public function setGalHash($galHash)
    {
        $this->galHash = $galHash;

        return $this;
    }

    /**
     * Get galHash
     *
     * @return string
     */
    public function getGalHash()
    {
        return $this->galHash;
    }

    /**
     * Set galModulo
     *
     * @param \AppBundle\Entity\Modulo $galModulo
     *
     * @return UsuarioGaleria
     */
    public function setGalModulo(\AppBundle\Entity\Modulo $galModulo = null)
    {
        $this->galModulo = $galModulo;

        return $this;
    }

    /**
     * Get galModulo
     *
     * @return \AppBundle\Entity\Modulo
     */
    public function getGalModulo()
    {
        return $this->galModulo;
    }

    /**
     * Set galCliente
     *
     * @param \AppBundle\Entity\Cliente $galCliente
     *
     * @return UsuarioGaleria
     */
    public function setGalCliente(\AppBundle\Entity\Cliente $galCliente = null)
    {
        $this->galCliente = $galCliente;

        return $this;
    }

    /**
     * Get galCliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getGalCliente()
    {
        return $this->galCliente;
    }
    /**
     * @var string
     */
    private $galTipo;


    /**
     * Set galTipo
     *
     * @param string $galTipo
     *
     * @return UsuarioGaleria
     */
    public function setGalTipo($galTipo)
    {
        $this->galTipo = $galTipo;

        return $this;
    }

    /**
     * Get galTipo
     *
     * @return string
     */
    public function getGalTipo()
    {
        return $this->galTipo;
    }
}