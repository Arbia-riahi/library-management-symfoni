<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student extends User
{
    #[ORM\Column(length: 180, unique: true)]
    private ?string $studentId = null;

    #[ORM\Column(length: 255)]
    private ?string $major = null;

    #[ORM\Column]
    private ?int $yearOfStudy = null;

    public function getStudentId(): ?string
    {
        return $this->studentId;
    }

    public function setStudentId(string $studentId): static
    {
        $this->studentId = $studentId;
        return $this;
    }

    public function getMajor(): ?string
    {
        return $this->major;
    }

    public function setMajor(string $major): static
    {
        $this->major = $major;
        return $this;
    }

    public function getYearOfStudy(): ?int
    {
        return $this->yearOfStudy;
    }

    public function setYearOfStudy(int $yearOfStudy): static
    {
        $this->yearOfStudy = $yearOfStudy;
        return $this;
    }
}
