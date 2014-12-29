<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/12/14
 * Time: 12:06
 */

namespace Virhi\RestApiDoctrineBundle\Api\Subscriber\Object;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Virhi\RestApiDoctrineBundle\Api\Event\Object\ListObjectEvent;
use Virhi\RestApiDoctrineBundle\Api\ValueObject\ObjectStructure;
use Virhi\RestApiDoctrineBundle\Api\Specification\AuthorizedEntitySpecification;

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