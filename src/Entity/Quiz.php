<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $question_list = [];

    #[ORM\Column]
    private ?\DateTimeImmutable $activate_at;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleted_at = null;

    public function __construct(?DateTimeImmutable $activationDate = null)
    {
        $dateNow = new DateTimeImmutable();

        $activate_at = $activationDate ?? $dateNow;
        $created_at = $dateNow;
        $updated_at = $dateNow;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionList(): array
    {
        return $this->question_list;
    }

    public function setQuestionList(array $question_list): static
    {
        $this->question_list = $question_list;

        return $this;
    }

    public function getActivateAt(): ?\DateTimeImmutable
    {
        return $this->activate_at;
    }

    public function setActivateAt(?\DateTimeImmutable $activate_at): static
    {
        $this->activate_at = $activate_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): static
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }
}
