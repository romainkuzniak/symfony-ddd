<?php

namespace Application\Impl;

use Carbon\Carbon;
use Domain\Model\Issue\Issue;
use Domain\Model\Issue\IssueStub1;
use Domain\Model\Issue\IssueStub2;
use Domain\Model\Sprint\InMemorySprintRepository;
use Domain\Model\Sprint\SprintStatus;
use Domain\Model\Sprint\SprintStub1;
use Domain\Model\Sprint\SprintStub2;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class SprintServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var SprintServiceImpl
     */
    private $service;

    /**
     * @test
     * @expectedException \Domain\Model\Sprint\SprintNotFoundException
     */
    public function NonExistingSprint_Close_ThrowException()
    {
        InMemorySprintRepository::$sprints = array();
        $this->service->closeSprint(SprintStub1::ID);
    }

    /**
     * @test
     * @expectedException \Domain\Model\Sprint\SprintAlreadyClosedException
     */
    public function AlreadyClosedSprint_Close_ThrowException()
    {
        $this->service->closeSprint(SprintStub1::ID);
    }

    /**
     * @test
     */
    public function CloseSprint()
    {
        $report = $this->service->closeSprint(SprintStub2::ID);
        $actualSprint = InMemorySprintRepository::$sprints[SprintStub2::ID];
        $this->assertEquals(SprintStub2::ID, $report['sprintId']);
        $this->assertEquals(1, $report['closedIssuesCount']);
        $this->assertEquals(1.5, $report['averageClosedIssues']);
        $this->assertEquals(SprintStatus::CLOSE, $actualSprint->getStatus());
        $this->assertEquals(new \DateTime(Carbon::now()->toTimeString()), $actualSprint->getEffectiveClosedAt());
        $this->assertCount(1, $actualSprint->getIssues());
        $this->assertClosedIssue('Domain\Model\Issue\IssueStub2', $actualSprint->getIssues()->first());
    }

    /**
     * @param IssueStub1|IssueStub2 $stub
     */
    private function assertClosedIssue($stub, Issue $issue)
    {
        $this->assertEquals(new \DateTime(Carbon::now()->toTimeString()), $issue->getCreatedAt());
        $this->assertEquals(new \DateTime(Carbon::now()->toTimeString()), $issue->getClosedAt());
        $this->assertEquals(new \DateTime($stub::DONE_AT), $issue->getDoneAt());
        $this->assertEquals($stub::ID, $issue->getId());
        $this->assertEquals(SprintStatus::CLOSE, $issue->getStatus());
        $this->assertEquals($stub::DESCRIPTION, $issue->getDescription());
        $this->assertEquals($stub::TITLE, $issue->getTitle());
    }

    /**
     * @test
     */
    public function CloseExpectedSprint()
    {
        $id = $this->service->closeExpectedSprint();
        $actualSprint = InMemorySprintRepository::$sprints[$id];
        $this->assertEquals(SprintStub2::ID, $id);
        $this->assertTrue($actualSprint->isClosed());
        $this->assertEquals(new \DateTime(Carbon::now()->toTimeString()), $actualSprint->getEffectiveClosedAt());
        $this->assertCount(1, $actualSprint->getIssues());
        $this->assertClosedIssue('Domain\Model\Issue\IssueStub2', $actualSprint->getIssues()->first());
    }

    /**
     * @test
     * @expectedException \Domain\Model\Sprint\SprintNotFoundException
     */
    public function NonExistingSprint_Get_ThrowException()
    {
        InMemorySprintRepository::$sprints = array();
        $this->service->get(SprintStub1::ID);
    }

    /**
     * @test
     */
    public function Get()
    {
        $sprint = $this->service->get(SprintStub1::ID);
        $this->assertEquals(new \DateTime(SprintStub1::CREATED_AT), $sprint->getCreatedAt());
        $this->assertEquals(new \DateTime(SprintStub1::EFFECTIVE_CLOSED_AT), $sprint->getEffectiveClosedAt());
        $this->assertEquals(new \DateTime(SprintStub1::EXPECTED_CLOSED_AT), $sprint->getExpectedClosedAt());
        $this->assertEquals(SprintStub1::ID, $sprint->getId());
        $this->assertEquals(SprintStub1::STATUS, $sprint->getStatus());

    }

    protected function setUp()
    {
        Carbon::setTestNow(Carbon::now());
        $this->service = new SprintServiceImpl();
        $this->service->setSprintRepository(new InMemorySprintRepository());
        InMemorySprintRepository::$sprints = array(
            SprintStub1::ID => new SprintStub1(),
            SprintStub2::ID => new SprintStub2()
        );
    }

    protected function tearDown()
    {
        Carbon::setTestNow();
    }

}
