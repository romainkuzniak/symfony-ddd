<?php

namespace AppBundle\Aop;

use Doctrine\Common\Annotations\Reader;
use JMS\AopBundle\Aop\PointcutInterface;

/**
 * @author Romain Kuzniak <romain.kuzniak@turn-it-up.org>
 */
class TransactionalPointcut implements PointcutInterface
{

    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @return bool
     */
    public function matchesClass(\ReflectionClass $class)
    {
        return $class->implementsInterface('Application\TransactionalService');
    }

    /**
     * @return bool
     */
    public function matchesMethod(\ReflectionMethod $method)
    {
        return null !== $this->reader->getMethodAnnotation(
            $method,
            'AppBundle\Aop\Transactional'
        );
    }
}
