<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\AMQP\Publisher;

use Kardasz\AMQP\Message\MessageInterface;
use Kardasz\AMQP\Serializer\MessageSerializerInterface;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

/**
 * Class MessagePublisher.
 */
class MessagePublisher implements MessagePublisherInterface
{
    /**
     * @var MessageSerializerInterface
     */
    private $serializer;

    /**
     * @var ProducerInterface
     */
    private $producer;

    /**
     * MessagePublisher constructor.
     *
     * @param ProducerInterface          $producer
     * @param MessageSerializerInterface $serializer
     */
    public function __construct(ProducerInterface $producer, MessageSerializerInterface $serializer)
    {
        $this->producer = $producer;
        $this->serializer = $serializer;
    }

    /**
     * @param MessageInterface $message
     */
    public function publish(MessageInterface $message): void
    {
        $this->producer->publish($this->serializer->serialize($message));
    }
}
