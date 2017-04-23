<?php

namespace AppBundle\Entity;

/**
 * Usuario
 */
class Usuario implements \Symfony\Component\Security\Core\User\UserInterface
{
    /**
     * @var integer
     */
    private $usuId;

    /**
     * @var string
     */
    private $usuUsuario;

    /**
     * @var string
     */
    private $usuClave;

    /**
     * @var \DateTime
     */
    private $usuFechaRegistro;

    /**
     * @var integer
     */
    private $usuIdVendedor;

    /**
     * @var \DateTime
     */
    private $usuFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $usuFechaMod;

    /**
     * @var boolean
     */
    private $usuActivo = '1';


    /**
     * Get usuId
     *
     * @return integer
     */
    public function getUsuId()
    {
        return $this->usuId;
    }

    /**
     * Set usuUsuario
     *
     * @param string $usuUsuario
     *
     * @return Usuario
     */
    public function setUsuUsuario($usuUsuario)
    {
        $this->usuUsuario = $usuUsuario;

        return $this;
    }

    /**
     * Get usuUsuario
     *
     * @return string
     */
    public function getUsuUsuario()
    {
        return $this->usuUsuario;
    }

    /**
     * Set usuClave
     *
     * @param string $usuClave
     *
     * @return Usuario
     */
    public function setUsuClave($usuClave)
    {
        $this->usuClave = $usuClave;

        return $this;
    }

    /**
     * Get usuClave
     *
     * @return string
     */
    public function getUsuClave()
    {
        return $this->usuClave;
    }

    /**
     * Set usuFechaRegistro
     *
     * @param \DateTime $usuFechaRegistro
     *
     * @return Usuario
     */
    public function setUsuFechaRegistro($usuFechaRegistro)
    {
        $this->usuFechaRegistro = $usuFechaRegistro;

        return $this;
    }

    /**
     * Get usuFechaRegistro
     *
     * @return \DateTime
     */
    public function getUsuFechaRegistro()
    {
        return $this->usuFechaRegistro;
    }

    /**
     * Set usuIdVendedor
     *
     * @param integer $usuIdVendedor
     *
     * @return Usuario
     */
    public function setUsuIdVendedor($usuIdVendedor)
    {
        $this->usuIdVendedor = $usuIdVendedor;

        return $this;
    }

    /**
     * Get usuIdVendedor
     *
     * @return integer
     */
    public function getUsuIdVendedor()
    {
        return $this->usuIdVendedor;
    }

    /**
     * Set usuFechaCrea
     *
     * @param \DateTime $usuFechaCrea
     *
     * @return Usuario
     */
    public function setUsuFechaCrea($usuFechaCrea)
    {
        $this->usuFechaCrea = $usuFechaCrea;

        return $this;
    }

    /**
     * Get usuFechaCrea
     *
     * @return \DateTime
     */
    public function getUsuFechaCrea()
    {
        return $this->usuFechaCrea;
    }

    /**
     * Set usuFechaMod
     *
     * @param \DateTime $usuFechaMod
     *
     * @return Usuario
     */
    public function setUsuFechaMod($usuFechaMod)
    {
        $this->usuFechaMod = $usuFechaMod;

        return $this;
    }

    /**
     * Get usuFechaMod
     *
     * @return \DateTime
     */
    public function getUsuFechaMod()
    {
        return $this->usuFechaMod;
    }

    /**
     * Set usuActivo
     *
     * @param boolean $usuActivo
     *
     * @return Usuario
     */
    public function setUsuActivo($usuActivo)
    {
        $this->usuActivo = $usuActivo;

        return $this;
    }

    /**
     * Get usuActivo
     *
     * @return boolean
     */
    public function getUsuActivo()
    {
        return $this->usuActivo;
    }

    public function eraseCredentials() {

    }

    public function getPassword() {
        return $this->usuClave;
    }

    public function getRoles() {
        return array('ROLE_USER');
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        return $this->usuUsuario;
    }
	
	public function __toString() {
		return $this->usuUsuario;
	}
    /**
     * @var string
     */
    private $usuTitulo;

    /**
     * @var integer
     */
    private $usuGenero;


    /**
     * Set usuTitulo
     *
     * @param string $usuTitulo
     *
     * @return Usuario
     */
    public function setUsuTitulo($usuTitulo)
    {
        $this->usuTitulo = $usuTitulo;

        return $this;
    }

    /**
     * Get usuTitulo
     *
     * @return string
     */
    public function getUsuTitulo()
    {
        return $this->usuTitulo;
    }

    /**
     * Set usuGenero
     *
     * @param integer $usuGenero
     *
     * @return Usuario
     */
    public function setUsuGenero($usuGenero)
    {
        $this->usuGenero = $usuGenero;

        return $this;
    }

    /**
     * Get usuGenero
     *
     * @return integer
     */
    public function getUsuGenero()
    {
        return $this->usuGenero;
    }
    /**
     * @var \DateTime
     */
    private $usuFechaNacimiento;


    /**
     * Set usuFechaNacimiento
     *
     * @param \DateTime $usuFechaNacimiento
     *
     * @return Usuario
     */
    public function setUsuFechaNacimiento($usuFechaNacimiento)
    {
        $this->usuFechaNacimiento = $usuFechaNacimiento;

        return $this;
    }

    /**
     * Get usuFechaNacimiento
     *
     * @return \DateTime
     */
    public function getUsuFechaNacimiento()
    {
        return $this->usuFechaNacimiento;
    }
    /**
     * @var string
     */
    private $usuNombre;


    /**
     * Set usuNombre
     *
     * @param string $usuNombre
     *
     * @return Usuario
     */
    public function setUsuNombre($usuNombre)
    {
        $this->usuNombre = $usuNombre;

        return $this;
    }

    /**
     * Get usuNombre
     *
     * @return string
     */
    public function getUsuNombre()
    {
        return $this->usuNombre;
    }
    /**
     * @var string
     */
    private $usuCorreo;

    /**
     * @var \AppBundle\Entity\UsuarioInformacion
     */
    private $cliTipCli;


    /**
     * Set usuCorreo
     *
     * @param string $usuCorreo
     *
     * @return Usuario
     */
    public function setUsuCorreo($usuCorreo)
    {
        $this->usuCorreo = $usuCorreo;

        return $this;
    }

    /**
     * Get usuCorreo
     *
     * @return string
     */
    public function getUsuCorreo()
    {
        return $this->usuCorreo;
    }

    /**
     * Set cliTipCli
     *
     * @param \AppBundle\Entity\UsuarioInformacion $cliTipCli
     *
     * @return Usuario
     */
    public function setCliTipCli(\AppBundle\Entity\UsuarioInformacion $cliTipCli = null)
    {
        $this->cliTipCli = $cliTipCli;

        return $this;
    }

    /**
     * Get cliTipCli
     *
     * @return \AppBundle\Entity\UsuarioInformacion
     */
    public function getCliTipCli()
    {
        return $this->cliTipCli;
    }
    /**
     * @var \AppBundle\Entity\UsuarioInformacion
     */
    private $usuInformacion;


    /**
     * Set usuInformacion
     *
     * @param \AppBundle\Entity\UsuarioInformacion $usuInformacion
     *
     * @return Usuario
     */
    public function setUsuInformacion(\AppBundle\Entity\UsuarioInformacion $usuInformacion = null)
    {
        $this->usuInformacion = $usuInformacion;

        return $this;
    }

    /**
     * Get usuInformacion
     *
     * @return \AppBundle\Entity\UsuarioInformacion
     */
    public function getUsuInformacion()
    {
        return $this->usuInformacion;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $groups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add group
     *
     * @param \AppBundle\Entity\Especialidad $group
     *
     * @return Usuario
     */
    public function addGroup(\AppBundle\Entity\Especialidad $group)
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param \AppBundle\Entity\Especialidad $group
     */
    public function removeGroup(\AppBundle\Entity\Especialidad $group)
    {
        $this->groups->removeElement($group);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rol;


    /**
     * Add rol
     *
     * @param \AppBundle\Entity\Rol $rol
     *
     * @return Usuario
     */
    public function addRol(\AppBundle\Entity\Rol $rol)
    {
        $this->rol[] = $rol;

        return $this;
    }

    /**
     * Remove rol
     *
     * @param \AppBundle\Entity\Rol $rol
     */
    public function removeRol(\AppBundle\Entity\Rol $rol)
    {
        $this->rol->removeElement($rol);
    }

    /**
     * Get rol
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRol()
    {
        return $this->rol;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idEspecialidad;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idRol;


    /**
     * Add idEspecialidad
     *
     * @param \AppBundle\Entity\Especialidad $idEspecialidad
     *
     * @return Usuario
     */
    public function addIdEspecialidad(\AppBundle\Entity\Especialidad $idEspecialidad)
    {
        $this->idEspecialidad[] = $idEspecialidad;

        return $this;
    }

    /**
     * Remove idEspecialidad
     *
     * @param \AppBundle\Entity\Especialidad $idEspecialidad
     */
    public function removeIdEspecialidad(\AppBundle\Entity\Especialidad $idEspecialidad)
    {
        $this->idEspecialidad->removeElement($idEspecialidad);
    }

    /**
     * Get idEspecialidad
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdEspecialidad()
    {
        return $this->idEspecialidad;
    }

    /**
     * Add idRol
     *
     * @param \AppBundle\Entity\Rol $idRol
     *
     * @return Usuario
     */
    public function addIdRol(\AppBundle\Entity\Rol $idRol)
    {
        $this->idRol[] = $idRol;

        return $this;
    }

    /**
     * Remove idRol
     *
     * @param \AppBundle\Entity\Rol $idRol
     */
    public function removeIdRol(\AppBundle\Entity\Rol $idRol)
    {
        $this->idRol->removeElement($idRol);
    }

    /**
     * Get idRol
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdRol()
    {
        return $this->idRol;
    }
}
