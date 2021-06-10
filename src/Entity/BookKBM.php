<?php

namespace App\Entity;

use App\Repository\BookKBMRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookKBMRepository::class)
 */
class BookKBM
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $class;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $index;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payoutOne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payoutTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payoutThree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payoutFour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payoutsNull;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getIndex(): ?string
    {
        return $this->index;
    }

    public function setIndex(string $index): self
    {
        $this->index = $index;

        return $this;
    }

    public function getPayoutOne(): ?string
    {
        return $this->payoutOne;
    }

    public function setPayoutOne(string $payoutOne): self
    {
        $this->payoutOne = $payoutOne;

        return $this;
    }

    public function getPayoutTwo(): ?string
    {
        return $this->payoutTwo;
    }

    public function setPayoutTwo(string $payoutTwo): self
    {
        $this->payoutTwo = $payoutTwo;

        return $this;
    }

    public function getPayoutThree(): ?string
    {
        return $this->payoutThree;
    }

    public function setPayoutThree(string $payoutThree): self
    {
        $this->payoutThree = $payoutThree;

        return $this;
    }

    public function getPayoutFour(): ?string
    {
        return $this->payoutFour;
    }

    public function setPayoutFour(string $payoutFour): self
    {
        $this->payoutFour = $payoutFour;

        return $this;
    }

    public function getPayoutsNull(): ?string
    {
        return $this->payoutsNull;
    }

    public function setPayoutsNull(string $payoutsNull): self
    {
        $this->payoutsNull = $payoutsNull;

        return $this;
    }
}
