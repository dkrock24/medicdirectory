<?php

namespace AppBundle\Entity;

/**
 * ClienteModulo
 */
class ClienteModulo
{
    /**
     * @var integer
     */
    private $cliMod;

    /**
     * @var integer
     */
    private $cliModModId;

    /**
     * @var integer
     */
    private $cliModCliId;

    /**
     * @var \DateTime
     */
    private $cliModFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $cliModFechaMod;

    /**
     * @var boolean
     */
    private $cliModActivo = true;

    /**
     * @var \AppBundle\Entity\Modulo
     */
    private $cliModMod;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $cliModCli;

    public function __toString() {
        return $this->cliModCli->getCliNombre().'\\'.$this->cliModMod->getModModulo();
    }

    /**
     * Get cliMod
     *
     * @return integer
     */
    public function getCliMod()
    {
        return $this->cliMod;
    }

    /**
     * Set cliModModId
     *
     * @param integer $cliModModId
     *
     * @return ClienteModulo
     */
    public function setCliModModId($cliModModId)
    {
        $this->cliModModId = $cliModModId;

        return $this;
    }

    /**
     * Get cliModModId
     *
     * @return integer
     */
    public function getCliModModId()
    {
        return $this->cliModModId;
    }

    /**
     * Set cliModCliId
     *
     * @param integer $cliModCliId
     *
     * @return ClienteModulo
     */
    public function setCliModCliId($cliModCliId)
    {
        $this->cliModCliId = $cliModCliId;

        return $this;
    }

    /**
     * Get cliModCliId
     *
     * @return integer
     */
    public function getCliModCliId()
    {
        return $this->cliModCliId;
    }

    /**
     * Set cliModFechaCrea
     *
     * @param \DateTime $cliModFechaCrea
     *
     * @return ClienteModulo
     */
    public function setCliModFechaCrea($cliModFechaCrea)
    {
        $this->cliModFechaCrea = $cliModFechaCrea;

        return $this;
    }

    /**
     * Get cliModFechaCrea
     *
     * @return \DateTime
     */
    public function getCliModFechaCrea()
    {
        return $this->cliModFechaCrea;
    }

    /**
     * Set cliModFechaMod
     *
     * @param \DateTime $cliModFechaMod
     *
     * @return ClienteModulo
     */
    public function setCliModFechaMod($cliModFechaMod)
    {
        $this->cliModFechaMod = $cliModFechaMod;

        return $this;
    }

    /**
     * Get cliModFechaMod
     *
     * @return \DateTime
     */
    public function getCliModFechaMod()
    {
        return $this->cliModFechaMod;
    }

    /**
     * Set cliModActivo
     *
     * @param boolean $cliModActivo
     *
     * @return ClienteModulo
     */
    public function setCliModActivo($cliModActivo)
    {
        $this->cliModActivo = $cliModActivo;

        return $this;
    }

    /**
     * Get cliModActivo
     *
     * @return boolean
     */
    public function getCliModActivo()
    {
        return $this->cliModActivo;
    }

    /**
     * Set cliModMod
     *
     * @param \AppBundle\Entity\Modulo $cliModMod
     *
     * @return ClienteModulo
     */
    public function setCliModMod(\AppBundle\Entity\Modulo $cliModMod = null)
    {
        $this->cliModMod = $cliModMod;

        return $this;
    }

    /**
     * Get cliModMod
     *
     * @return \AppBundle\Entity\Modulo
     */
    public function getCliModMod()
    {
        return $this->cliModMod;
    }

    /**
     * Set cliModCli
     *
     * @param \AppBundle\Entity\Cliente $cliModCli
     *
     * @return ClienteModulo
     */
    public function setCliModCli(\AppBundle\Entity\Cliente $cliModCli = null)
    {
        $this->cliModCli = $cliModCli;

        return $this;
    }

    /**
     * Get cliModCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliModCli()
    {
        return $this->cliModCli;
    }
    /**
     * @var string
     */
    private $cliModCosto;


    /**
     * Set cliModCosto
     *
     * @param string $cliModCosto
     *
     * @return ClienteModulo
     */
    public function setCliModCosto($cliModCosto)
    {
        $this->cliModCosto = $cliModCosto;

        return $this;
    }

    /**
     * Get cliModCosto
     *
     * @return string
     */
    public function getCliModCosto()
    {
        return $this->cliModCosto;
    }
}
