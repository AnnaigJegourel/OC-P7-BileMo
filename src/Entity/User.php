<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_user_details",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute= true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups="getUsers", excludeIf="expr(not is_granted('ROLE_USER'))"),
 * )
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "app_user_delete",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute= true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups="getUsers", excludeIf = "expr(not is_granted('ROLE_USER'))"),
 * )
 *
 * @Hateoas\Relation(
 *      "update",
 *      href = @Hateoas\Route(
 *          "app_user_update",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute= true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups="getUsers", excludeIf = "expr(not is_granted('ROLE_USER'))"),
 * )
 *
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    /**
     * @var integer|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getUsers'])]
    private ?int $id = null;

    /**
     * users' e-mail, used as identifier "username"
     * @var string
     */
    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['getUsers'])]
    #[Assert\NotBlank(message:"Adresse e-mail requise!")]
    #[Assert\Email(message: "L'email {{ value }} n'est pas valide.")]
    private ?string $email = null;

    /**
     * @var array<int,string>
     */
    #[ORM\Column(type: 'json', nullable: true)]
    #[Groups(['getUsers'])]
    private array $roles = ['ROLE_USER'];

    /**
     * @var string|null The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['getUsers'])]
    #[Assert\Length(min: 1, max: 255, minMessage:"Le nom doit faire au minimum {{limit}} caractères", maxMessage:"Le nom doit faire au maximum {{limit}} caractères")]
    private ?string $firstName = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['getUsers'])]
    #[Assert\Length(min: 1, max: 255, minMessage:"Le nom doit faire au minimum {{limit}} caractères", maxMessage:"Le nom doit faire au maximum {{limit}} caractères")]
    private ?string $lastName = null;

    /**
     * Customer linked to this User
     *
     * @var Customer|null
     */
    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['getUsers'])]
    private ?Customer $customer = null;


    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;

    }


    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;

    }


    /**
     * @param string $email
     * @return self
     */
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

    /**
     * @param array<int,string> $roles
     *
     * @return $this
     */
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


    /**
     * @param string $password
     * @return self
     */
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


    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;

    }


    /**
     * @param string|null $firstName
     * @return self
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;

    }


    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;

    }


    /**
     * @param string|null $lastName
     * @return self
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;

    }


    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;

    }


    /**
     * @param Customer|null $customer
     * @return self
     */
    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;

    }


}
