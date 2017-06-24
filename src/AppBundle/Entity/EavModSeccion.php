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
     * @var \AppBundle\Entity\Modulo
     */
    private $modSeccModId;

    
    public function __toString() {
        return $this->modSeccSeccion;
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $modulos;
    
    // ...
    public function addModulo(Modulo $modulo)
    {
        if (!$this->modulos->contains($modulo)) {
            $this->modulos->add($modulo);
        }
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $campos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->campos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add campo
     *
     * @param \AppBundle\Entity\EavModCampos $campo
     *
     * @return EavModSeccion
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
}
