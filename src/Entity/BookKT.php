<?php

namespace App\Entity;

use App\Repository\BookKTRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookKTRepository::class)
 */
class BookKT
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
    private $region;

    /**
     * @ORM\Column(type="float")
     */
    private $index;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getIndex(): ?float
    {
        return $this->index;
    }

    public function setIndex(float $index): self
    {
        $this->index = $index;

        return $this;
    }
}
