<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Kardasz\Entity\IndividualReport;
use DateTime;

/**
 * Class IndividualReportFixtures
 * @package Kardasz\DataFixtures
 */
class IndividualReportFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var array
     */
    private $ids = [
        self::REPORT_1_ID,
        self::REPORT_2_ID,
        self::REPORT_3_ID,
        self::REPORT_4_ID,
        self::REPORT_5_ID,
        self::REPORT_6_ID
    ];

    const REPORT_1_ID = '0c58b7eb-6d28-4ef7-be47-34e911af9f42';
    const REPORT_2_ID = '812ecb09-437b-4f11-a82a-8794e6a44d71';
    const REPORT_3_ID = 'ffd2dc6f-dc88-4c1a-83e9-57a991b78e80';
    const REPORT_4_ID = '0b0ae34d-ec85-4cd9-85f6-c40d0a2f0bd1';
    const REPORT_5_ID = '24ba65b5-9ee9-49b4-a7df-34fb18850ce3';
    const REPORT_6_ID = 'e93ffb88-f417-44bd-b41c-4ba5bb5598e7';
    
    /**
     * CategoryFixtures constructor.
     */
    public function __construct()
    {
        $this->faker = Faker\Factory::create('pl_PL');
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->ids as $id) {
            $report = new IndividualReport();
            $report->setId($id);
            $report->setCategory($this->getReference(ReportCategoryFixtures::randomCategoryId()));
            $report->setName($this->faker->numerify('Report no. ###'));
            $report->setAuthor($this->faker->name);
            $report->setFilePath('uploads/example.pdf');
            $report->setCreatedAt(new DateTime());

            $manager->persist($report);
            $this->addReference($id, $report);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            ReportCategoryFixtures::class
        ];
    }
}
