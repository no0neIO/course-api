<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Index(name: "title_idx", columns: ["title"])]
#[OA\Schema(
    schema: 'Course',
    description: 'Course entity',
    properties: [
        new OA\Property(
            property: 'id',
            description: 'The unique identifier of the course',
            type: 'integer'
        ),
        new OA\Property(
            property: 'title',
            description: 'The title of the course',
            type: 'string'
        ),
        new OA\Property(
            property: 'description',
            description: 'The description of the course',
            type: 'string'
        ),
        new OA\Property(
            property: 'status',
            description: 'The status of the course',
            type: 'string'
        ),
        new OA\Property(
            property: 'isPremium',
            description: 'If course is premium or not',
            type: 'string'
        ),
        new OA\Property(
            property: 'createdAt',
            description: 'The date course created',
            type: 'string'
        ),
        new OA\Property(
            property: 'deletedAt',
            description: 'The date course deleted',
            type: 'string'
        )
    ]
)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 20)]
    #[Assert\Choice(choices: ["Published", "Pending"])]
    private string $status;

    #[ORM\Column(type: "boolean")]
    private bool $isPremium;

    #[ORM\Column(type: "datetime")]
    private \DateTime $createdAt;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTime $deletedAt = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function isPremium(): bool
    {
        return $this->isPremium;
    }

    public function setIsPremium(bool $isPremium): self
    {
        $this->isPremium = $isPremium;
        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTime();
    }

    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }
}
