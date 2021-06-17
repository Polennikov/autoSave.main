<?php

namespace App\Entity;

use App\Repository\AutoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Model\AutoDto;
/**
 * @ORM\Entity(repositoryClass=AutoRepository::class)
 */
class Auto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $vin;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $marka;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $power;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $mileage;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="autos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Contract::class, mappedBy="auto",orphanRemoval=true)
     */
    private $contracts;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $number_sts;

    /**
     * @ORM\OneToMany(targetEntity=Dtp::class, mappedBy="autos")
     */
    private $dtps;

    public function __toString()
    {
        return (string)$this->vin;
    }

    public function __construct()
    {
        $this->contracts = new ArrayCollection();
        $this->dtps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): self
    {
        $this->vin = $vin;

        return $this;
    }

    public function getMarka(): ?string
    {
        return $this->marka;
    }

    public function setMarka(string $marka): self
    {
        $this->marka = $marka;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public static function fromDto(AutoDto $autoDto,User $user): self
    {
        $auto= new self();
        $auto->setVin($autoDto->vin);
        $auto->setMarka($autoDto->marka);
        $auto->setModel($autoDto->model);
        $auto->setNumber($autoDto->number);
        $auto->setColor($autoDto->color);
        $auto->setYear($autoDto->year);
        $auto->setPower($autoDto->power);
        $auto->setCategory($autoDto->category);
        $auto->setUsers($user);

        return $auto;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    public function addContract(Contract $contract): self
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts[] = $contract;
            $contract->setAuto($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contracts->removeElement($contract)) {
            // set the owning side to null (unless already changed)
            if ($contract->getAuto() === $this) {
                $contract->setAuto(null);
            }
        }

        return $this;
    }

    public function getNumberSts(): ?string
    {
        return $this->number_sts;
    }

    public function setNumberSts(string $number_sts): self
    {
        $this->number_sts = $number_sts;

        return $this;
    }

    /**
     * @return Collection|Dtp[]
     */
    public function getDtps(): Collection
    {
        return $this->dtps;
    }

    public function addDtp(Dtp $dtp): self
    {
        if (!$this->dtps->contains($dtp)) {
            $this->dtps[] = $dtp;
            $dtp->setAutos($this);
        }

        return $this;
    }

    public function removeDtp(Dtp $dtp): self
    {
        if ($this->dtps->removeElement($dtp)) {
            // set the owning side to null (unless already changed)
            if ($dtp->getAutos() === $this) {
                $dtp->setAutos(null);
            }
        }

        return $this;
    }
    
}
