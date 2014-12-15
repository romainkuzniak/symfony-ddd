<?php

namespace Domain\Model\Sprint;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
interface SprintRepository
{
    /**
     * @return \Domain\Model\Sprint\Sprint
     * @throws SprintNotFoundException
     */
    public function find($id);

    /**
     * @return Sprint
     *
     * @throws SprintNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findSprintToClose();

    /**
     * @return int
     */
    public function findAverageClosedIssues();

    public function update(Sprint $sprint);
}
