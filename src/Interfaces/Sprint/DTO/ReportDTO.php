<?php

namespace Interfaces\Sprint\DTO;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class ReportDTO
{

    /**
     * @var int
     */
    public $sprintId;

    /**
     * @var float
     */
    public $averageClosedIssues;

    /**
     * @var int
     */
    public $closedIssuesCount;

    public function __construct(array $report)
    {
        $this->averageClosedIssues = $report['averageClosedIssues'];
        $this->closedIssuesCount = $report['closedIssuesCount'];
        $this->sprintId = $report['sprintId'];
    }

    /**
     * @return float
     */
    public function getAverageClosedIssues()
    {
        return $this->averageClosedIssues;
    }

    /**
     * @return int
     */
    public function getClosedIssuesCount()
    {
        return $this->closedIssuesCount;
    }

    /**
     * @return int
     */
    public function getSprintId()
    {
        return $this->sprintId;
    }
}
