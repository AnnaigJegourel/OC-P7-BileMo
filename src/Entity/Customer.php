<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getUsers'])]
    /**
     * @var int|null
     */
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getUsers'])]
    /**
     * @var string|null
     */
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: User::class, orphanRemoval: true)]
    /**
     * @var Collection
     */
    private Collection $users;


    /**
     * Customer constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();

    }


    public function getId(): ?int
    {
        return $this->id;

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


    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;

    }


    /**
     * Add a User object to the database
     *
     * @param User $user
     *
     * @return self
     */
    public function addUser(User $user): self
    {
        if ($this->users->contains($user) === false) {
                $this->users->add($user);
            $user->setCustomer($this);
        }

        return $this;

    }


    /**
     * Delete a User object from the database
     *
     * @param User $user
     *
     * @return self
     */
    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user) === true) {
                // Set the owning side to null (unless already changed).
                $user->setCustomer(null);
        }

        return $this;

    }


}
