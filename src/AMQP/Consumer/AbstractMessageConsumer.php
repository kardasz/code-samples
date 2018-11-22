<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\AMQP\Consumer;

use Kardasz\AMQP\Consumer\Mapper\AMQPMessageMapperInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class AbstractMessageConsumer.
 */
abstract class AbstractMessageConsumer implements ConsumerInterface, MessageConsumerInterface
{
    /**
     * @var AMQPMessageMapperInterface
     */
    private $mapper;

    /**
     * MessageConsumer constructor.
     *
     * @param AMQPMessageMapperInterface $mapper
     */
    public function __construct(AMQPMessageMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param AMQPMessage $msg The message
     *
     * @return mixed false to reject and requeue, any other value to acknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        return $this->consume($this->mapper->convert($msg));
    }
}
