<?php

namespace Interfaces\Sprint\Internal\Assembler;

use Interfaces\Sprint\DTO\ReportDTO;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class ReportDTOAssembler
{
    public function toDTO(array $report)
    {
        return new ReportDTO($report);
    }
}
