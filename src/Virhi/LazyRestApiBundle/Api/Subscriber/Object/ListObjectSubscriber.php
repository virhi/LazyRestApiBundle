<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/12/14
 * Time: 12:06
 */

namespace Virhi\LazyRestApiBundle\Api\Subscriber\Object;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Virhi\LazyRestApiBundle\Api\Event\Object\ListObjectEvent;
use Virhi\LazyRestApiBundle\Api\ValueObject\ObjectStructure;
use Virhi\LazyRestApiBundle\Api\Specification\AuthorizedEntitySpecification;

class ListObjectSubscriber implements EventSubscriberInterface
{
    /**
     * @var AuthorizedEntitySpecification
     */
    protected $authorizedEntitySpecification;

    public function __construct(AuthorizedEntitySpecification $authorizedEntitySpecification)
    {
        $this->authorizedEntitySpecification = $authorizedEntitySpecification;
    }

    public static function getSubscribedEvents()
    {
        // Liste des évènements écoutés et méthodes à appeler
        return array(
            ListObjectEvent::NAME => 'handleListObjectEvent'
        );
    }

    public function handleListObjectEvent(ListObjectEvent $event)
    {
        $list = array();

        foreach ($event->getObjects() as $object) {
            if ($this->authorizedEntitySpecification->isSatisfiedBy($object)) {
                $list[] = $object;
            }
        }

        $event->setList($list);
    }
} 