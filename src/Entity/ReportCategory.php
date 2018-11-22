<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class ReportCategory.
 *
 * @ORM\Table(name="report_category")
 * @ORM\Entity
 */
class ReportCategory
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Kardasz\Entity\IndividualReport", mappedBy="category")
     */
    private $reports;

    /**
     * @var string|null
     * @ORM\Column(name="name", type="string", nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(name="name", type="string", nullable=false, unique=true)
     */
    private $status;

    /**
     * @var DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    const STATUS_DRAFT = 'draft';
    const STATUS_ACTIVE = 'active';

    /**
     * ReportCategory constructor.
     */
    public function __construct()
    {
        $this->reports = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return Collection
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    /**
     * @param Collection $reports
     */
    public function setReports(Collection $reports): void
    {
        $this->reports = $reports;
    }

    /**
     * @param IndividualReport $report
     */
    public function addReport(IndividualReport $report)
    {
        if (!$this->reports->contains($report)) {
            $this->reports->add($report);
            $report->setCategory($this);
        }
    }

    /**
     * @param IndividualReport $report
     */
    public function removeReport(IndividualReport $report)
    {
        if (!$this->reports->contains($report)) {
            $this->reports->removeElement($report);
        }
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
