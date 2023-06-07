<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventNetworksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EventNetworksRepository::class)]
#[ApiResource]
class EventNetworks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("event")]
    private ?string $network_name = null;

    #[ORM\Column(length: 255)]
    private ?string $networkUrl = null;

    #[ORM\ManyToOne(inversedBy: 'eventNetworks')]
    private ?Event $Event = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNetworkName(): ?string
    {
        return $this->network_name;
    }

    public function setNetworkName(string $network_name): self
    {
        $this->network_name = $network_name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getNetworkUrl(): ?string
    {
        return $this->networkUrl;
    }

    public function setNetworkUrl(string $networkUrl): self
    {
        $this->networkUrl = $networkUrl;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvent(): Collection
    {
        return $this->Event;
    }

    public function setEvent(?Event $Event): self
    {
        $this->Event = $Event;

        return $this;
    }
}
