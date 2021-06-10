<?php

namespace App\Entity;

use App\Repository\BookKBCRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookKBCRepository::class)
 */
class BookKBC
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
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearOneMin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearOne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearThree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearFive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearSeven;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearTen;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yearFivten;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getYearOneMin(): ?string
    {
        return $this->yearOneMin;
    }

    public function setYearOneMin(string $yearOneMin): self
    {
        $this->yearOneMin = $yearOneMin;

        return $this;
    }

    public function getYearOne(): ?string
    {
        return $this->yearOne;
    }

    public function setYearOne(string $yearOne): self
    {
        $this->yearOne = $yearOne;

        return $this;
    }

    public function getYearTwo(): ?string
    {
        return $this->yearTwo;
    }

    public function setYearTwo(string $yearTwo): self
    {
        $this->yearTwo = $yearTwo;

        return $this;
    }

    public function getYearThree(): ?string
    {
        return $this->yearThree;
    }

    public function setYearThree(string $yearThree): self
    {
        $this->yearThree = $yearThree;

        return $this;
    }

    public function getYearFive(): ?string
    {
        return $this->yearFive;
    }

    public function setYearFive(string $yearFive): self
    {
        $this->yearFive = $yearFive;

        return $this;
    }

    public function getYearSeven(): ?string
    {
        return $this->yearSeven;
    }

    public function setYearSeven(string $yearSeven): self
    {
        $this->yearSeven = $yearSeven;

        return $this;
    }

    public function getYearTen(): ?string
    {
        return $this->yearTen;
    }

    public function setYearTen(string $yearTen): self
    {
        $this->yearTen = $yearTen;

        return $this;
    }

    public function getYearFivten(): ?string
    {
        return $this->yearFivten;
    }

    public function setYearFivten(string $yearFivten): self
    {
        $this->yearFivten = $yearFivten;

        return $this;
    }
}
