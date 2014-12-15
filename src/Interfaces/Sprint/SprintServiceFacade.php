<?php

namespace Interfaces\Sprint;

use Interfaces\Sprint\DTO\SprintDTO;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
interface SprintServiceFacade
{
    /**
     * @return array
     * @throws \Domain\Model\Sprint\SprintNotFoundException
     * @throws \Domain\Model\Sprint\SprintAlreadyClosedException
     */
    public function closeSprint($id);

    /**
     * @return SprintDTO
     * @throws \Domain\Model\Sprint\SprintNotFoundException
     */
    public function get($id);
}
