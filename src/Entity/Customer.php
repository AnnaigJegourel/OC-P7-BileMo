<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getUsers'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getUsers'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: User::class, orphanRemoval: true)]
    private Collection $users;


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


    public function addUser(User $user): self
    {
        // if (!$this->users->contains($user)) {
        if ($this->users->contains($user) === false) {
                $this->users->add($user);
            $user->setCustomer($this);
        }

        return $this;

    }


    public function removeUser(User $user): self
    {
        // if ($this->users->removeElement($user)) {
        if ($this->users->removeElement($user) === true) {
                // Set the owning side to null (unless already changed).
                $user->setCustomer(null);
            }
        }

        return $this;

    }


}
