<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Domain\Model\Issue\IssueRepository;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class IssueRepositoryDoctrine extends EntityRepository implements IssueRepository
{
}
