<?php

namespace AppBundle\Entity;

/**
 * Parametros
 */
class Parametros
{
    /**
     * @var integer
     */
    private $parId;

    /**
     * @var string
     */
    private $parLlave;

    /**
     * @var string
     */
    private $parValor;

    /**
     * @var \DateTime
     */
    private $parFechaMod = 'CURRENT_TIMESTAMP';


    /**
     * Get parId
     *
     * @return integer
     */
    public function getParId()
    {
        return $this->parId;
    }

    /**
     * Set parLlave
     *
     * @param string $parLlave
     *
     * @return Parametros
     */
    public function setParLlave($parLlave)
    {
        $this->parLlave = $parLlave;

        return $this;
    }

    /**
     * Get parLlave
     *
     * @return string
     */
    public function getParLlave()
    {
        return $this->parLlave;
    }

    /**
     * Set parValor
     *
     * @param string $parValor
     *
     * @return Parametros
     */
    public function setParValor($parValor)
    {
        $this->parValor = $parValor;

        return $this;
    }

    /**
     * Get parValor
     *
     * @return string
     */
    public function getParValor()
    {
        return $this->parValor;
    }

    /**
     * Set parFechaMod
     *
     * @param \DateTime $parFechaMod
     *
     * @return Parametros
     */
    public function setParFechaMod($parFechaMod)
    {
        $this->parFechaMod = $parFechaMod;

        return $this;
    }

    /**
     * Get parFechaMod
     *
     * @return \DateTime
     */
    public function getParFechaMod()
    {
        return $this->parFechaMod;
    }
}
