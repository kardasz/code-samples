<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\AMQP\Consumer\Mapper;

use Kardasz\AMQP\Message\MessageInterface;
use Kardasz\AMQP\Serializer\MessageSerializerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class AMQPMessageMapper
 * @package Kardasz\AMQP\Consumer\Mapper
 */
class AMQPMessageMapper implements AMQPMessageMapperInterface
{
    /**
     * @var MessageSerializerInterface
     */
    private $serializer;

    /**
     * AMQPMessageMapper constructor.
     * @param MessageSerializerInterface $serializer
     */
    public function __construct(MessageSerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param AMQPMessage $message
     * @return MessageInterface
     */
    public function convert(AMQPMessage $message): MessageInterface
    {
        return $this->serializer->deserialize($message->getBody());
    }
}
