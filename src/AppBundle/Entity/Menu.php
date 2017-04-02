<?php

namespace AppBundle\Entity;

/**
 * Menu
 */
class Menu
{
    /**
     * @var integer
     */
    private $menId;

    /**
     * @var string
     */
    private $menNombre;

    /**
     * @var string
     */
    private $menIcono;

    /**
     * @var string
     */
    private $menEnlace;

    /**
     * @var integer
     */
    private $menOrden;

    /**
     * @var boolean
     */
    private $menBackend;

    /**
     * @var \DateTime
     */
    private $menFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $menFechaMod;

    /**
     * @var boolean
     */
    private $menActivo;

    /**
     * @var \AppBundle\Entity\Menu
     */
    private $menPadre;


    /**
     * Get menId
     *
     * @return integer
     */
    public function getMenId()
    {
        return $this->menId;
    }

    /**
     * Set menNombre
     *
     * @param string $menNombre
     *
     * @return Menu
     */
    public function setMenNombre($menNombre)
    {
        $this->menNombre = $menNombre;

        return $this;
    }

    /**
     * Get menNombre
     *
     * @return string
     */
    public function getMenNombre()
    {
        return $this->menNombre;
    }

    /**
     * Set menIcono
     *
     * @param string $menIcono
     *
     * @return Menu
     */
    public function setMenIcono($menIcono)
    {
        $this->menIcono = $menIcono;

        return $this;
    }

    /**
     * Get menIcono
     *
     * @return string
     */
    public function getMenIcono()
    {
        return $this->menIcono;
    }

    /**
     * Set menEnlace
     *
     * @param string $menEnlace
     *
     * @return Menu
     */
    public function setMenEnlace($menEnlace)
    {
        $this->menEnlace = $menEnlace;

        return $this;
    }

    /**
     * Get menEnlace
     *
     * @return string
     */
    public function getMenEnlace()
    {
        return $this->menEnlace;
    }

    /**
     * Set menOrden
     *
     * @param integer $menOrden
     *
     * @return Menu
     */
    public function setMenOrden($menOrden)
    {
        $this->menOrden = $menOrden;

        return $this;
    }

    /**
     * Get menOrden
     *
     * @return integer
     */
    public function getMenOrden()
    {
        return $this->menOrden;
    }

    /**
     * Set menBackend
     *
     * @param boolean $menBackend
     *
     * @return Menu
     */
    public function setMenBackend($menBackend)
    {
        $this->menBackend = $menBackend;

        return $this;
    }

    /**
     * Get menBackend
     *
     * @return boolean
     */
    public function getMenBackend()
    {
        return $this->menBackend;
    }

    /**
     * Set menFechaCrea
     *
     * @param \DateTime $menFechaCrea
     *
     * @return Menu
     */
    public function setMenFechaCrea($menFechaCrea)
    {
        $this->menFechaCrea = $menFechaCrea;

        return $this;
    }

    /**
     * Get menFechaCrea
     *
     * @return \DateTime
     */
    public function getMenFechaCrea()
    {
        return $this->menFechaCrea;
    }

    /**
     * Set menFechaMod
     *
     * @param \DateTime $menFechaMod
     *
     * @return Menu
     */
    public function setMenFechaMod($menFechaMod)
    {
        $this->menFechaMod = $menFechaMod;

        return $this;
    }

    /**
     * Get menFechaMod
     *
     * @return \DateTime
     */
    public function getMenFechaMod()
    {
        return $this->menFechaMod;
    }

    /**
     * Set menActivo
     *
     * @param boolean $menActivo
     *
     * @return Menu
     */
    public function setMenActivo($menActivo)
    {
        $this->menActivo = $menActivo;

        return $this;
    }

    /**
     * Get menActivo
     *
     * @return boolean
     */
    public function getMenActivo()
    {
        return $this->menActivo;
    }

    /**
     * Set menPadre
     *
     * @param \AppBundle\Entity\Menu $menPadre
     *
     * @return Menu
     */
    public function setMenPadre(\AppBundle\Entity\Menu $menPadre = null)
    {
        $this->menPadre = $menPadre;

        return $this;
    }

    /**
     * Get menPadre
     *
     * @return \AppBundle\Entity\Menu
     */
    public function getMenPadre()
    {
        return $this->menPadre;
    }
	
	
	public function __toString() {
		return $this->menNombre;
	}
}
