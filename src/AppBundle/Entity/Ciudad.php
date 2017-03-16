<?php

namespace AppBundle\Entity;

/**
 * Ciudad
 */
class Ciudad
{
    /**
     * @var integer
     */
    private $ciuId;

    /**
     * @var string
     */
    private $ciuNombre;

    /**
     * @var \DateTime
     */
    private $ciuFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $ciuFechaMod;

    /**
     * @var boolean
     */
    private $ciuActivo = '1';

    /**
     * @var \AppBundle\Entity\Municipio
     */
    private $ciuMun;


    /**
     * Get ciuId
     *
     * @return integer
     */
    public function getCiuId()
    {
        return $this->ciuId;
    }

    /**
     * Set ciuNombre
     *
     * @param string $ciuNombre
     *
     * @return Ciudad
     */
    public function setCiuNombre($ciuNombre)
    {
        $this->ciuNombre = $ciuNombre;

        return $this;
    }

    /**
     * Get ciuNombre
     *
     * @return string
     */
    public function getCiuNombre()
    {
        return $this->ciuNombre;
    }

    /**
     * Set ciuFechaCrea
     *
     * @param \DateTime $ciuFechaCrea
     *
     * @return Ciudad
     */
    public function setCiuFechaCrea($ciuFechaCrea)
    {
        $this->ciuFechaCrea = $ciuFechaCrea;

        return $this;
    }

    /**
     * Get ciuFechaCrea
     *
     * @return \DateTime
     */
    public function getCiuFechaCrea()
    {
        return $this->ciuFechaCrea;
    }

    /**
     * Set ciuFechaMod
     *
     * @param \DateTime $ciuFechaMod
     *
     * @return Ciudad
     */
    public function setCiuFechaMod($ciuFechaMod)
    {
        $this->ciuFechaMod = $ciuFechaMod;

        return $this;
    }

    /**
     * Get ciuFechaMod
     *
     * @return \DateTime
     */
    public function getCiuFechaMod()
    {
        return $this->ciuFechaMod;
    }

    /**
     * Set ciuActivo
     *
     * @param boolean $ciuActivo
     *
     * @return Ciudad
     */
    public function setCiuActivo($ciuActivo)
    {
        $this->ciuActivo = $ciuActivo;

        return $this;
    }

    /**
     * Get ciuActivo
     *
     * @return boolean
     */
    public function getCiuActivo()
    {
        return $this->ciuActivo;
    }

    /**
     * Set ciuMun
     *
     * @param \AppBundle\Entity\Municipio $ciuMun
     *
     * @return Ciudad
     */
    public function setCiuMun(\AppBundle\Entity\Municipio $ciuMun = null)
    {
        $this->ciuMun = $ciuMun;

        return $this;
    }

    /**
     * Get ciuMun
     *
     * @return \AppBundle\Entity\Municipio
     */
    public function getCiuMun()
    {
        return $this->ciuMun;
    }
}
