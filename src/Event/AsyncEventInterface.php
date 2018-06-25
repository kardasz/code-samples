<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Event;

use Kardasz\AMQP\Message\MessageInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Interface AsyncEventInterface
 * @package Kardasz\AMQP\Message
 */
interface AsyncEventInterface extends MessageInterface
{
    /**
     * @return string
     */
    public function getEventName() : string;

    /**
     * @return Event
     */
    public function getEvent() : Event;
}
