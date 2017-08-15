<?php

namespace AppBundle\Entity;

/**
 * ClienteAjustes
 */
class ClienteAjustes
{
    /**
     * @var integer
     */
    private $cliAjuId;

    /**
     * @var string
     */
    private $cliAjuLlave;

    /**
     * @var string
     */
    private $cliAjuValor;

    /**
     * @var string
     */
    private $cliAjuGrupo;

    /**
     * @var boolean
     */
    private $cliAjuActivo;

    /**
     * @var \DateTime
     */
    private $cliAjuFechaCrea;

    /**
     * @var \DateTime
     */
    private $cliAjuFechaMod;

    /**
     * @var \AppBundle\Entity\ClienteUsuario
     */
    private $cliAjuCliUsu;


    /**
     * Get cliAjuId
     *
     * @return integer
     */
    public function getCliAjuId()
    {
        return $this->cliAjuId;
    }

    /**
     * Set cliAjuLlave
     *
     * @param string $cliAjuLlave
     *
     * @return ClienteAjustes
     */
    public function setCliAjuLlave($cliAjuLlave)
    {
        $this->cliAjuLlave = $cliAjuLlave;

        return $this;
    }

    /**
     * Get cliAjuLlave
     *
     * @return string
     */
    public function getCliAjuLlave()
    {
        return $this->cliAjuLlave;
    }

    /**
     * Set cliAjuValor
     *
     * @param string $cliAjuValor
     *
     * @return ClienteAjustes
     */
    public function setCliAjuValor($cliAjuValor)
    {
        $this->cliAjuValor = $cliAjuValor;

        return $this;
    }

    /**
     * Get cliAjuValor
     *
     * @return string
     */
    public function getCliAjuValor()
    {
        return $this->cliAjuValor;
    }

    /**
     * Set cliAjuGrupo
     *
     * @param string $cliAjuGrupo
     *
     * @return ClienteAjustes
     */
    public function setCliAjuGrupo($cliAjuGrupo)
    {
        $this->cliAjuGrupo = $cliAjuGrupo;

        return $this;
    }

    /**
     * Get cliAjuGrupo
     *
     * @return string
     */
    public function getCliAjuGrupo()
    {
        return $this->cliAjuGrupo;
    }

    /**
     * Set cliAjuActivo
     *
     * @param boolean $cliAjuActivo
     *
     * @return ClienteAjustes
     */
    public function setCliAjuActivo($cliAjuActivo)
    {
        $this->cliAjuActivo = $cliAjuActivo;

        return $this;
    }

    /**
     * Get cliAjuActivo
     *
     * @return boolean
     */
    public function getCliAjuActivo()
    {
        return $this->cliAjuActivo;
    }

    /**
     * Set cliAjuFechaCrea
     *
     * @param \DateTime $cliAjuFechaCrea
     *
     * @return ClienteAjustes
     */
    public function setCliAjuFechaCrea($cliAjuFechaCrea)
    {
        $this->cliAjuFechaCrea = $cliAjuFechaCrea;

        return $this;
    }

    /**
     * Get cliAjuFechaCrea
     *
     * @return \DateTime
     */
    public function getCliAjuFechaCrea()
    {
        return $this->cliAjuFechaCrea;
    }

    /**
     * Set cliAjuFechaMod
     *
     * @param \DateTime $cliAjuFechaMod
     *
     * @return ClienteAjustes
     */
    public function setCliAjuFechaMod($cliAjuFechaMod)
    {
        $this->cliAjuFechaMod = $cliAjuFechaMod;

        return $this;
    }

    /**
     * Get cliAjuFechaMod
     *
     * @return \DateTime
     */
    public function getCliAjuFechaMod()
    {
        return $this->cliAjuFechaMod;
    }

    /**
     * Set cliAjuCliUsu
     *
     * @param \AppBundle\Entity\ClienteUsuario $cliAjuCliUsu
     *
     * @return ClienteAjustes
     */
    public function setCliAjuCliUsu(\AppBundle\Entity\ClienteUsuario $cliAjuCliUsu = null)
    {
        $this->cliAjuCliUsu = $cliAjuCliUsu;

        return $this;
    }

    /**
     * Get cliAjuCliUsu
     *
     * @return \AppBundle\Entity\ClienteUsuario
     */
    public function getCliAjuCliUsu()
    {
        return $this->cliAjuCliUsu;
    }
}
