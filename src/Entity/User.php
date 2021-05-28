<?php

namespace App\Entity;

use App\Model\UserDto;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @OA\Schema(
 *     title="UserModel",
 *     description="UserModel"
 * )
 *
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="Users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $number_driver;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $midName;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressDriver;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expDriver;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $genderDriver;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $KBM;

    /**
     * @ORM\OneToMany(targetEntity=Auto::class, mappedBy="users")
     */
    private $autos;

    /**
     * @ORM\OneToMany(targetEntity=Contract::class, mappedBy="users")
     */
    private $contracts;

    public function __construct()
    {
        $this->autos = new ArrayCollection();
        $this->contracts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNumberDriver(): ?string
    {
        return $this->number_driver;
    }

    public function setNumberDriver(string $number_driver): self
    {
        $this->number_driver = $number_driver;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMidName(): ?string
    {
        return $this->midName;
    }

    public function setMidName(string $midName): self
    {
        $this->midName = $midName;

        return $this;
    }

    public function getDateDriver(): ?\DateTimeInterface
    {
        return $this->dateDriver;
    }

    public function setDateDriver(\DateTimeInterface $dateDriver): self
    {
        $this->dateDriver = $dateDriver;

        return $this;
    }

    public function getAdressDriver(): ?string
    {
        return $this->adressDriver;
    }

    public function setAdressDriver(string $adressDriver): self
    {
        $this->adressDriver = $adressDriver;

        return $this;
    }

    public function getExpDriver(): ?int
    {
        return $this->expDriver;
    }

    public function setExpDriver(int $expDriver): self
    {
        $this->expDriver = $expDriver;

        return $this;
    }

    public function getGenderDriver(): ?bool
    {
        return $this->genderDriver;
    }

    public function setGenderDriver(bool $genderDriver): self
    {
        $this->genderDriver = $genderDriver;

        return $this;
    }

    public function getKBM(): ?float
    {
        return $this->KBM;
    }

    public function setKBM(float $KBM): self
    {
        $this->KBM = $KBM;

        return $this;
    }

    public static function fromDto(UserDto $userDto): self
    {
        $user = new self();
        $user->setEmail($userDto->email);
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($userDto->password);
        $user->setName($userDto->name);
        $user->setSurname($userDto->surname);
        $user->setMidName($userDto->midName);
        $user->setDateDriver( new \DateTime($userDto->dateDriver));
        $user->setExpDriver($userDto->expDriver);
        $user->setGenderDriver($userDto->genderDriver);
        $user->setKBM($userDto->KBM);


        return $user;
    }

    /**
     * @return Collection|Auto[]
     */
    public function getAutos(): Collection
    {
        return $this->autos;
    }

    public function addAuto(Auto $auto): self
    {
        if (!$this->autos->contains($auto)) {
            $this->autos[] = $auto;
            $auto->setUsers($this);
        }

        return $this;
    }

    public function removeAuto(Auto $auto): self
    {
        if ($this->autos->removeElement($auto)) {
            // set the owning side to null (unless already changed)
            if ($auto->getUsers() === $this) {
                $auto->setUsers(null);
            }
        }

        return $this;
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
            $contract->setUsers($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contracts->removeElement($contract)) {
            // set the owning side to null (unless already changed)
            if ($contract->getUsers() === $this) {
                $contract->setUsers(null);
            }
        }

        return $this;
    }

}