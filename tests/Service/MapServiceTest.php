<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Tests\Service\Map;

use DateTimeZone;
use Kardasz\Service\MapService;
use PHPUnit\Framework\MockObject\MockObject;
use Kardasz\Service\Map\ObjectSummary\Visitor as ObjectSummaryVisitor;
use Kardasz\Service\Map\ObjectDetails\Visitor as ObjectDetailsVisitor;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorChainInterface as ObjectSummaryVisitorChainInterface;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorChain as ObjectSummaryVisitorChain;
use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorChainInterface as ObjectDetailsVisitorChainInterface;
use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorChain as ObjectDetailsVisitorChain;
use Kardasz\VO\AcVO;
use PHPUnit\Framework\TestCase;

/**
 * Class MapServiceTest
 * @package Kardasz\Tests\Service\Map
 */
class MapServiceTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        date_default_timezone_set('Europe/Warsaw');
    }

    /**
     * @covers MapService::getObjectDetails
     */
    public function testGetObjectDetails()
    {
        $subject = new MapService(
            $this->getObjectSummaryVisitorChainMock(),
            $this->newObjectDetailsVisitorChain()
        );

        $results = $subject->getObjectDetails([
            'summary' => [
                'last_odo' => 1000,
                'distance' => 300,
                'workstart' => strtotime('2018-10-01 11:10:00'),
                'workstop' => strtotime('2018-10-01 14:12:00'),
                'posstart' => [
                    'record_gps_latitude' => 52.411537,
                    'record_gps_longitude' => 16.936883,
                ],
                'posstop' => [
                    'record_gps_latitude' => 52.711537,
                    'record_gps_longitude' => 16.928883,
                ],
                'drivetime' => (2*3600) + (15 * 60) + 25,
                'parktime' => (3*3600) + (45 * 60),
                'parktime_300' => (4*3600) + (5 * 60) + 21,
                'parktime_300_count' => 3
            ],
            'fillings' => [
                [
                    'filling_timestamp' => strtotime('2018-10-01 08:15:00'),
                    'filling_value' => 42,
                    'filling_distance' => 620
                ]
            ],
            'lastrec' => [
                'record_io' => [
                    'analog' => [
                        [2, 'foo'],
                        [3, 'baaz']
                    ],
                    'temp' => [
                        [45, 'bar']
                    ]
                ]
            ]
        ]);

        $this->assertEquals(300, $results->getDistance());
        $this->assertEquals(1000, $results->getOdometer());
        $this->assertEquals('2018-10-01 11:10:00', $results->getWorkstart()->setTimezone(new DateTimeZone(date_default_timezone_get()))->format('Y-m-d H:i:s'));
        $this->assertEquals('2018-10-01 14:12:00', $results->getWorkstop()->setTimezone(new DateTimeZone(date_default_timezone_get()))->format('Y-m-d H:i:s'));
        $this->assertEquals(52.411537, $results->getStartLat());
        $this->assertEquals(16.936883, $results->getStartLng());
        $this->assertEquals(52.711537, $results->getStopLat());
        $this->assertEquals(16.928883, $results->getStopLng());
        $this->assertEquals(2, $results->getDriveHours());
        $this->assertEquals(15, $results->getDriveMinutes());
        $this->assertEquals(3, $results->getParkHours());
        $this->assertEquals(45, $results->getParkMinutes());
        $this->assertEquals(4, $results->getParkTime300Hours());
        $this->assertEquals(5, $results->getParkTime300Minutes());
        $this->assertEquals(3, $results->getParkTime300Count());
        $this->assertEquals('2018-10-01 08:15:00', $results->getFillings()[0]->getDate()->setTimezone(new DateTimeZone(date_default_timezone_get()))->format('Y-m-d H:i:s'));
        $this->assertEquals(42, $results->getFillings()[0]->getValue());
        $this->assertEquals(620, $results->getFillings()[0]->getDistance());
        $this->assertEquals(AcVO::UNIT_VOLT, $results->getAc()[0]->getUnit());
        $this->assertEquals(AcVO::TYPE_ANALOG, $results->getAc()[0]->getType());
        $this->assertEquals('foo', $results->getAc()[0]->getName());
        $this->assertEquals(2, $results->getAc()[0]->getValue());
        $this->assertEquals(AcVO::UNIT_VOLT, $results->getAc()[1]->getUnit());
        $this->assertEquals(AcVO::TYPE_ANALOG, $results->getAc()[1]->getType());
        $this->assertEquals('baaz', $results->getAc()[1]->getName());
        $this->assertEquals(3, $results->getAc()[1]->getValue());
        $this->assertEquals(AcVO::UNIT_CELCIUS, $results->getAc()[2]->getUnit());
        $this->assertEquals(AcVO::TYPE_TEMP, $results->getAc()[2]->getType());
        $this->assertEquals('bar', $results->getAc()[2]->getName());
        $this->assertEquals(45, $results->getAc()[2]->getValue());
    }

    /**
     * @covers MapService::getObjectSummary
     */
    public function testGetObjectSummary()
    {
        $subject = new MapService(
            $this->newObjectSummaryVisitorChain(),
            $this->getObjectDetailsVisitorChainMock()
        );

        $results = $subject->getObjectSummary([
            'object_id' => 1,
            'object_name' => 'XYZ123456',
            'object_description' => 'Skoda Octavia, 1, 2009',
            'object_fuel' => 20,
            'fuel_tank_1' => 45,
            'fuel_tank_2' => 5,
            'last_record' => [
                'record_rpm' => 2600,
                'record_device_state' => 24,
                'record_gps_latitude' => 52.411537,
                'record_gps_longitude' => 16.936883,
                'driver_user_id' => 5,
                'record_additional_data' => [
                    'SensorAcc' => 14,
                    'GsmSignalLevel' => 32
                ]
            ]
        ]);

        $this->assertEquals(1, $results->getId());
        $this->assertEquals('XYZ123456', $results->getName());
        $this->assertEquals('Skoda Octavia, 1, 2009', $results->getDescription());
        $this->assertEquals(20, $results->getFuel());
        $this->assertEquals(50, $results->getFuelTank());
        $this->assertEquals(100, $results->getGsmSignalLevel());
        $this->assertEquals(14, $results->getAcc());
        $this->assertEquals(2600, $results->getRpm());
        $this->assertEquals(ObjectSummaryVisitor\RideType::TYPE_PRIVATE, $results->getRideType());
        $this->assertEquals(52.411537, $results->getLat());
        $this->assertEquals(16.936883, $results->getLng());
    }

    /**
     * @return MockObject|ObjectDetailsVisitorChainInterface
     */
    private function getObjectDetailsVisitorChainMock() : ObjectDetailsVisitorChainInterface
    {
        return $this->getMockBuilder(ObjectDetailsVisitorChainInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return ObjectDetailsVisitorChainInterface
     */
    private function newObjectDetailsVisitorChain() : ObjectDetailsVisitorChainInterface
    {
        $chain = new ObjectDetailsVisitorChain();
        $chain->add(new ObjectDetailsVisitor\Ac());
        $chain->add(new ObjectDetailsVisitor\Distance());
        $chain->add(new ObjectDetailsVisitor\DriveTime());
        $chain->add(new ObjectDetailsVisitor\Fillings());
        $chain->add(new ObjectDetailsVisitor\Odometer());
        $chain->add(new ObjectDetailsVisitor\ParkStopTime());
        $chain->add(new ObjectDetailsVisitor\ParkTime());
        $chain->add(new ObjectDetailsVisitor\ParkTime300());
        $chain->add(new ObjectDetailsVisitor\ParkTime300Count());
        $chain->add(new ObjectDetailsVisitor\StartGeo());
        $chain->add(new ObjectDetailsVisitor\StopGeo());
        $chain->add(new ObjectDetailsVisitor\Workstart());
        $chain->add(new ObjectDetailsVisitor\Workstop());

        return $chain;
    }

    /**
     * @return MockObject|ObjectSummaryVisitorChainInterface
     */
    private function getObjectSummaryVisitorChainMock() : ObjectSummaryVisitorChainInterface
    {
        return $this->getMockBuilder(ObjectSummaryVisitorChainInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return ObjectSummaryVisitorChainInterface
     */
    private function newObjectSummaryVisitorChain() : ObjectSummaryVisitorChainInterface
    {
        $chain = new ObjectSummaryVisitorChain();
        $chain->add(new ObjectSummaryVisitor\Acc());
        $chain->add(new ObjectSummaryVisitor\Description());
        $chain->add(new ObjectSummaryVisitor\Fuel());
        $chain->add(new ObjectSummaryVisitor\FuelTank());
        $chain->add(new ObjectSummaryVisitor\Geo());
        $chain->add(new ObjectSummaryVisitor\Geo2());
        $chain->add(new ObjectSummaryVisitor\GsmSignalLevelTytan());
        $chain->add(new ObjectSummaryVisitor\Id());
        $chain->add(new ObjectSummaryVisitor\Name());
        $chain->add(new ObjectSummaryVisitor\RideType());
        $chain->add(new ObjectSummaryVisitor\Rpm());
        $chain->add(new ObjectSummaryVisitor\Acc());
        $chain->add(new ObjectSummaryVisitor\Acc());

        return $chain;
    }
}
