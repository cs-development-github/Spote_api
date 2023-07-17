<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiProperty;
use App\Controller\MeController;
use App\Controller\UploadImageUserController;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Get(
            uriTemplate: '/me',
            controller: MeController::class,
            name: 'me'
        ),
    ]
)]


class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Timestampable;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(["event"])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(["event"])]
    private ?string $lastname = null;

    #[ORM\ManyToOne(targetEntity: MediaObject::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(["event"])]
    private ?string $avatar = null;


    #[ORM\OneToMany(mappedBy: 'user', targetEntity: EventOpinion::class, orphanRemoval: true)]
    private Collection $eventOpinions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(nullable: true)]
    private ?int $gendre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->eventOpinions = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
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
            $eventOpinion->setUser($this);
        }

        return $this;
    }

    public function removeEventOpinion(EventOpinion $eventOpinion): self
    {
        if ($this->eventOpinions->removeElement($eventOpinion)) {
            // set the owning side to null (unless already changed)
            if ($eventOpinion->getUser() === $this) {
                $eventOpinion->setUser(null);
            }
        }

        return $this;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setUser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getUser() === $this) {
                $event->setUser(null);
            }
        }

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getGendre(): ?int
    {
        return $this->gendre;
    }

    public function setGendre(?int $gendre): self
    {
        $this->gendre = $gendre;

        return $this;
    }
}
