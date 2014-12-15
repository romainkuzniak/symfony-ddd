<?php

namespace Application\Impl;

use AppBundle\Aop\Transactional;
use AppBundle\Repository\SprintRepositoryDoctrine;
use Application\SprintService;
use Domain\Model\Sprint\SprintRepository;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class SprintServiceImpl implements SprintService
{

    /**
     * @var SprintRepository
     */
    private $sprintRepository;

    /**
     * @Transactional
     * @return array
     * @throws \Domain\Model\Sprint\SprintNotFoundException
     * @throws \Domain\Model\Sprint\SprintAlreadyClosedException
     */
    public function closeSprint($id)
    {

        $sprint = $this->sprintRepository->find($id);
        $sprint->close();
        $this->sprintRepository->update($sprint);

        $closedIssuesCount = $sprint->getIssues()->count();

        return array(
            'sprintId'            => $sprint->getId(),
            'closedIssuesCount'   => $closedIssuesCount,
            'averageClosedIssues' => $this->sprintRepository->findAverageClosedIssues()
        );
    }

    /**
     * @Transactional
     * @return int
     * @throws \Domain\Model\Sprint\SprintNotFoundException
     * @throws \Domain\Model\Sprint\SprintAlreadyClosedException
     */
    public function closeExpectedSprint()
    {
        $sprint = $this->sprintRepository->findSprintToClose();
        $sprint->close();
        $this->sprintRepository->update($sprint);

        return $sprint->getId();
    }

    /**
     * @return \Domain\Model\Sprint\Sprint
     * @throws \Domain\Model\Sprint\SprintNotFoundException
     */
    public function get($id)
    {
        return $this->sprintRepository->find($id);
    }

    public function setSprintRepository(SprintRepositoryDoctrine $sprintRepository)
    {
        $this->sprintRepository = $sprintRepository;
    }

}
