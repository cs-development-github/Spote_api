<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventOpinionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EventOpinionRepository::class)]
#[ApiResource]
class EventOpinion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups("event")]
    private ?int $note = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups("event")]
    private ?string $opinion = null;

    #[ORM\ManyToOne(inversedBy: 'eventOpinions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("event")]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'eventOpinions')]
    #[ORM\JoinColumn(nullable: false)]

    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getOpinion(): ?string
    {
        return $this->opinion;
    }

    public function setOpinion(?string $opinion): self
    {
        $this->opinion = $opinion;

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

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
}
