<?php

namespace AppBundle\Entity;
use \Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 */
class Usuario implements UserInterface {

    public function eraseCredentials() {

    }

    public function getPassword() {
        return $this->usuClave;
    }

    public function getRoles() {
        $ROL = [];
        $ROL[] = 'ROLE_USER';

        if ($this->getUsuEsAdmin()) {
            $ROL[] = 'ROLE_ADMIN';
        }

        return $ROL;
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
     * @var string
     */
    private $usuGenero;

    /**
     * @var string
     */
    private $usuNombre;

    /**
     * @var string
     */
    private $usuSegundoNombre;

    /**
     * @var string
     */
    private $usuTercerNombre;

    /**
     * @var string
     */
    private $usuPrimerApellido;

    /**
     * @var string
     */
    private $usuSegundoApellido;

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
     * Set usuGenero
     *
     * @param string $usuGenero
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
     * @return string
     */
    public function getUsuGenero()
    {
        return $this->usuGenero;
    }

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
     * Set usuSegundoNombre
     *
     * @param string $usuSegundoNombre
     *
     * @return Usuario
     */
    public function setUsuSegundoNombre($usuSegundoNombre)
    {
        $this->usuSegundoNombre = $usuSegundoNombre;

        return $this;
    }

    /**
     * Get usuSegundoNombre
     *
     * @return string
     */
    public function getUsuSegundoNombre()
    {
        return $this->usuSegundoNombre;
    }

    /**
     * Set usuTercerNombre
     *
     * @param string $usuTercerNombre
     *
     * @return Usuario
     */
    public function setUsuTercerNombre($usuTercerNombre)
    {
        $this->usuTercerNombre = $usuTercerNombre;

        return $this;
    }

    /**
     * Get usuTercerNombre
     *
     * @return string
     */
    public function getUsuTercerNombre()
    {
        return $this->usuTercerNombre;
    }

    /**
     * Set usuPrimerApellido
     *
     * @param string $usuPrimerApellido
     *
     * @return Usuario
     */
    public function setUsuPrimerApellido($usuPrimerApellido)
    {
        $this->usuPrimerApellido = $usuPrimerApellido;

        return $this;
    }

    /**
     * Get usuPrimerApellido
     *
     * @return string
     */
    public function getUsuPrimerApellido()
    {
        return $this->usuPrimerApellido;
    }

    /**
     * Set usuSegundoApellido
     *
     * @param string $usuSegundoApellido
     *
     * @return Usuario
     */
    public function setUsuSegundoApellido($usuSegundoApellido)
    {
        $this->usuSegundoApellido = $usuSegundoApellido;

        return $this;
    }

    /**
     * Get usuSegundoApellido
     *
     * @return string
     */
    public function getUsuSegundoApellido()
    {
        return $this->usuSegundoApellido;
    }
    /**
     * @var boolean
     */
    private $usuEsAdmin;


    /**
     * Set usuEsAdmin
     *
     * @param boolean $usuEsAdmin
     *
     * @return Usuario
     */
    public function setUsuEsAdmin($usuEsAdmin)
    {
        $this->usuEsAdmin = $usuEsAdmin;

        return $this;
    }

    /**
     * Get usuEsAdmin
     *
     * @return boolean
     */
    public function getUsuEsAdmin()
    {
        return $this->usuEsAdmin;
    }
}
