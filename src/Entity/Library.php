<?php

namespace App\Entity;

use App\Repository\LibraryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibraryRepository::class)]
class Library
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $libraryId = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\OneToMany(mappedBy: 'library', targetEntity: Book::class)]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibraryId(): ?string
    {
        return $this->libraryId;
    }

    public function setLibraryId(string $libraryId): static
    {
        $this->libraryId = $libraryId;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;
        return $this;
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setLibrary($this);
        }
        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->books->removeElement($book)) {
            if ($book->getLibrary() === $this) {
                $book->setLibrary(null);
            }
        }
        return $this;
    }
}
