<?php

namespace Interfaces\Sprint\Internal\Assembler;

use Domain\Model\Sprint\Sprint;
use Interfaces\Sprint\DTO\SprintDTO;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class SprintDTOAssembler
{
    public function toDTO(Sprint $sprint)
    {
        return new SprintDTO($sprint);
    }
}
