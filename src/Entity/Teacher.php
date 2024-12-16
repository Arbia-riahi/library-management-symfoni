<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher extends User
{
    #[ORM\Column(length: 180, unique: true)]
    private ?string $teacherId = null;

    #[ORM\Column(length: 255)]
    private ?string $department = null;

    public function getTeacherId(): ?string
    {
        return $this->teacherId;
    }

    public function setTeacherId(string $teacherId): static
    {
        $this->teacherId = $teacherId;
        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(string $department): static
    {
        $this->department = $department;
        return $this;
    }
}
