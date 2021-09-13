<?php

namespace App\Controller;

use App\Core\TheaterManagement;
use App\Entity\Theater;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TheaterController extends AbstractController
{
    public function __construct(
        private TheaterManagement $management
    ) {
    }

    #[ParamConverter('theater', class: Theater::class, options: ['id' => 'id'])]
    #[Route('/theater/{id}/user/add', name: 'theater_user_add')]
    public function addUser(Theater $theater, EntityManagerInterface $entityManager): Response
    {
        // とりあえず決め打ち
        $name = 'お名前';
        $email = 'sample@phpcon.php.gr.jp';
        $password = 'strong_password';

        $user = $this->management->createUser($theater, $name, $email, $password);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['user' => $user]);
    }
}
