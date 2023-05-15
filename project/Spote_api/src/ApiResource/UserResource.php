<?php

namespace App\ApiResource;


use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\MeController;
use App\Entity\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/me',
            controller: MeController::class,
            name: 'me'
        ),
        new GetCollection(
            security: "is_granted('ROLE_ADMIN')",
        )
    ]
)]

class UserResource implements UserInterface, PasswordAuthenticatedUserInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getId(): ?int
    {
        return $this->user->getId();
    }

    public function getEmail(): ?string
    {
        return $this->user->getEmail();
    }

    public function setEmail(string $email): self
    {
        $this->user->setEmail($email);

        return $this;
    }


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->user->getEmail();
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->user->getRoles();
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->user->setRoles($roles);

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->user->getPassword();
    }

    public function setPassword(string $password): self
    {
        $this->user->setPassword($password);

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
        return $this->user->getName();
    }

    public function setName(string $name): self
    {
        $this->user->setName($name);

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->user->getName();
    }

    public function setLastname(string $lastname): self
    {
        $this->user->setLastname($lastname);

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->user->getAvatar();
    }

    public function setAvatar(?string $avatar): self
    {
        $this->user->setAvatar($avatar);

        return $this;
    }
}