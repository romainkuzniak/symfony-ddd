<?php
namespace Application;

use Domain\Model\Sprint\Sprint;
use Domain\Model\Sprint\SprintAlreadyClosedException;
use Domain\Model\Sprint\SprintNotFoundException;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
interface SprintService extends TransactionalService
{
    /**
     * @return array
     * @throws \Domain\Model\Sprint\SprintNotFoundException
     * @throws SprintAlreadyClosedException
     */
    public function closeSprint($id);

    /**
     * @return int
     * @throws SprintNotFoundException
     * @throws \Domain\Model\Sprint\SprintAlreadyClosedException
     */
    public function closeExpectedSprint();

    /**
     * @return Sprint
     * @throws \Domain\Model\Sprint\SprintNotFoundException
     */
    public function get($id);
}
