<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ApiResource]
class Event
{
    use Timestampable;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $cover = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column]
    private ?bool $parution = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventSchedules::class, orphanRemoval: true)]
    private Collection $eventSchedules;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventOpinion::class, orphanRemoval: true)]
    private Collection $eventOpinions;

    #[ORM\OneToOne(mappedBy: 'event', cascade: ['persist', 'remove'])]
    private ?EventNetworks $eventNetworks = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventType::class, orphanRemoval: true)]
    private Collection $eventTypes;

    public function __construct()
    {
        $this->eventSchedules = new ArrayCollection();
        $this->eventOpinions = new ArrayCollection();
        $this->eventTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }


    public function isParution(): ?bool
    {
        return $this->parution;
    }

    public function setParution(bool $parution): self
    {
        $this->parution = $parution;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection<int, EventSchedules>
     */
    public function getEventSchedules(): Collection
    {
        return $this->eventSchedules;
    }

    public function addEventSchedule(EventSchedules $eventSchedule): self
    {
        if (!$this->eventSchedules->contains($eventSchedule)) {
            $this->eventSchedules->add($eventSchedule);
            $eventSchedule->setEvent($this);
        }

        return $this;
    }

    public function removeEventSchedule(EventSchedules $eventSchedule): self
    {
        if ($this->eventSchedules->removeElement($eventSchedule)) {
            // set the owning side to null (unless already changed)
            if ($eventSchedule->getEvent() === $this) {
                $eventSchedule->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EventOpinion>
     */
    public function getEventOpinions(): Collection
    {
        return $this->eventOpinions;
    }

    public function addEventOpinion(EventOpinion $eventOpinion): self
    {
        if (!$this->eventOpinions->contains($eventOpinion)) {
            $this->eventOpinions->add($eventOpinion);
            $eventOpinion->setEvent($this);
        }

        return $this;
    }

    public function removeEventOpinion(EventOpinion $eventOpinion): self
    {
        if ($this->eventOpinions->removeElement($eventOpinion)) {
            // set the owning side to null (unless already changed)
            if ($eventOpinion->getEvent() === $this) {
                $eventOpinion->setEvent(null);
            }
        }

        return $this;
    }

    public function getEventNetworks(): ?EventNetworks
    {
        return $this->eventNetworks;
    }

    public function setEventNetworks(EventNetworks $eventNetworks): self
    {
        // set the owning side of the relation if necessary
        if ($eventNetworks->getEvent() !== $this) {
            $eventNetworks->setEvent($this);
        }

        $this->eventNetworks = $eventNetworks;

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
            $eventType->setEvent($this);
        }

        return $this;
    }

    public function removeEventType(EventType $eventType): self
    {
        if ($this->eventTypes->removeElement($eventType)) {
            // set the owning side to null (unless already changed)
            if ($eventType->getEvent() === $this) {
                $eventType->setEvent(null);
            }
        }

        return $this;
    }
}
