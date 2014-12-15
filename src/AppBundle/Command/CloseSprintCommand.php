<?php

namespace AppBundle\Command;

use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class CloseSprintCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('agility-board:close-sprint')
            ->setDescription('Close sprint');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $sprintId = $this->getContainer()->get('service.sprint')->closeExpectedSprint();

            $output->writeln('Close Sprint: ' . $sprintId);
        } catch (NoResultException $nre) {
            $output->writeln('None');
        }
    }
}
