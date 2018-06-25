<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Event;

use Kardasz\AMQP\Consumer\AbstractMessageConsumer;
use Kardasz\AMQP\Consumer\Mapper\AMQPMessageMapperInterface;
use Kardasz\AMQP\Message\MessageInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class AsyncEventConsumer
 * @package Kardasz\Event
 */
class AsyncEventConsumer extends AbstractMessageConsumer
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * AsyncEventConsumer constructor.
     * @param AMQPMessageMapperInterface $mapper
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(AMQPMessageMapperInterface $mapper, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($mapper);
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param MessageInterface $message
     * @return bool
     */
    public function consume(MessageInterface $message): bool
    {
        if ($message instanceof AsyncEventInterface) {
            $this->eventDispatcher->dispatch($message->getEventName(), $message->getEvent());
            return true;
        }
        return false;
    }
}
