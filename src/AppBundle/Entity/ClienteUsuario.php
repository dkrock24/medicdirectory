<?php

namespace AppBundle\Entity;

/**
 * ClienteUsuario
 */
class ClienteUsuario
{
    /**
     * @var integer
     */
    private $cliUsuId;

    /**
     * @var \DateTime
     */
    private $cliUsuFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $cliUsuFechaMod;

    /**
     * @var boolean
     */
    private $cliUsuActivo = '1';

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $cliUsuCli;

    /**
     * @var \AppBundle\Entity\Rol
     */
    private $cliUsuRol;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $cliUsuUsu;


    /**
     * Get cliUsuId
     *
     * @return integer
     */
    public function getCliUsuId()
    {
        return $this->cliUsuId;
    }

    /**
     * Set cliUsuFechaCrea
     *
     * @param \DateTime $cliUsuFechaCrea
     *
     * @return ClienteUsuario
     */
    public function setCliUsuFechaCrea($cliUsuFechaCrea)
    {
        $this->cliUsuFechaCrea = $cliUsuFechaCrea;

        return $this;
    }

    /**
     * Get cliUsuFechaCrea
     *
     * @return \DateTime
     */
    public function getCliUsuFechaCrea()
    {
        return $this->cliUsuFechaCrea;
    }

    /**
     * Set cliUsuFechaMod
     *
     * @param \DateTime $cliUsuFechaMod
     *
     * @return ClienteUsuario
     */
    public function setCliUsuFechaMod($cliUsuFechaMod)
    {
        $this->cliUsuFechaMod = $cliUsuFechaMod;

        return $this;
    }

    /**
     * Get cliUsuFechaMod
     *
     * @return \DateTime
     */
    public function getCliUsuFechaMod()
    {
        return $this->cliUsuFechaMod;
    }

    /**
     * Set cliUsuActivo
     *
     * @param boolean $cliUsuActivo
     *
     * @return ClienteUsuario
     */
    public function setCliUsuActivo($cliUsuActivo)
    {
        $this->cliUsuActivo = $cliUsuActivo;

        return $this;
    }

    /**
     * Get cliUsuActivo
     *
     * @return boolean
     */
    public function getCliUsuActivo()
    {
        return $this->cliUsuActivo;
    }

    /**
     * Set cliUsuCli
     *
     * @param \AppBundle\Entity\Cliente $cliUsuCli
     *
     * @return ClienteUsuario
     */
    public function setCliUsuCli(\AppBundle\Entity\Cliente $cliUsuCli = null)
    {
        $this->cliUsuCli = $cliUsuCli;

        return $this;
    }

    /**
     * Get cliUsuCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliUsuCli()
    {
        return $this->cliUsuCli;
    }

    /**
     * Set cliUsuRol
     *
     * @param \AppBundle\Entity\Rol $cliUsuRol
     *
     * @return ClienteUsuario
     */
    public function setCliUsuRol(\AppBundle\Entity\Rol $cliUsuRol = null)
    {
        $this->cliUsuRol = $cliUsuRol;

        return $this;
    }

    /**
     * Get cliUsuRol
     *
     * @return \AppBundle\Entity\Rol
     */
    public function getCliUsuRol()
    {
        return $this->cliUsuRol;
    }

    /**
     * Set cliUsuUsu
     *
     * @param \AppBundle\Entity\Usuario $cliUsuUsu
     *
     * @return ClienteUsuario
     */
    public function setCliUsuUsu(\AppBundle\Entity\Usuario $cliUsuUsu = null)
    {
        $this->cliUsuUsu = $cliUsuUsu;

        return $this;
    }

    /**
     * Get cliUsuUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getCliUsuUsu()
    {
        return $this->cliUsuUsu;
    }
}

