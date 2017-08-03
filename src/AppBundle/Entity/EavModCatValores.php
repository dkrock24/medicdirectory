<?php

namespace AppBundle\Entity;

/**
 * EavModCatValores
 */
class EavModCatValores
{
    /**
     * @var integer
     */
    private $modCatValId;

    /**
     * @var integer
     */
    private $modCatValCampId;

    /**
     * @var string
     */
    private $modCatValValor;

    /**
     * @var integer
     */
    private $modCatValCatValPadre;

    /**
     * @var integer
     */
    private $modCatValActivo;

    /**
     * @var \DateTime
     */
    private $modCatValFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $modCatValFechaMod;

    /**
     * @var \AppBundle\Entity\EavModCampos
     */
    private $ModCampos;


    /**
     * Get modCatValId
     *
     * @return integer
     */
    public function getModCatValId()
    {
        return $this->modCatValId;
    }

    /**
     * Set modCatValCampId
     *
     * @param integer $modCatValCampId
     *
     * @return EavModCatValores
     */
    public function setModCatValCampId($modCatValCampId)
    {
        $this->modCatValCampId = $modCatValCampId;

        return $this;
    }

    /**
     * Get modCatValCampId
     *
     * @return integer
     */
    public function getModCatValCampId()
    {
        return $this->modCatValCampId;
    }

    /**
     * Set modCatValValor
     *
     * @param string $modCatValValor
     *
     * @return EavModCatValores
     */
    public function setModCatValValor($modCatValValor)
    {
        $this->modCatValValor = $modCatValValor;

        return $this;
    }

    /**
     * Get modCatValValor
     *
     * @return string
     */
    public function getModCatValValor()
    {
        return $this->modCatValValor;
    }

    /**
     * Set modCatValCatValPadre
     *
     * @param integer $modCatValCatValPadre
     *
     * @return EavModCatValores
     */
    public function setModCatValCatValPadre($modCatValCatValPadre)
    {
        $this->modCatValCatValPadre = $modCatValCatValPadre;

        return $this;
    }

    /**
     * Get modCatValCatValPadre
     *
     * @return integer
     */
    public function getModCatValCatValPadre()
    {
        return $this->modCatValCatValPadre;
    }

    /**
     * Set modCatValActivo
     *
     * @param integer $modCatValActivo
     *
     * @return EavModCatValores
     */
    public function setModCatValActivo($modCatValActivo)
    {
        $this->modCatValActivo = $modCatValActivo;

        return $this;
    }

    /**
     * Get modCatValActivo
     *
     * @return integer
     */
    public function getModCatValActivo()
    {
        return $this->modCatValActivo;
    }

    /**
     * Set modCatValFechaCrea
     *
     * @param \DateTime $modCatValFechaCrea
     *
     * @return EavModCatValores
     */
    public function setModCatValFechaCrea($modCatValFechaCrea)
    {
        $this->modCatValFechaCrea = $modCatValFechaCrea;

        return $this;
    }

    /**
     * Get modCatValFechaCrea
     *
     * @return \DateTime
     */
    public function getModCatValFechaCrea()
    {
        return $this->modCatValFechaCrea;
    }

    /**
     * Set modCatValFechaMod
     *
     * @param \DateTime $modCatValFechaMod
     *
     * @return EavModCatValores
     */
    public function setModCatValFechaMod($modCatValFechaMod)
    {
        $this->modCatValFechaMod = $modCatValFechaMod;

        return $this;
    }

    /**
     * Get modCatValFechaMod
     *
     * @return \DateTime
     */
    public function getModCatValFechaMod()
    {
        return $this->modCatValFechaMod;
    }

    /**
     * Set modCampos
     *
     * @param \AppBundle\Entity\EavModCampos $modCampos
     *
     * @return EavModCatValores
     */
    public function setModCampos(\AppBundle\Entity\EavModCampos $modCampos = null)
    {
        $this->ModCampos = $modCampos;

        return $this;
    }

    /**
     * Get modCampos
     *
     * @return \AppBundle\Entity\EavModCampos
     */
    public function getModCampos()
    {
        return $this->ModCampos;
    }
    /**
     * @var \AppBundle\Entity\EavModCampos
     */
    private $modCatValCamp;


    /**
     * Set modCatValCamp
     *
     * @param \AppBundle\Entity\EavModCampos $modCatValCamp
     *
     * @return EavModCatValores
     */
    public function setModCatValCamp(\AppBundle\Entity\EavModCampos $modCatValCamp = null)
    {
        $this->modCatValCamp = $modCatValCamp;

        return $this;
    }

    /**
     * Get modCatValCamp
     *
     * @return \AppBundle\Entity\EavModCampos
     */
    public function getModCatValCamp()
    {
        return $this->modCatValCamp;
    }
}
