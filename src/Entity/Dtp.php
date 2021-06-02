<?php

namespace App\Entity;

use App\Repository\DtpRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DtpRepository::class)
 */
class Dtp
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_dtp;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress_dtp;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $degree;

    /**
     * @ORM\Column(type="boolean")
     */
    private $initiator;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDtp(): ?\DateTimeInterface
    {
        return $this->date_dtp;
    }

    public function setDateDtp(\DateTimeInterface $date_dtp): self
    {
        $this->date_dtp = $date_dtp;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdressDtp(): ?string
    {
        return $this->adress_dtp;
    }

    public function setAdressDtp(string $adress_dtp): self
    {
        $this->adress_dtp = $adress_dtp;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getInitiator(): ?bool
    {
        return $this->initiator;
    }

    public function setInitiator(bool $initiator): self
    {
        $this->initiator = $initiator;

        return $this;
    }
}
