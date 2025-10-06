<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

final class HelloController extends AbstractController
{
    #[Route('/hello/{who}', name: 'app_hello_ext', methods: ["GET", "INFO"])]
    #[Route('/hello', name: 'app_hello')]
    public function index(LoggerInterface $logger,  string $who = "World"): Response
    {
        $logger->debug("Who: $who");
       // return new Response("<html><body>Hello $who</body></html>");
        return $this->render('hello/index.html.twig', [
            'name' => $who,
            'friends' => ["praktika", "itis", "42"]
        ]);
    }
}
