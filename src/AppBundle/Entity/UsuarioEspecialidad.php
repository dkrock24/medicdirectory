<?php

namespace AppBundle\Entity;

/**
 * UsuarioEspecialidad
 */
class UsuarioEspecialidad
{
    /**
     * @var integer
     */
    private $UsuEspId;

    /**
     * @var \DateTime
     */
    private $UsuEspFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $UsuEspFechaMod;

    /**
     * @var boolean
     */
    private $UsuEspActivo = '1';

    /**
     * @var Text
     */
    private $UsuDescripcion;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $UsuEspUsu;

    /**
     * @var \AppBundle\Entity\Especialidad
     */
    private $UsuEspEsp;


    /**
     * Get usuEspId
     *
     * @return integer
     */
    public function getUsuEspId()
    {
        return $this->UsuEspId;
    }

    /**
     * Set usuEspFechaCrea
     *
     * @param \DateTime $usuEspFechaCrea
     *
     * @return UsuarioEspecialidad
     */
    public function setUsuEspFechaCrea($usuEspFechaCrea)
    {
        $this->UsuEspFechaCrea = $usuEspFechaCrea;

        return $this;
    }

    /**
     * Get usuEspFechaCrea
     *
     * @return \DateTime
     */
    public function getUsuEspFechaCrea()
    {
        return $this->UsuEspFechaCrea;
    }

    /**
     * Set usuEspFechaMod
     *
     * @param \DateTime $usuEspFechaMod
     *
     * @return UsuarioEspecialidad
     */
    public function setUsuEspFechaMod($usuEspFechaMod)
    {
        $this->UsuEspFechaMod = $usuEspFechaMod;

        return $this;
    }

    /**
     * Get usuEspFechaMod
     *
     * @return \DateTime
     */
    public function getUsuEspFechaMod()
    {
        return $this->UsuEspFechaMod;
    }

    /**
     * Set usuEspActivo
     *
     * @param boolean $usuEspActivo
     *
     * @return UsuarioEspecialidad
     */
    public function setUsuEspActivo($usuEspActivo)
    {
        $this->UsuEspActivo = $usuEspActivo;

        return $this;
    }

    /**
     * Get usuEspActivo
     *
     * @return boolean
     */
    public function getUsuEspActivo()
    {
        return $this->UsuEspActivo;
    }

    /**
     * Set usuDescripcion
     *
     * @param \Text $usuDescripcion
     *
     * @return UsuarioEspecialidad
     */
    public function setUsuDescripcion(\Text $usuDescripcion)
    {
        $this->UsuDescripcion = $usuDescripcion;

        return $this;
    }

    /**
     * Get usuDescripcion
     *
     * @return \Text
     */
    public function getUsuDescripcion()
    {
        return $this->UsuDescripcion;
    }

    /**
     * Set usuEspUsu
     *
     * @param \AppBundle\Entity\Usuario $usuEspUsu
     *
     * @return UsuarioEspecialidad
     */
    public function setUsuEspUsu(\AppBundle\Entity\Usuario $usuEspUsu = null)
    {
        $this->UsuEspUsu = $usuEspUsu;

        return $this;
    }

    /**
     * Get usuEspUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuEspUsu()
    {
        return $this->UsuEspUsu;
    }

    /**
     * Set usuEspEsp
     *
     * @param \AppBundle\Entity\Especialidad $usuEspEsp
     *
     * @return UsuarioEspecialidad
     */
    public function setUsuEspEsp(\AppBundle\Entity\Especialidad $usuEspEsp = null)
    {
        $this->UsuEspEsp = $usuEspEsp;

        return $this;
    }

    /**
     * Get usuEspEsp
     *
     * @return \AppBundle\Entity\Especialidad
     */
    public function getUsuEspEsp()
    {
        return $this->UsuEspEsp;
    }
    /**
     * @var integer
     */
    private $idUsuEsp;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \AppBundle\Entity\Especialidad
     */
    private $idEspecialidad;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $idUsuario;


    /**
     * Get idUsuEsp
     *
     * @return integer
     */
    public function getIdUsuEsp()
    {
        return $this->idUsuEsp;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return UsuarioEspecialidad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idEspecialidad
     *
     * @param \AppBundle\Entity\Especialidad $idEspecialidad
     *
     * @return UsuarioEspecialidad
     */
    public function setIdEspecialidad(\AppBundle\Entity\Especialidad $idEspecialidad = null)
    {
        $this->idEspecialidad = $idEspecialidad;

        return $this;
    }

    /**
     * Get idEspecialidad
     *
     * @return \AppBundle\Entity\Especialidad
     */
    public function getIdEspecialidad()
    {
        return $this->idEspecialidad;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\Usuario $idUsuario
     *
     * @return UsuarioEspecialidad
     */
    public function setIdUsuario(\AppBundle\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
