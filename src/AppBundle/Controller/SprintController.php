<?php

namespace AppBundle\Controller;

use Domain\Model\Sprint\SprintAlreadyClosedException;
use Domain\Model\Sprint\SprintNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class SprintController extends Controller
{
    /**
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function closeAction($id)
    {
        try {
            $report = $this->get('service.sprint')->closeSprint($id);

            return $this->render(
                'AppBundle:Sprint:close.html.twig',
                array('report' => new ReportViewAdapter($report))
            );
        } catch (SprintAlreadyClosedException $sace) {
            $this->get('session')->getFlashBag()->add('error', 'Sprint already closed');

            return $this->redirect($this->generateUrl('show_sprint', array('id' => $id)));
        } catch (SprintNotFoundException $snfe) {
            throw new NotFoundHttpException();
        }
    }

    /**
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        try {
            $sprint = $this->get('service.sprint')->get($id);

            return $this->render(
                'AppBundle:Sprint:show.html.twig',
                array('sprint' => new SprintViewAdapter($sprint))
            );
        } catch (SprintNotFoundException $snfe) {
            throw new NotFoundHttpException();
        }
    }
}
