<?php

namespace Interfaces\Sprint\DTO;

use Domain\Model\Sprint\Sprint;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class SprintDTO
{

    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $status;

    /**
     * @var \DateTime
     */
    public $createdAt;

    /**
     * @var \DateTime
     */
    public $expectedClosedAt;

    /**
     * @var \DateTime
     */
    public $effectiveClosedAt;

    public function __construct(Sprint $sprint)
    {
        $this->createdAt = $sprint->getCreatedAt()->format(\DateTime::ISO8601);
        if (null !== $sprint->getEffectiveClosedAt()) {
            $this->effectiveClosedAt = $sprint->getEffectiveClosedAt()->format(\DateTime::ISO8601);
        }
        $this->expectedClosedAt = $sprint->getExpectedClosedAt()->format(\DateTime::ISO8601);
        $this->id = $sprint->getId();
        $this->status = $sprint->getStatus();
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getEffectiveClosedAt()
    {
        return $this->effectiveClosedAt;
    }

    /**
     * @return \DateTime
     */
    public function getExpectedClosedAt()
    {
        return $this->expectedClosedAt;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}
