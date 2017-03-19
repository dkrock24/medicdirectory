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
    private $cliModActivo = '1';

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $cliModCli;

    /**
     * @var \AppBundle\Entity\Modulo
     */
    private $cliModMod;


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
}
