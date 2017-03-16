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

    public function getPassword(): string {
        return $this->usuClave;
    }

    public function getRoles() {
        return array('ROLE_USER');
    }

    public function getSalt() {
        
    }

    public function getUsername(): string {
        return $this->usuUsuario;
    }
}
