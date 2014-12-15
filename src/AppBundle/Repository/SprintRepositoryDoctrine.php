<?php

namespace AppBundle\Repository;

use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Domain\Model\Sprint\Sprint;
use Domain\Model\Sprint\SprintNotFoundException;
use Domain\Model\Sprint\SprintRepository;
use Domain\Model\Sprint\SprintStatus;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class SprintRepositoryDoctrine extends EntityRepository implements SprintRepository
{
    /**
     * @return \Domain\Model\Sprint\Sprint
     * @throws SprintNotFoundException
     */
    public function find($id)
    {
        $sprint = parent::find($id);

        if (null === $sprint) {
            throw new SprintNotFoundException();
        }

        return $sprint;
    }

    /**
     * @return Sprint
     *
     * @throws SprintNotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findSprintToClose()
    {
        try {
            return $this->createQueryBuilder('s')
                ->andWhere('s.expectedClosedAt < :now')
                ->setParameter('now', new \DateTime(Carbon::now()->toDateTimeString()))
                ->andWhere('s.status != :status')
                ->setParameter('status', SprintStatus::CLOSE)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $nre) {
            throw new SprintNotFoundException();
        }
    }

    /**
     * @return int
     */
    public function findAverageClosedIssues()
    {
        return (int) $this->createQueryBuilder('s')
            ->select('AVG(i.id) as averageClosedIssues')
            ->leftJoin('s.issues', 'i')
            ->andWhere('s.status = :status')
            ->setParameter('status', SprintStatus::CLOSE)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function update(Sprint $sprint)
    {

    }
}
