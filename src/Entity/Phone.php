<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_phone_details",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute= true
 *      ),
 *      exclusion = @Hateoas\Exclusion(excludeIf="expr(not is_granted('ROLE_USER'))")
 * )
 */
#[ORM\Entity(repositoryClass: PhoneRepository::class)]
class Phone
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     * @var integer|null
     */
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    /**
     * @var string|null
     */
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    /**
     * @var string|null
     */
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    /**
     * @var string|null
     */
    private ?string $colour = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    /**
     * @var string|null
     */
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    /**
     * @var float|null
     */
    private ?float $height = null;

    #[ORM\Column(nullable: true)]
    /**
     * @var float|null
     */
    private ?float $weight = null;

    #[ORM\Column(nullable: true)]
    /**
     * @var float|null
     */
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    /**
     * @var float|null
     */
    private ?float $width = null;


    public function getId(): ?int
    {
        return $this->id;

    }


    public function getBrand(): ?string
    {
        return $this->brand;

    }


    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

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


    public function getColour(): ?string
    {
        return $this->colour;

    }


    public function setColour(?string $colour): self
    {
        $this->colour = $colour;

        return $this;

    }


    public function getDescription(): ?string
    {
        return $this->description;

    }


    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;

    }


    public function getHeight(): ?float
    {
        return $this->height;

    }


    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;

    }


    public function getWeight(): ?float
    {
        return $this->weight;

    }


    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;

    }


    public function getPrice(): ?float
    {
        return $this->price;

    }


    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;

    }


    public function getWidth(): ?float
    {
        return $this->width;

    }


    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;

    }


}
