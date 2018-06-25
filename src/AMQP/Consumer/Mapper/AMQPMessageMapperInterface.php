<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\AMQP\Consumer\Mapper;

use Kardasz\AMQP\Message\MessageInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Interface AMQPMessageMapperInterface
 * @package Kardasz\AMQP\Consumer\Mapper
 */
interface AMQPMessageMapperInterface
{
    /**
     * @param AMQPMessage $message
     * @return MessageInterface
     */
    public function convert(AMQPMessage $message) : MessageInterface;
}
