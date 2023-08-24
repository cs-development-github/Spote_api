<?php

namespace App\Controller;

use App\Entity\MediaObject;
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
        $user->setLastname($data['lastname']);
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password']
        );

        if(isset($data['avatar'])){
            $user->setAvatar($entityManager->getRepository(MediaObject::class)->findBy(['id'=> $data['avatar'] ])[0]);
        } else {
            $user->setAvatar($entityManager->getRepository(MediaObject::class)->findBy(['id'=>'1'])[0]);
        }
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($hashedPassword);
        $user->setEmail($data['email']);
        $user->setDateOfBirth(new \DateTimeImmutable($data['dateOfBirth']));
        $user->setGender($data['gender']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['message' => "Enregistrement réussi"]);
    }
}
