<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EventTypeRepository::class)]
#[ApiResource]
class EventType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'eventTypes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?event $event = null;

    #[ORM\ManyToOne(inversedBy: 'eventTypes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("event")]
    private ?Category $Category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?event
    {
        return $this->event;
    }

    public function setEvent(?event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }
}
