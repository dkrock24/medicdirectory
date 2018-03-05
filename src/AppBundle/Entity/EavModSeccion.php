<?php

namespace AppBundle\Entity;

/**
 * EavModSeccion
 */
class EavModSeccion
{
    /**
     * @var integer
     */
    private $modSeccId;

    /**
     * @var string
     */
    private $modSeccSeccion;

    /**
     * @var integer
     */
    private $modSeccOrden;

    /**
     * @var boolean
     */
    private $modSeccActivo = true;

    /**
     * @var \DateTime
     */
    private $modSeccFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $modSeccFechaMod;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $seccionGrupo;

    /**
     * @var \AppBundle\Entity\Modulo
     */
    private $modSeccModId;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seccionGrupo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get modSeccId
     *
     * @return integer
     */
    public function getModSeccId()
    {
        return $this->modSeccId;
    }

    /**
     * Set modSeccSeccion
     *
     * @param string $modSeccSeccion
     *
     * @return EavModSeccion
     */
    public function setModSeccSeccion($modSeccSeccion)
    {
        $this->modSeccSeccion = $modSeccSeccion;

        return $this;
    }

    /**
     * Get modSeccSeccion
     *
     * @return string
     */
    public function getModSeccSeccion()
    {
        return $this->modSeccSeccion;
    }

    /**
     * Set modSeccOrden
     *
     * @param integer $modSeccOrden
     *
     * @return EavModSeccion
     */
    public function setModSeccOrden($modSeccOrden)
    {
        $this->modSeccOrden = $modSeccOrden;

        return $this;
    }

    /**
     * Get modSeccOrden
     *
     * @return integer
     */
    public function getModSeccOrden()
    {
        return $this->modSeccOrden;
    }

    /**
     * Set modSeccActivo
     *
     * @param boolean $modSeccActivo
     *
     * @return EavModSeccion
     */
    public function setModSeccActivo($modSeccActivo)
    {
        $this->modSeccActivo = $modSeccActivo;

        return $this;
    }

    /**
     * Get modSeccActivo
     *
     * @return boolean
     */
    public function getModSeccActivo()
    {
        return $this->modSeccActivo;
    }

    /**
     * Set modSeccFechaCrea
     *
     * @param \DateTime $modSeccFechaCrea
     *
     * @return EavModSeccion
     */
    public function setModSeccFechaCrea($modSeccFechaCrea)
    {
        $this->modSeccFechaCrea = $modSeccFechaCrea;

        return $this;
    }

    /**
     * Get modSeccFechaCrea
     *
     * @return \DateTime
     */
    public function getModSeccFechaCrea()
    {
        return $this->modSeccFechaCrea;
    }

    /**
     * Set modSeccFechaMod
     *
     * @param \DateTime $modSeccFechaMod
     *
     * @return EavModSeccion
     */
    public function setModSeccFechaMod($modSeccFechaMod)
    {
        $this->modSeccFechaMod = $modSeccFechaMod;

        return $this;
    }

    /**
     * Get modSeccFechaMod
     *
     * @return \DateTime
     */
    public function getModSeccFechaMod()
    {
        return $this->modSeccFechaMod;
    }

    /**
     * Add seccionGrupo
     *
     * @param \AppBundle\Entity\EavModSecGrupo $seccionGrupo
     *
     * @return EavModSeccion
     */
    public function addSeccionGrupo(\AppBundle\Entity\EavModSecGrupo $seccionGrupo)
    {
        $this->seccionGrupo[] = $seccionGrupo;

        return $this;
    }

    /**
     * Remove seccionGrupo
     *
     * @param \AppBundle\Entity\EavModSecGrupo $seccionGrupo
     */
    public function removeSeccionGrupo(\AppBundle\Entity\EavModSecGrupo $seccionGrupo)
    {
        $this->seccionGrupo->removeElement($seccionGrupo);
    }

    /**
     * Get seccionGrupo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeccionGrupo()
    {
        return $this->seccionGrupo;
    }

    /**
     * Set modSeccModId
     *
     * @param \AppBundle\Entity\Modulo $modSeccModId
     *
     * @return EavModSeccion
     */
    public function setModSeccModId(\AppBundle\Entity\Modulo $modSeccModId = null)
    {
        $this->modSeccModId = $modSeccModId;

        return $this;
    }

    /**
     * Get modSeccModId
     *
     * @return \AppBundle\Entity\Modulo
     */
    public function getModSeccModId()
    {
        return $this->modSeccModId;
    }
    /**
     * @var \AppBundle\Entity\Modulo
     */
    private $modSeccMod;


    /**
     * Set modSeccMod
     *
     * @param \AppBundle\Entity\Modulo $modSeccMod
     *
     * @return EavModSeccion
     */
    public function setModSeccMod(\AppBundle\Entity\Modulo $modSeccMod = null)
    {
        $this->modSeccMod = $modSeccMod;

        return $this;
    }

    /**
     * Get modSeccMod
     *
     * @return \AppBundle\Entity\Modulo
     */
    public function getModSeccMod()
    {
        return $this->modSeccMod;
    }
}
