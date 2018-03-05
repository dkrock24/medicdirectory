<?php

namespace AppBundle\Entity;

/**
 * TmpPagos
 */
class TmpPagos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $tmpIdToken;

    /**
     * @var string
     */
    private $tmpEmail;

    /**
     * @var string
     */
    private $tmpPicture;

    /**
     * @var string
     */
    private $tmpText;

    /**
     * @var string
     */
    private $tmpLink;

    /**
     * @var \DateTime
     */
    private $tmpCreatedAt;

    /**
     * @var boolean
     */
    private $tmpComplete;


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
     * Set tmpIdToken
     *
     * @param string $tmpIdToken
     *
     * @return TmpPagos
     */
    public function setTmpIdToken($tmpIdToken)
    {
        $this->tmpIdToken = $tmpIdToken;

        return $this;
    }

    /**
     * Get tmpIdToken
     *
     * @return string
     */
    public function getTmpIdToken()
    {
        return $this->tmpIdToken;
    }

    /**
     * Set tmpEmail
     *
     * @param string $tmpEmail
     *
     * @return TmpPagos
     */
    public function setTmpEmail($tmpEmail)
    {
        $this->tmpEmail = $tmpEmail;

        return $this;
    }

    /**
     * Get tmpEmail
     *
     * @return string
     */
    public function getTmpEmail()
    {
        return $this->tmpEmail;
    }

    /**
     * Set tmpPicture
     *
     * @param string $tmpPicture
     *
     * @return TmpPagos
     */
    public function setTmpPicture($tmpPicture)
    {
        $this->tmpPicture = $tmpPicture;

        return $this;
    }

    /**
     * Get tmpPicture
     *
     * @return string
     */
    public function getTmpPicture()
    {
        return $this->tmpPicture;
    }

    /**
     * Set tmpText
     *
     * @param string $tmpText
     *
     * @return TmpPagos
     */
    public function setTmpText($tmpText)
    {
        $this->tmpText = $tmpText;

        return $this;
    }

    /**
     * Get tmpText
     *
     * @return string
     */
    public function getTmpText()
    {
        return $this->tmpText;
    }

    /**
     * Set tmpLink
     *
     * @param string $tmpLink
     *
     * @return TmpPagos
     */
    public function setTmpLink($tmpLink)
    {
        $this->tmpLink = $tmpLink;

        return $this;
    }

    /**
     * Get tmpLink
     *
     * @return string
     */
    public function getTmpLink()
    {
        return $this->tmpLink;
    }

    /**
     * Set tmpCreatedAt
     *
     * @param \DateTime $tmpCreatedAt
     *
     * @return TmpPagos
     */
    public function setTmpCreatedAt($tmpCreatedAt)
    {
        $this->tmpCreatedAt = $tmpCreatedAt;

        return $this;
    }

    /**
     * Get tmpCreatedAt
     *
     * @return \DateTime
     */
    public function getTmpCreatedAt()
    {
        return $this->tmpCreatedAt;
    }

    /**
     * Set tmpComplete
     *
     * @param boolean $tmpComplete
     *
     * @return TmpPagos
     */
    public function setTmpComplete($tmpComplete)
    {
        $this->tmpComplete = $tmpComplete;

        return $this;
    }

    /**
     * Get tmpComplete
     *
     * @return boolean
     */
    public function getTmpComplete()
    {
        return $this->tmpComplete;
    }
    /**
     * @var boolean
     */
    private $tmpCompleted;


    /**
     * Set tmpCompleted
     *
     * @param boolean $tmpCompleted
     *
     * @return TmpPagos
     */
    public function setTmpCompleted($tmpCompleted)
    {
        $this->tmpCompleted = $tmpCompleted;

        return $this;
    }

    /**
     * Get tmpCompleted
     *
     * @return boolean
     */
    public function getTmpCompleted()
    {
        return $this->tmpCompleted;
    }
}
