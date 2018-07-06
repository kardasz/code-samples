<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\DataFixtures;

use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Kardasz\Entity\ReportCategory;
use DateTime;

/**
 * Class ReportCategoryFixtures
 * @package Kardasz\DataFixtures
 */
class ReportCategoryFixtures extends Fixture
{
    /**
     * @var array
     */
    private $ids = [
        self::CATEGORY_1_ID,
        self::CATEGORY_2_ID,
        self::CATEGORY_3_ID,
        self::CATEGORY_4_ID,
        self::CATEGORY_5_ID,
        self::CATEGORY_6_ID
    ];
    
    const CATEGORY_1_ID = '2a32481b-39f7-42f3-bf48-4db7f633ed12';
    const CATEGORY_2_ID = '6494eab9-1313-4c91-9d91-d9301fa27c2b';
    const CATEGORY_3_ID = '159ee553-36c0-45df-bf22-69086b201fa0';
    const CATEGORY_4_ID = '4edc95a1-8dc7-4eb3-982b-ba59d8a05601';
    const CATEGORY_5_ID = '72240bfa-6b27-4947-b027-dae2a6795349';
    const CATEGORY_6_ID = 'b850efcb-b8cc-40f8-a547-a73b584f4eed';
    
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
            $category = new ReportCategory();
            $category->setId($id);
            $category->setName($this->faker->text(100));
            $category->setStatus(ReportCategory::STATUS_ACTIVE);
            $category->setCreatedAt(new DateTime());

            $manager->persist($category);
            $this->addReference($id, $category);
        }

        $manager->flush();
    }

    /**
     * @param $num
     * @return string
     */
    public static function categoryId($num) : string
    {
        return constant(sprintf('%s::CATEGORY_%d_ID', __CLASS__, $num));
    }

    /**
     * @param int $min
     * @param int $max
     * @return string
     */
    public static function randomCategoryId($min = 1, $max = 6) : string
    {
        return self::categoryId(mt_rand($min, $max));
    }
}
