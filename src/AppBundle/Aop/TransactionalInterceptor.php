<?php

namespace AppBundle\Aop;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Doctrine\ORM\EntityManager;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class TransactionalInterceptor implements MethodInterceptorInterface
{

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Exception
     */
    public function intercept(MethodInvocation $invocation)
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $rs = $invocation->proceed();

            $this->em->flush();
            $this->em->getConnection()->commit();

            return $rs;
        } catch (\Exception $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }

}
