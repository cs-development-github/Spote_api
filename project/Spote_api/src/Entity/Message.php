<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]
#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(["conversation"])]
    private ?string $content = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    #[Groups(["conversation"])]
    private $image = null;

    #[ORM\Column]
    #[Groups(["conversation"])]
    private ?\DateTimeImmutable $sent_at = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Conversation $conversation_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSentAt(): ?\DateTimeImmutable
    {
        return $this->sent_at;
    }

    public function setSentAt(\DateTimeImmutable $sent_at): self
    {
        $this->sent_at = $sent_at;

        return $this;
    }

    public function getConversationId(): ?Conversation
    {
        return $this->conversation_id;
    }

    public function setConversationId(?Conversation $conversation_id): self
    {
        $this->conversation_id = $conversation_id;

        return $this;
    }
}
