<?php
use Doctrine\ORM\EntityManager;

class TaskType extends AbstractType
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    // ...
}