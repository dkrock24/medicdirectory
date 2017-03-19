<?php

namespace AppBundle\Entity;

/**
 * Sugerencia
 */
class Sugerencia
{
    /**
     * @var integer
     */
    private $sugId;

    /**
     * @var string
     */
    private $sugerencia;

    /**
     * @var \DateTime
     */
    private $sugFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $sugFechaMod;

    /**
     * @var boolean
     */
    private $sugActivo = '1';

    /**
     * @var \AppBundle\Entity\Modulo
     */
    private $sugMod;


    /**
     * Get sugId
     *
     * @return integer
     */
    public function getSugId()
    {
        return $this->sugId;
    }

    /**
     * Set sugerencia
     *
     * @param string $sugerencia
     *
     * @return Sugerencia
     */
    public function setSugerencia($sugerencia)
    {
        $this->sugerencia = $sugerencia;

        return $this;
    }

    /**
     * Get sugerencia
     *
     * @return string
     */
    public function getSugerencia()
    {
        return $this->sugerencia;
    }

    /**
     * Set sugFechaCrea
     *
     * @param \DateTime $sugFechaCrea
     *
     * @return Sugerencia
     */
    public function setSugFechaCrea($sugFechaCrea)
    {
        $this->sugFechaCrea = $sugFechaCrea;

        return $this;
    }

    /**
     * Get sugFechaCrea
     *
     * @return \DateTime
     */
    public function getSugFechaCrea()
    {
        return $this->sugFechaCrea;
    }

    /**
     * Set sugFechaMod
     *
     * @param \DateTime $sugFechaMod
     *
     * @return Sugerencia
     */
    public function setSugFechaMod($sugFechaMod)
    {
        $this->sugFechaMod = $sugFechaMod;

        return $this;
    }

    /**
     * Get sugFechaMod
     *
     * @return \DateTime
     */
    public function getSugFechaMod()
    {
        return $this->sugFechaMod;
    }

    /**
     * Set sugActivo
     *
     * @param boolean $sugActivo
     *
     * @return Sugerencia
     */
    public function setSugActivo($sugActivo)
    {
        $this->sugActivo = $sugActivo;

        return $this;
    }

    /**
     * Get sugActivo
     *
     * @return boolean
     */
    public function getSugActivo()
    {
        return $this->sugActivo;
    }

    /**
     * Set sugMod
     *
     * @param \AppBundle\Entity\Modulo $sugMod
     *
     * @return Sugerencia
     */
    public function setSugMod(\AppBundle\Entity\Modulo $sugMod = null)
    {
        $this->sugMod = $sugMod;

        return $this;
    }

    /**
     * Get sugMod
     *
     * @return \AppBundle\Entity\Modulo
     */
    public function getSugMod()
    {
        return $this->sugMod;
    }
}
