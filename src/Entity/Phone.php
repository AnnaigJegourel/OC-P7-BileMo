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
    /**
     * @var integer|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brand = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $colour = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var float|null
     */
    #[ORM\Column(nullable: true)]
    private ?float $height = null;

    /**
     * @var float|null
     */
    #[ORM\Column(nullable: true)]
    private ?float $weight = null;

    /**
     * @var float|null
     */
    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    /**
     * @var float|null
     */
    #[ORM\Column(nullable: true)]
    private ?float $width = null;


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
    public function getBrand(): ?string
    {
        return $this->brand;

    }


    /**
     * @param string|null $brand
     * @return self
     */
    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;

    }


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;

    }


    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;

    }


    /**
     * @return string|null
     */
    public function getColour(): ?string
    {
        return $this->colour;

    }


    /**
     * @param string|null $colour
     * @return self
     */
    public function setColour(?string $colour): self
    {
        $this->colour = $colour;

        return $this;

    }


    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;

    }


    /**
     * @param string|null $description
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;

    }


    /**
     * @return float|null
     */
    public function getHeight(): ?float
    {
        return $this->height;

    }


    /**
     * @param float|null $height
     * @return self
     */
    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;

    }


    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;

    }


    /**
     * @param float|null $weight
     * @return self
     */
    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;

    }


    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;

    }


    /**
     * @param float|null $price
     * @return self
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;

    }


    /**
     * @return float|null
     */
    public function getWidth(): ?float
    {
        return $this->width;

    }


    /**
     * @param float|null $width
     * @return self
     */
    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;

    }


}
