<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['event']]
)]
class  Event
{
    use Timestampable;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("event")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("event")]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups("event")]
    private ?string $cover = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups("event")]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups("event")]
    private ?string $location = null;

    #[ORM\Column]
    #[Groups("event")]
    private ?bool $parution = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups("event")]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups("event")]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventSchedules::class, orphanRemoval: true)]
    #[Groups("event")]
    private Collection $eventSchedules;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventOpinion::class, orphanRemoval: true)]
    #[Groups("event")]
    private Collection $eventOpinions;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: EventType::class, orphanRemoval: true)]
    #[Groups("event")]
    private Collection $eventTypes;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("event")]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'Event', targetEntity: EventNetworks::class)]
    private Collection $eventNetworks;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->eventSchedules = new ArrayCollection();
        $this->eventOpinions = new ArrayCollection();
        $this->eventTypes = new ArrayCollection();
        $this->eventNetworks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, EventNetworks>
     */
    public function getEventNetworks(): Collection
    {
        return $this->eventNetworks;
    }

    public function addEventNetwork(EventNetworks $eventNetwork): self
    {
        if (!$this->eventNetworks->contains($eventNetwork)) {
            $this->eventNetworks->add($eventNetwork);
            $eventNetwork->setEvent($this);
        }

        return $this;
    }

    public function removeEventNetwork(EventNetworks $eventNetwork): self
    {
        if ($this->eventNetworks->removeElement($eventNetwork)) {
            // set the owning side to null (unless already changed)
            if ($eventNetwork->getEvent() === $this) {
                $eventNetwork->setEvent(null);
            }
        }

        return $this;
    }
}
