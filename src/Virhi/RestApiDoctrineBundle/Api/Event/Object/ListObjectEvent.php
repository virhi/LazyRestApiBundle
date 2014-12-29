<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 29/12/14
 * Time: 12:08
 */

namespace Virhi\RestApiDoctrineBundle\Api\Event\Object;


use Symfony\Component\EventDispatcher\Event;

class ListObjectEvent extends Event
{
    const NAME = 'virhi_rest_api_list_object';

    protected $objects;

    protected $list;

    function __construct($objects)
    {
        $this->objects = $objects;
        $this->setName(self::NAME);
    }


    /**
     * @return mixed
     */
    public function getObjects()
    {
        return $this->objects;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param mixed $list
     */
    public function setList($list)
    {
        $this->list = $list;
    }
}