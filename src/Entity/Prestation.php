<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?bool $isQuote = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $optional = null;

    /**
     * @var Collection<int, HairSalon>
     */
    #[ORM\ManyToMany(targetEntity: HairSalon::class, mappedBy: 'prestation')]
    private Collection $hairSalons;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'prestation')]
    private Collection $categories;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'prestations')]
    private Collection $service;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'prestation')]
    private Collection $reservations;

    public function __construct()
    {
        $this->hairSalons = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->service = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isQuote(): ?bool
    {
        return $this->isQuote;
    }

    public function setIsQuote(bool $isQuote): static
    {
        $this->isQuote = $isQuote;

        return $this;
    }

    public function getOptional(): ?string
    {
        return $this->optional;
    }

    public function setOptional(?string $optional): static
    {
        $this->optional = $optional;

        return $this;
    }

    /**
     * @return Collection<int, HairSalon>
     */
    public function getHairSalons(): Collection
    {
        return $this->hairSalons;
    }

    public function addHairSalon(HairSalon $hairSalon): static
    {
        if (!$this->hairSalons->contains($hairSalon)) {
            $this->hairSalons->add($hairSalon);
            $hairSalon->addPrestation($this);
        }

        return $this;
    }

    public function removeHairSalon(HairSalon $hairSalon): static
    {
        if ($this->hairSalons->removeElement($hairSalon)) {
            $hairSalon->removePrestation($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addPrestation($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removePrestation($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Service $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        $this->service->removeElement($service);

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setPrestation($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPrestation() === $this) {
                $reservation->setPrestation(null);
            }
        }

        return $this;
    }
}
