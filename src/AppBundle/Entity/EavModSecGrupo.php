<?php

namespace AppBundle\Entity;

/**
 * EavModSecGrupo
 */
class EavModSecGrupo
{
    /**
     * @var integer
     */
    private $secGrId;

    /**
     * @var string
     */
    private $secGrGrupo;

    /**
     * @var boolean
     */
    private $secGrActivo = true;

    /**
     * @var \DateTime
     */
    private $secGrFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $secGrFechaMod;

    /**
     * @var integer
     */
    private $secGrOrden;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $campos;

    /**
     * @var \AppBundle\Entity\EavModSeccion
     */
    private $grupoSeccion;

    public function __toString() {
        return $this->secGrGrupo;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->campos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get secGrId
     *
     * @return integer
     */
    public function getSecGrId()
    {
        return $this->secGrId;
    }

    /**
     * Set secGrGrupo
     *
     * @param string $secGrGrupo
     *
     * @return EavModSecGrupo
     */
    public function setSecGrGrupo($secGrGrupo)
    {
        $this->secGrGrupo = $secGrGrupo;

        return $this;
    }

    /**
     * Get secGrGrupo
     *
     * @return string
     */
    public function getSecGrGrupo()
    {
        return $this->secGrGrupo;
    }

    /**
     * Set secGrActivo
     *
     * @param boolean $secGrActivo
     *
     * @return EavModSecGrupo
     */
    public function setSecGrActivo($secGrActivo)
    {
        $this->secGrActivo = $secGrActivo;

        return $this;
    }

    /**
     * Get secGrActivo
     *
     * @return boolean
     */
    public function getSecGrActivo()
    {
        return $this->secGrActivo;
    }

    /**
     * Set secGrFechaCrea
     *
     * @param \DateTime $secGrFechaCrea
     *
     * @return EavModSecGrupo
     */
    public function setSecGrFechaCrea($secGrFechaCrea)
    {
        $this->secGrFechaCrea = $secGrFechaCrea;

        return $this;
    }

    /**
     * Get secGrFechaCrea
     *
     * @return \DateTime
     */
    public function getSecGrFechaCrea()
    {
        return $this->secGrFechaCrea;
    }

    /**
     * Set secGrFechaMod
     *
     * @param \DateTime $secGrFechaMod
     *
     * @return EavModSecGrupo
     */
    public function setSecGrFechaMod($secGrFechaMod)
    {
        $this->secGrFechaMod = $secGrFechaMod;

        return $this;
    }

    /**
     * Get secGrFechaMod
     *
     * @return \DateTime
     */
    public function getSecGrFechaMod()
    {
        return $this->secGrFechaMod;
    }

    /**
     * Set secGrOrden
     *
     * @param integer $secGrOrden
     *
     * @return EavModSecGrupo
     */
    public function setSecGrOrden($secGrOrden)
    {
        $this->secGrOrden = $secGrOrden;

        return $this;
    }

    /**
     * Get secGrOrden
     *
     * @return integer
     */
    public function getSecGrOrden()
    {
        return $this->secGrOrden;
    }

    /**
     * Add campo
     *
     * @param \AppBundle\Entity\EavModCampos $campo
     *
     * @return EavModSecGrupo
     */
    public function addCampo(\AppBundle\Entity\EavModCampos $campo)
    {
        $this->campos[] = $campo;

        return $this;
    }

    /**
     * Remove campo
     *
     * @param \AppBundle\Entity\EavModCampos $campo
     */
    public function removeCampo(\AppBundle\Entity\EavModCampos $campo)
    {
        $this->campos->removeElement($campo);
    }

    /**
     * Get campos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampos()
    {
        return $this->campos;
    }

    /**
     * Set grupoSeccion
     *
     * @param \AppBundle\Entity\EavModSeccion $grupoSeccion
     *
     * @return EavModSecGrupo
     */
    public function setGrupoSeccion(\AppBundle\Entity\EavModSeccion $grupoSeccion = null)
    {
        $this->grupoSeccion = $grupoSeccion;

        return $this;
    }

    /**
     * Get grupoSeccion
     *
     * @return \AppBundle\Entity\EavModSeccion
     */
    public function getGrupoSeccion()
    {
        return $this->grupoSeccion;
    }
}

