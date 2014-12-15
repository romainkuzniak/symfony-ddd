<?php

namespace Domain\Model\Sprint;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Model\Issue\Issue;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class Sprint
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $status;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $expectedClosedAt;

    /**
     * @var \DateTime
     */
    protected $effectiveClosedAt;

    /**
     * @var Collection|Issue[]
     */
    protected $issues;

    public function __construct()
    {
        $this->issues = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
    public function getExpectedClosedAt()
    {
        return $this->expectedClosedAt;
    }

    /**
     * @return \DateTime
     */
    public function getEffectiveClosedAt()
    {
        return $this->effectiveClosedAt;
    }

    /**
     * @param Issue $issues
     */
    public function addIssue(Issue $issues)
    {
        $this->issues[] = $issues;
    }

    /**
     * @return Collection
     */
    public function getIssues()
    {
        return $this->issues;
    }

    public function close()
    {
        if ($this->isClosed()) {
            throw new SprintAlreadyClosedException();
        }

        foreach ($this->issues as $issue) {
            if ($issue->isDone()) {
                $issue->close();
            } else {
                $this->issues->removeElement($issue);
            }
        }

        $this->setEffectiveClosedAt(new \DateTime());
        $this->status = SprintStatus::CLOSE;
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return SprintStatus::CLOSE === $this->getStatus();
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function setEffectiveClosedAt(\DateTime $closedAt)
    {
        $this->effectiveClosedAt = $closedAt;
    }
}
