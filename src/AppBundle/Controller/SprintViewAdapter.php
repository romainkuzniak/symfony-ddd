<?php

namespace AppBundle\Controller;

use Domain\Model\Sprint\Sprint;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class SprintViewAdapter
{

    /**
     * @var Sprint
     */
    private $sprint;

    public function __construct(Sprint $sprint)
    {
        $this->sprint = $sprint;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return null === $this->sprint->getCreatedAt() ? null :
            $this->sprint->getCreatedAt()->format(\DateTime::ISO8601);
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->sprint->getId();
    }

    /**
     * @return \DateTime
     */
    public function getEffectiveClosedAt()
    {
        return null === $this->sprint->getEffectiveClosedAt() ? null :
            $this->sprint->getEffectiveClosedAt()->format(\DateTime::ISO8601);
    }

    /**
     * @return \DateTime
     */
    public function getExpectedClosedAt()
    {
        return null === $this->sprint->getExpectedClosedAt() ? null :
            $this->sprint->getExpectedClosedAt()->format(\DateTime::ISO8601);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->sprint->getStatus();
    }
}
