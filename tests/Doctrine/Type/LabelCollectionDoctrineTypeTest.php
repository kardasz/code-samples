<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Kardasz\Doctrine\Type\LabelCollectionDoctrineType;
use Kardasz\Domain\Model\Label;
use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Types\Type;

/**
 * Class LabelCollectionDoctrineTypeTest.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 */
class LabelCollectionDoctrineTypeTest extends TestCase
{
    /**
     * @var Type
     */
    protected $type;

    /**
     * @var AbstractPlatform
     */
    protected $platform;

    /**
     * @throws \Doctrine\DBAL\DBALException
     * @throws \ReflectionException
     */
    protected function setUp()
    {
        if (!Type::hasType(LabelCollectionDoctrineType::NAME)) {
            Type::addType(LabelCollectionDoctrineType::NAME, LabelCollectionDoctrineType::class);
        }

        $this->type = Type::getType(LabelCollectionDoctrineType::NAME);
        $this->platform = $this->getMockForAbstractClass(AbstractPlatform::class);
    }

    /**
     * @test
     */
    public function it_converts_to_database_value()
    {
        $data = [
            new Label('Color', 'blue'),
        ];

        $value = $this->type->convertToDatabaseValue($data, $this->platform);
        $expected = '[{"name":"Color","value":"blue"}]';

        $this->assertInternalType('string', $value);
        $this->assertEquals($expected, $value);
    }

    /**
     * @test
     */
    public function it_converts_to_php_value()
    {
        $data = '[{"name":"Color","value":"blue"}]';
        $converted = $this->type->convertToPHPValue($data, $this->platform);

        $this->assertInternalType('array', $converted);
        $this->assertTrue(isset($converted[0]));
        $this->assertTrue($converted[0] instanceof Label);
        $this->assertEquals('Color', $converted[0]->getName());
        $this->assertEquals('blue', $converted[0]->getValue());
    }
}
