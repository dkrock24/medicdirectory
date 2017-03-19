<?php

namespace AppBundle\Entity;

/**
 * Departamento
 */
class Departamento
{
    /**
     * @var integer
     */
    private $depId;

    /**
     * @var string
     */
    private $depDepartamento;

    /**
     * @var string
     */
    private $depCodigo;

    /**
     * @var string
     */
    private $depAbreviatura;

    /**
     * @var \DateTime
     */
    private $depFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $depFechaMod;

    /**
     * @var boolean
     */
    private $depActivo = '1';

    /**
     * @var \AppBundle\Entity\Pais
     */
    private $depPai;


    /**
     * Get depId
     *
     * @return integer
     */
    public function getDepId()
    {
        return $this->depId;
    }

    /**
     * Set depDepartamento
     *
     * @param string $depDepartamento
     *
     * @return Departamento
     */
    public function setDepDepartamento($depDepartamento)
    {
        $this->depDepartamento = $depDepartamento;

        return $this;
    }

    /**
     * Get depDepartamento
     *
     * @return string
     */
    public function getDepDepartamento()
    {
        return $this->depDepartamento;
    }

    /**
     * Set depCodigo
     *
     * @param string $depCodigo
     *
     * @return Departamento
     */
    public function setDepCodigo($depCodigo)
    {
        $this->depCodigo = $depCodigo;

        return $this;
    }

    /**
     * Get depCodigo
     *
     * @return string
     */
    public function getDepCodigo()
    {
        return $this->depCodigo;
    }

    /**
     * Set depAbreviatura
     *
     * @param string $depAbreviatura
     *
     * @return Departamento
     */
    public function setDepAbreviatura($depAbreviatura)
    {
        $this->depAbreviatura = $depAbreviatura;

        return $this;
    }

    /**
     * Get depAbreviatura
     *
     * @return string
     */
    public function getDepAbreviatura()
    {
        return $this->depAbreviatura;
    }

    /**
     * Set depFechaCrea
     *
     * @param \DateTime $depFechaCrea
     *
     * @return Departamento
     */
    public function setDepFechaCrea($depFechaCrea)
    {
        $this->depFechaCrea = $depFechaCrea;

        return $this;
    }

    /**
     * Get depFechaCrea
     *
     * @return \DateTime
     */
    public function getDepFechaCrea()
    {
        return $this->depFechaCrea;
    }

    /**
     * Set depFechaMod
     *
     * @param \DateTime $depFechaMod
     *
     * @return Departamento
     */
    public function setDepFechaMod($depFechaMod)
    {
        $this->depFechaMod = $depFechaMod;

        return $this;
    }

    /**
     * Get depFechaMod
     *
     * @return \DateTime
     */
    public function getDepFechaMod()
    {
        return $this->depFechaMod;
    }

    /**
     * Set depActivo
     *
     * @param boolean $depActivo
     *
     * @return Departamento
     */
    public function setDepActivo($depActivo)
    {
        $this->depActivo = $depActivo;

        return $this;
    }

    /**
     * Get depActivo
     *
     * @return boolean
     */
    public function getDepActivo()
    {
        return $this->depActivo;
    }

    /**
     * Set depPai
     *
     * @param \AppBundle\Entity\Pais $depPai
     *
     * @return Departamento
     */
    public function setDepPai(\AppBundle\Entity\Pais $depPai = null)
    {
        $this->depPai = $depPai;

        return $this;
    }

    /**
     * Get depPai
     *
     * @return \AppBundle\Entity\Pais
     */
    public function getDepPai()
    {
        return $this->depPai;
    }
}
