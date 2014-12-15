<?php

namespace AppBundle\Controller\Api;

use Domain\Model\Sprint\SprintAlreadyClosedException;
use Domain\Model\Sprint\SprintNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
            $report = $this->get('facade.service.sprint')->closeSprint($id);

            return new JsonResponse($report);
        } catch (SprintNotFoundException $snfe) {
            throw new NotFoundHttpException();
        } catch (SprintAlreadyClosedException $sace) {
            return new JsonResponse('Sprint already closed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($id)
    {
        try {
            $sprint = $this->get('facade.service.sprint')->get($id);

            return new Response(
                json_encode($sprint),
                Response::HTTP_OK,
                array('Content-type' => 'application/json')
            );
        } catch (SprintNotFoundException $snfe) {
            throw new NotFoundHttpException();
        }
    }
}
