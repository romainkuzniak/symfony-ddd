<?php

namespace Interfaces\Sprint\Internal;

use Application\SprintService;
use Interfaces\Sprint\DTO\SprintDTO;
use Interfaces\Sprint\Internal\Assembler\ReportDTOAssembler;
use Interfaces\Sprint\Internal\Assembler\SprintDTOAssembler;
use Interfaces\Sprint\SprintServiceFacade;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class SprintServiceFacadeImpl implements SprintServiceFacade
{

    /**
     * @var SprintService
     */
    private $sprintService;

    /**
     * @return array
     * @throws \Domain\Model\Sprint\SprintNotFoundException
     * @throws \Domain\Model\Sprint\SprintAlreadyClosedException
     */
    public function closeSprint($id)
    {
        $report = $this->sprintService->closeSprint($id);
        $assembler = new ReportDTOAssembler();

        return $assembler->toDTO($report);
    }

    /**
     * @return SprintDTO
     */
    public function get($id)
    {
        $sprint = $this->sprintService->get($id);
        $assembler = new SprintDTOAssembler();

        return $assembler->toDTO($sprint);
    }

    public function setSprintService(SprintService $sprintService)
    {
        $this->sprintService = $sprintService;
    }
}
