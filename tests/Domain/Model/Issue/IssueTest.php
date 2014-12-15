<?php

namespace Domain\Model\Issue;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class IssueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Domain\Model\Issue\IssueAlreadyClosedException
     */
    public function AlreadyClosedIssue_Close_ThrowException()
    {
        $issue = new Issue();
        $issue->close();
        $issue->close();
    }
}
