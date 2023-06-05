<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ApiResource]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("event")]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'Categorie', targetEntity: EventType::class, orphanRemoval: true)]
    private Collection $eventTypes;

    public function __construct()
    {
        $this->eventTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, EventType>
     */
    public function getEventTypes(): Collection
    {
        return $this->eventTypes;
    }

    public function addEventType(EventType $eventType): self
    {
        if (!$this->eventTypes->contains($eventType)) {
            $this->eventTypes->add($eventType);
            $eventType->setCategorie($this);
        }

        return $this;
    }

    public function removeEventType(EventType $eventType): self
    {
        if ($this->eventTypes->removeElement($eventType)) {
            // set the owning side to null (unless already changed)
            if ($eventType->getCategorie() === $this) {
                $eventType->setCategorie(null);
            }
        }

        return $this;
    }
}