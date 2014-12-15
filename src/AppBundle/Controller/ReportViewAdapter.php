<?php

namespace AppBundle\Controller;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class ReportViewAdapter
{

    /**
     * @var array
     */
    private $report;

    public function __construct(array $report)
    {
        $this->report = $report;
    }

    /**
     * int
     */
    public function getSprintId()
    {
        return $this->report['sprintId'];
    }

    /**
     * @return float
     */
    public function getAverageClosedIssues()
    {
        return $this->report['averageClosedIssues'];
    }

    /**
     * @return int
     */
    public function getClosedIssuesCount()
    {
        return $this->report['closedIssuesCount'];
    }
}
