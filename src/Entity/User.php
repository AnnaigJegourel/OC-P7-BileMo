<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getUsers'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['getUsers'])]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(['getUsers'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['getUsers'])]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['getUsers'])]
    private ?string $lastName = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['getUsers'])]
    private ?Customer $customer = null;


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
    public function getUserIdentifier(): string
    {
        return (string) $this->email;

    }


    /**
     * Méthode retournant le champ utilisé pour l'authentification
     * utile pour JWT
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getUserIdentifier();

    }


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // Guarantee every user at least has ROLE_USER.
        $roles[] = 'ROLE_USER';

        return array_unique($roles);

    }


    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;

    }


    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password ?: '';

    }


    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;

    }


    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;

    }


    public function getFirstName(): ?string
    {
        return $this->firstName;

    }


    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;

    }


    public function getLastName(): ?string
    {
        return $this->lastName;

    }


    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;

    }


    public function getCustomer(): ?Customer
    {
        return $this->customer;

    }


    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;

    }


}
