<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[ApiResource]
class UserController extends AbstractController
{
    public function register(Request $request, EntityManagerInterface $entityManager,  UserPasswordHasherInterface $passwordHasher): Response
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setName($data['name']);
        if($data['avatar']){
            $user->setAvatar($data['avatar']);
        }
        $user->setLastname($data['lastname']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password']
        );
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($hashedPassword);
        $user->setEmail($data['email']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['message' => "Enregistrement réussi"]);
    }
}
