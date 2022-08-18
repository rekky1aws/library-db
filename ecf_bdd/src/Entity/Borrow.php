<?php

namespace App\Entity;

use App\Repository\BorrowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowRepository::class)]
class Borrow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $borrow_date = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $return_date = null;

    #[ORM\ManyToOne(inversedBy: 'borrows')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    #[ORM\ManyToOne(inversedBy: 'borrow')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Borrower $borrower = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowDate(): ?\DateTimeImmutable
    {
        return $this->borrow_date;
    }

    public function setBorrowDate(\DateTimeImmutable $borrow_date): self
    {
        $this->borrow_date = $borrow_date;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeImmutable
    {
        return $this->return_date;
    }

    public function setReturnDate(\DateTimeImmutable $return_date): self
    {
        $this->return_date = $return_date;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getBorrower(): ?Borrower
    {
        return $this->borrower;
    }

    public function setBorrower(?Borrower $borrower): self
    {
        $this->borrower = $borrower;

        return $this;
    }
}
