<?php

namespace AppBundle\Entity;

/**
 * Municipio
 */
class Municipio
{
    /**
     * @var integer
     */
    private $munId;

    /**
     * @var string
     */
    private $munNombre;

    /**
     * @var string
     */
    private $munFechaCrea;

    /**
     * @var string
     */
    private $munFechaMod;

    /**
     * @var string
     */
    private $munActivo;

    /**
     * @var \AppBundle\Entity\Departamento
     */
    private $munDep;


    /**
     * Get munId
     *
     * @return integer
     */
    public function getMunId()
    {
        return $this->munId;
    }

    /**
     * Set munNombre
     *
     * @param string $munNombre
     *
     * @return Municipio
     */
    public function setMunNombre($munNombre)
    {
        $this->munNombre = $munNombre;

        return $this;
    }

    /**
     * Get munNombre
     *
     * @return string
     */
    public function getMunNombre()
    {
        return $this->munNombre;
    }

    /**
     * Set munFechaCrea
     *
     * @param string $munFechaCrea
     *
     * @return Municipio
     */
    public function setMunFechaCrea($munFechaCrea)
    {
        $this->munFechaCrea = $munFechaCrea;

        return $this;
    }

    /**
     * Get munFechaCrea
     *
     * @return string
     */
    public function getMunFechaCrea()
    {
        return $this->munFechaCrea;
    }

    /**
     * Set munFechaMod
     *
     * @param string $munFechaMod
     *
     * @return Municipio
     */
    public function setMunFechaMod($munFechaMod)
    {
        $this->munFechaMod = $munFechaMod;

        return $this;
    }

    /**
     * Get munFechaMod
     *
     * @return string
     */
    public function getMunFechaMod()
    {
        return $this->munFechaMod;
    }

    /**
     * Set munActivo
     *
     * @param string $munActivo
     *
     * @return Municipio
     */
    public function setMunActivo($munActivo)
    {
        $this->munActivo = $munActivo;

        return $this;
    }

    /**
     * Get munActivo
     *
     * @return string
     */
    public function getMunActivo()
    {
        return $this->munActivo;
    }

    /**
     * Set munDep
     *
     * @param \AppBundle\Entity\Departamento $munDep
     *
     * @return Municipio
     */
    public function setMunDep(\AppBundle\Entity\Departamento $munDep = null)
    {
        $this->munDep = $munDep;

        return $this;
    }

    /**
     * Get munDep
     *
     * @return \AppBundle\Entity\Departamento
     */
    public function getMunDep()
    {
        return $this->munDep;
    }
}
