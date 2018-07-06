<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\CQRS\Command;

use DateTime;
use Kardasz\Entity\ReportCategory;

/**
 * Class CreateReportCommand
 * @package Kardasz\CQRS\Command
 */
class CreateReportCommand
{
    /**
     * @var ReportCategory
     */
    private $category;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $filepath;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * CreateReport constructor.
     * @param ReportCategory $category
     * @param string $name
     * @param string $author
     * @param string $filepath
     * @param DateTime $date
     */
    public function __construct(ReportCategory $category, string $name, string $author, string $filepath, DateTime $date)
    {
        $this->category = $category;
        $this->name = $name;
        $this->author = $author;
        $this->filepath = $filepath;
        $this->date = $date;
    }

    /**
     * @return ReportCategory
     */
    public function getCategory(): ReportCategory
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getFilepath(): string
    {
        return $this->filepath;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }
}
