<?php

namespace AppBundle\Entity;

/**
 * MenuRol
 */
class MenuRol
{
    /**
     * @var integer
     */
    private $menRolId;

    /**
     * @var \DateTime
     */
    private $menRolFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $menRolFechaMod;

    /**
     * @var boolean
     */
    private $menRolActivo = '1';

    /**
     * @var \AppBundle\Entity\MenRol
     */
    private $menRolMrol;

    /**
     * @var \AppBundle\Entity\Menu
     */
    private $menRolMen;


    /**
     * Get menRolId
     *
     * @return integer
     */
    public function getMenRolId()
    {
        return $this->menRolId;
    }

    /**
     * Set menRolFechaCrea
     *
     * @param \DateTime $menRolFechaCrea
     *
     * @return MenuRol
     */
    public function setMenRolFechaCrea($menRolFechaCrea)
    {
        $this->menRolFechaCrea = $menRolFechaCrea;

        return $this;
    }

    /**
     * Get menRolFechaCrea
     *
     * @return \DateTime
     */
    public function getMenRolFechaCrea()
    {
        return $this->menRolFechaCrea;
    }

    /**
     * Set menRolFechaMod
     *
     * @param \DateTime $menRolFechaMod
     *
     * @return MenuRol
     */
    public function setMenRolFechaMod($menRolFechaMod)
    {
        $this->menRolFechaMod = $menRolFechaMod;

        return $this;
    }

    /**
     * Get menRolFechaMod
     *
     * @return \DateTime
     */
    public function getMenRolFechaMod()
    {
        return $this->menRolFechaMod;
    }

    /**
     * Set menRolActivo
     *
     * @param boolean $menRolActivo
     *
     * @return MenuRol
     */
    public function setMenRolActivo($menRolActivo)
    {
        $this->menRolActivo = $menRolActivo;

        return $this;
    }

    /**
     * Get menRolActivo
     *
     * @return boolean
     */
    public function getMenRolActivo()
    {
        return $this->menRolActivo;
    }

    /**
     * Set menRolMrol
     *
     * @param \AppBundle\Entity\MenRol $menRolMrol
     *
     * @return MenuRol
     */
    public function setMenRolMrol(\AppBundle\Entity\MenRol $menRolMrol = null)
    {
        $this->menRolMrol = $menRolMrol;

        return $this;
    }

    /**
     * Get menRolMrol
     *
     * @return \AppBundle\Entity\MenRol
     */
    public function getMenRolMrol()
    {
        return $this->menRolMrol;
    }

    /**
     * Set menRolMen
     *
     * @param \AppBundle\Entity\Menu $menRolMen
     *
     * @return MenuRol
     */
    public function setMenRolMen(\AppBundle\Entity\Menu $menRolMen = null)
    {
        $this->menRolMen = $menRolMen;

        return $this;
    }

    /**
     * Get menRolMen
     *
     * @return \AppBundle\Entity\Menu
     */
    public function getMenRolMen()
    {
        return $this->menRolMen;
    }
}

