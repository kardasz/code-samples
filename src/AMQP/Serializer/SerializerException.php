<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\AMQP\Serializer;

use Exception;
use Kardasz\AMQP\Message\MessageInterface;

/**
 * Class SerializerException
 * @package Kardasz\AMQP\Serializer
 */
class SerializerException extends Exception
{
    const INVALID_JSON = 'Invalid json';
    const INVALID_JSON_DATA = 'Invalid json data';
    const MESSAGE_CLASS_NOT_FOUND = 'Message class "%s" not found';
    const MESSAGE_CLASS_NOT_IMPLEMENT_INTERFACE = 'Message class "%s" must implement '.MessageInterface::class;
}
