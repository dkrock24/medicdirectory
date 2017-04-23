<?php

namespace AppBundle\Entity;

/**
 * Rol
 */
class Rol
{
    /**
     * @var integer
     */
    private $rolId;

    /**
     * @var string
     */
    private $rolRol;

    /**
     * @var \DateTime
     */
    private $rolFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $rolFechaMod;

    /**
     * @var boolean
     */
    private $rolActivo = '1';


    /**
     * Get rolId
     *
     * @return integer
     */
    public function getRolId()
    {
        return $this->rolId;
    }

    /**
     * Set rolRol
     *
     * @param string $rolRol
     *
     * @return Rol
     */
    public function setRolRol($rolRol)
    {
        $this->rolRol = $rolRol;

        return $this;
    }

    /**
     * Get rolRol
     *
     * @return string
     */
    public function getRolRol()
    {
        return $this->rolRol;
    }

    /**
     * Set rolFechaCrea
     *
     * @param \DateTime $rolFechaCrea
     *
     * @return Rol
     */
    public function setRolFechaCrea($rolFechaCrea)
    {
        $this->rolFechaCrea = $rolFechaCrea;

        return $this;
    }

    /**
     * Get rolFechaCrea
     *
     * @return \DateTime
     */
    public function getRolFechaCrea()
    {
        return $this->rolFechaCrea;
    }

    /**
     * Set rolFechaMod
     *
     * @param \DateTime $rolFechaMod
     *
     * @return Rol
     */
    public function setRolFechaMod($rolFechaMod)
    {
        $this->rolFechaMod = $rolFechaMod;

        return $this;
    }

    /**
     * Get rolFechaMod
     *
     * @return \DateTime
     */
    public function getRolFechaMod()
    {
        return $this->rolFechaMod;
    }

    /**
     * Set rolActivo
     *
     * @param boolean $rolActivo
     *
     * @return Rol
     */
    public function setRolActivo($rolActivo)
    {
        $this->rolActivo = $rolActivo;

        return $this;
    }

    /**
     * Get rolActivo
     *
     * @return boolean
     */
    public function getRolActivo()
    {
        return $this->rolActivo;
    }
	
	public function __toString() {
		return $this->rolRol;
	}
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idUsuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUsuario = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add idUsuario
     *
     * @param \AppBundle\Entity\Usuario $idUsuario
     *
     * @return Rol
     */
    public function addIdUsuario(\AppBundle\Entity\Usuario $idUsuario)
    {
        $this->idUsuario[] = $idUsuario;

        return $this;
    }

    /**
     * Remove idUsuario
     *
     * @param \AppBundle\Entity\Usuario $idUsuario
     */
    public function removeIdUsuario(\AppBundle\Entity\Usuario $idUsuario)
    {
        $this->idUsuario->removeElement($idUsuario);
    }

    /**
     * Get idUsuario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
