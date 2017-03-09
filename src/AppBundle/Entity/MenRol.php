<?php

namespace AppBundle\Entity;

/**
 * MenRol
 */
class MenRol
{
    /**
     * @var integer
     */
    private $mrolId;

    /**
     * @var string
     */
    private $mrolRol;

    /**
     * @var \DateTime
     */
    private $mrolFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $mrolFechaMod;

    /**
     * @var boolean
     */
    private $mrolActivo = '1';


    /**
     * Get mrolId
     *
     * @return integer
     */
    public function getMrolId()
    {
        return $this->mrolId;
    }

    /**
     * Set mrolRol
     *
     * @param string $mrolRol
     *
     * @return MenRol
     */
    public function setMrolRol($mrolRol)
    {
        $this->mrolRol = $mrolRol;

        return $this;
    }

    /**
     * Get mrolRol
     *
     * @return string
     */
    public function getMrolRol()
    {
        return $this->mrolRol;
    }

    /**
     * Set mrolFechaCrea
     *
     * @param \DateTime $mrolFechaCrea
     *
     * @return MenRol
     */
    public function setMrolFechaCrea($mrolFechaCrea)
    {
        $this->mrolFechaCrea = $mrolFechaCrea;

        return $this;
    }

    /**
     * Get mrolFechaCrea
     *
     * @return \DateTime
     */
    public function getMrolFechaCrea()
    {
        return $this->mrolFechaCrea;
    }

    /**
     * Set mrolFechaMod
     *
     * @param \DateTime $mrolFechaMod
     *
     * @return MenRol
     */
    public function setMrolFechaMod($mrolFechaMod)
    {
        $this->mrolFechaMod = $mrolFechaMod;

        return $this;
    }

    /**
     * Get mrolFechaMod
     *
     * @return \DateTime
     */
    public function getMrolFechaMod()
    {
        return $this->mrolFechaMod;
    }

    /**
     * Set mrolActivo
     *
     * @param boolean $mrolActivo
     *
     * @return MenRol
     */
    public function setMrolActivo($mrolActivo)
    {
        $this->mrolActivo = $mrolActivo;

        return $this;
    }

    /**
     * Get mrolActivo
     *
     * @return boolean
     */
    public function getMrolActivo()
    {
        return $this->mrolActivo;
    }
}

