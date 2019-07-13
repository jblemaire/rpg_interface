<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElementRepository")
 */
class Element
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isTemplate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $effect;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $use_cost;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $use_number;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stack_size;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_upgrade_max;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_upgrade;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Slot")
     */
    private $slot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rarity")
     */
    private $rarity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Family")
     */
    private $family;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stat")
     */
    private $stat;

    public function __construct()
    {
        $this->stat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIsTemplate(): ?bool
    {
        return $this->isTemplate;
    }

    public function setIsTemplate(?bool $isTemplate): self
    {
        $this->isTemplate = $isTemplate;

        return $this;
    }

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(?string $effect): self
    {
        $this->effect = $effect;

        return $this;
    }

    public function getUseCost(): ?string
    {
        return $this->use_cost;
    }

    public function setUseCost(?string $use_cost): self
    {
        $this->use_cost = $use_cost;

        return $this;
    }

    public function getUseNumber(): ?int
    {
        return $this->use_number;
    }

    public function setUseNumber(?int $use_number): self
    {
        $this->use_number = $use_number;

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

    public function getStackSize(): ?int
    {
        return $this->stack_size;
    }

    public function setStackSize(?int $stack_size): self
    {
        $this->stack_size = $stack_size;

        return $this;
    }

    public function getNbUpgradeMax(): ?int
    {
        return $this->nb_upgrade_max;
    }

    public function setNbUpgradeMax(?int $nb_upgrade_max): self
    {
        $this->nb_upgrade_max = $nb_upgrade_max;

        return $this;
    }

    public function getNbUpgrade(): ?int
    {
        return $this->nb_upgrade;
    }

    public function setNbUpgrade(?int $nb_upgrade): self
    {
        $this->nb_upgrade = $nb_upgrade;

        return $this;
    }

    public function getSlot(): ?slot
    {
        return $this->slot;
    }

    public function setSlot(?slot $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    public function getRarity(): ?rarity
    {
        return $this->rarity;
    }

    public function setRarity(?rarity $rarity): self
    {
        $this->rarity = $rarity;

        return $this;
    }

    public function getType(): ?type
    {
        return $this->type;
    }

    public function setType(?type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFamily(): ?family
    {
        return $this->family;
    }

    public function setFamily(?family $family): self
    {
        $this->family = $family;

        return $this;
    }

    /**
     * @return Collection|stat[]
     */
    public function getStat(): Collection
    {
        return $this->stat;
    }

    public function addStat(stat $stat): self
    {
        if (!$this->stat->contains($stat)) {
            $this->stat[] = $stat;
        }

        return $this;
    }

    public function removeStat(stat $stat): self
    {
        if ($this->stat->contains($stat)) {
            $this->stat->removeElement($stat);
        }

        return $this;
    }
}
