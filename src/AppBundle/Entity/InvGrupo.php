<?php

namespace AppBundle\Entity;

/**
 * InvGrupo
 */
class InvGrupo
{
    /**
     * @var integer
     */
    private $igrId;

    /**
     * @var string
     */
    private $igrGrupo;

    /**
     * @var \DateTime
     */
    private $igrFechaCreacion = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $igrFechaMod;

    /**
     * @var boolean
     */
    private $igrActivo = '1';


    /**
     * Get igrId
     *
     * @return integer
     */
    public function getIgrId()
    {
        return $this->igrId;
    }

    /**
     * Set igrGrupo
     *
     * @param string $igrGrupo
     *
     * @return InvGrupo
     */
    public function setIgrGrupo($igrGrupo)
    {
        $this->igrGrupo = $igrGrupo;

        return $this;
    }

    /**
     * Get igrGrupo
     *
     * @return string
     */
    public function getIgrGrupo()
    {
        return $this->igrGrupo;
    }

    /**
     * Set igrFechaCreacion
     *
     * @param \DateTime $igrFechaCreacion
     *
     * @return InvGrupo
     */
    public function setIgrFechaCreacion($igrFechaCreacion)
    {
        $this->igrFechaCreacion = $igrFechaCreacion;

        return $this;
    }

    /**
     * Get igrFechaCreacion
     *
     * @return \DateTime
     */
    public function getIgrFechaCreacion()
    {
        return $this->igrFechaCreacion;
    }

    /**
     * Set igrFechaMod
     *
     * @param \DateTime $igrFechaMod
     *
     * @return InvGrupo
     */
    public function setIgrFechaMod($igrFechaMod)
    {
        $this->igrFechaMod = $igrFechaMod;

        return $this;
    }

    /**
     * Get igrFechaMod
     *
     * @return \DateTime
     */
    public function getIgrFechaMod()
    {
        return $this->igrFechaMod;
    }

    /**
     * Set igrActivo
     *
     * @param boolean $igrActivo
     *
     * @return InvGrupo
     */
    public function setIgrActivo($igrActivo)
    {
        $this->igrActivo = $igrActivo;

        return $this;
    }

    /**
     * Get igrActivo
     *
     * @return boolean
     */
    public function getIgrActivo()
    {
        return $this->igrActivo;
    }
}

