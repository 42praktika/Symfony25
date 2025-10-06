<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user_get')]
    public function index(UserRepository $userRepository, string $id): Response
    {
        $user = $userRepository->find($id)??new User();

        return $this->render('user/index.html.twig', [
            'user'=>$user,
        ]);
    }

    #[Route('/users', name: 'user_list')]
    public function getUsers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return  $this->render('user/list.twig', ['users'=>$users]);
    }

    #[Route('/users/{age}', name: 'user_list_age')]
    public function getYoungUsers(UserRepository $userRepository, string $age): Response
    {
        $age = is_numeric($age)? (int)$age:999;

        $users = $userRepository->findLessThenAge($age);
        return  $this->render('user/list.twig', ['users'=>$users]);
    }

    #[Route('/user/add/{name}', name: 'user_add')]
    public function createUser(EntityManagerInterface $manager, string $name): Response
    {
        $user = new User();
        $user->setName($name);
        $manager->persist($user);
        $manager->flush();
        return new Response("Success! User id: ".$user->getId());

    }

    #[Route('/user/del/{id}', name: 'user_del')]
    public function deleteUser(EntityManagerInterface $manager, string $id): Response
    {
        $userRepository = $manager->getRepository(User::class);
        $user = $userRepository->find($id);
        $manager->remove($user);
        $manager->flush();
        return new Response("Success!");
    }
}
