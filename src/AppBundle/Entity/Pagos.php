<?php

namespace AppBundle\Entity;

/**
 * Pagos
 */
class Pagos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $phEmail;

    /**
     * @var string
     */
    private $phPicture;

    /**
     * @var string
     */
    private $phText;

    /**
     * @var string
     */
    private $phLink;

    /**
     * @var \DateTime
     */
    private $phCreatedAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $phUpdatedAt = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $phActive;

    /**
     * @var float
     */
    private $phPayed;

    /**
     * @var string
     */
    private $phIdPayer;

    /**
     * @var string
     */
    private $phIdTransaction;

    /**
     * @var string
     */
    private $phIdToken;

    /**
     * @var string
     */
    private $phHttpParsedResponse;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set phEmail
     *
     * @param string $phEmail
     *
     * @return Pagos
     */
    public function setPhEmail($phEmail)
    {
        $this->phEmail = $phEmail;

        return $this;
    }

    /**
     * Get phEmail
     *
     * @return string
     */
    public function getPhEmail()
    {
        return $this->phEmail;
    }

    /**
     * Set phPicture
     *
     * @param string $phPicture
     *
     * @return Pagos
     */
    public function setPhPicture($phPicture)
    {
        $this->phPicture = $phPicture;

        return $this;
    }

    /**
     * Get phPicture
     *
     * @return string
     */
    public function getPhPicture()
    {
        return $this->phPicture;
    }

    /**
     * Set phText
     *
     * @param string $phText
     *
     * @return Pagos
     */
    public function setPhText($phText)
    {
        $this->phText = $phText;

        return $this;
    }

    /**
     * Get phText
     *
     * @return string
     */
    public function getPhText()
    {
        return $this->phText;
    }

    /**
     * Set phLink
     *
     * @param string $phLink
     *
     * @return Pagos
     */
    public function setPhLink($phLink)
    {
        $this->phLink = $phLink;

        return $this;
    }

    /**
     * Get phLink
     *
     * @return string
     */
    public function getPhLink()
    {
        return $this->phLink;
    }

    /**
     * Set phCreatedAt
     *
     * @param \DateTime $phCreatedAt
     *
     * @return Pagos
     */
    public function setPhCreatedAt($phCreatedAt)
    {
        $this->phCreatedAt = $phCreatedAt;

        return $this;
    }

    /**
     * Get phCreatedAt
     *
     * @return \DateTime
     */
    public function getPhCreatedAt()
    {
        return $this->phCreatedAt;
    }

    /**
     * Set phUpdatedAt
     *
     * @param \DateTime $phUpdatedAt
     *
     * @return Pagos
     */
    public function setPhUpdatedAt($phUpdatedAt)
    {
        $this->phUpdatedAt = $phUpdatedAt;

        return $this;
    }

    /**
     * Get phUpdatedAt
     *
     * @return \DateTime
     */
    public function getPhUpdatedAt()
    {
        return $this->phUpdatedAt;
    }

    /**
     * Set phActive
     *
     * @param boolean $phActive
     *
     * @return Pagos
     */
    public function setPhActive($phActive)
    {
        $this->phActive = $phActive;

        return $this;
    }

    /**
     * Get phActive
     *
     * @return boolean
     */
    public function getPhActive()
    {
        return $this->phActive;
    }

    /**
     * Set phPayed
     *
     * @param float $phPayed
     *
     * @return Pagos
     */
    public function setPhPayed($phPayed)
    {
        $this->phPayed = $phPayed;

        return $this;
    }

    /**
     * Get phPayed
     *
     * @return float
     */
    public function getPhPayed()
    {
        return $this->phPayed;
    }

    /**
     * Set phIdPayer
     *
     * @param string $phIdPayer
     *
     * @return Pagos
     */
    public function setPhIdPayer($phIdPayer)
    {
        $this->phIdPayer = $phIdPayer;

        return $this;
    }

    /**
     * Get phIdPayer
     *
     * @return string
     */
    public function getPhIdPayer()
    {
        return $this->phIdPayer;
    }

    /**
     * Set phIdTransaction
     *
     * @param string $phIdTransaction
     *
     * @return Pagos
     */
    public function setPhIdTransaction($phIdTransaction)
    {
        $this->phIdTransaction = $phIdTransaction;

        return $this;
    }

    /**
     * Get phIdTransaction
     *
     * @return string
     */
    public function getPhIdTransaction()
    {
        return $this->phIdTransaction;
    }

    /**
     * Set phIdToken
     *
     * @param string $phIdToken
     *
     * @return Pagos
     */
    public function setPhIdToken($phIdToken)
    {
        $this->phIdToken = $phIdToken;

        return $this;
    }

    /**
     * Get phIdToken
     *
     * @return string
     */
    public function getPhIdToken()
    {
        return $this->phIdToken;
    }

    /**
     * Set phHttpParsedResponse
     *
     * @param string $phHttpParsedResponse
     *
     * @return Pagos
     */
    public function setPhHttpParsedResponse($phHttpParsedResponse)
    {
        $this->phHttpParsedResponse = $phHttpParsedResponse;

        return $this;
    }

    /**
     * Get phHttpParsedResponse
     *
     * @return string
     */
    public function getPhHttpParsedResponse()
    {
        return $this->phHttpParsedResponse;
    }
    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $cli;


    /**
     * Set cli
     *
     * @param \AppBundle\Entity\Cliente $cli
     *
     * @return Pagos
     */
    public function setCli(\AppBundle\Entity\Cliente $cli = null)
    {
        $this->cli = $cli;

        return $this;
    }

    /**
     * Get cli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCli()
    {
        return $this->cli;
    }
}
