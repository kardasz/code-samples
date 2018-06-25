<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\AMQP\Serializer;

use Kardasz\AMQP\Message\MessageInterface;
use ReflectionClass;
use ReflectionException;

/**
 * Class MessageSerializer
 * @package Kardasz\AMQP\Serializer
 */
class MessageSerializer implements MessageSerializerInterface
{
    /**
     * @param MessageInterface $message
     * @return string
     */
    public function serialize(MessageInterface $message): string
    {
        return json_encode([
            '__class' => get_class($message),
            '__data'  => $message->serialize()
        ]);
    }

    /**
     * @param string $data
     * @return MessageInterface|null
     * @throws SerializerException
     * @throws ReflectionException
     */
    public function deserialize(string $data): MessageInterface
    {
        $data = json_decode($data, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new SerializerException(SerializerException::INVALID_JSON);
        }

        if (!isset($data['__class'], $data['__data'])) {
            throw new SerializerException(SerializerException::INVALID_JSON_DATA);
        }

        if (!class_exists($data['__class'])) {
            throw new SerializerException(
                sprintf(SerializerException::MESSAGE_CLASS_NOT_FOUND, $data['__class'])
            );
        }

        $class = new ReflectionClass($data['__class']);
        if (!$class->implementsInterface(MessageInterface::class)) {
            throw new SerializerException(
                sprintf(SerializerException::MESSAGE_CLASS_NOT_IMPLEMENT_INTERFACE, $data['__class'])
            );
        }

        return call_user_func_array([$data['__class'], 'deserialize'], [$data['__data']]);
    }
}
