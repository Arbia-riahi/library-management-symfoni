<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $commandId = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'commands')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    #[ORM\OneToOne(mappedBy: 'command', cascade: ['persist', 'remove'])]
    private ?Payment $payment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommandId(): ?string
    {
        return $this->commandId;
    }

    public function setCommandId(string $commandId): static
    {
        $this->commandId = $commandId;
        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): static
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): static
    {
        $this->book = $book;
        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(?Payment $payment): static
    {
        // unset the owning side of the relation if necessary
        if ($payment === null && $this->payment !== null) {
            $this->payment->setCommand(null);
        }

        // set the owning side of the relation if necessary
        if ($payment !== null && $payment->getCommand() !== $this) {
            $payment->setCommand($this);
        }

        $this->payment = $payment;
        return $this;
    }
}
