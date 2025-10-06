<?php

namespace App\Controller;

use App\Service\GreetingGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

final class HelloController extends AbstractController
{
    #[Route('/hello/{who}', name: 'app_hello_ext', methods: ["GET", "INFO"])]
    #[Route('/hello', name: 'app_hello')]
    public function index(LoggerInterface $logger, GreetingGenerator $generator,  string $who = "World"): Response
    {
        $logger->debug("Who: $who");
        $greeting = $generator->getGreeting();
       // return new Response("<html><body>Hello $who</body></html>");
        return $this->render('hello/index.html.twig', [
            'name' => $who,
            'greeting' => $greeting,
            'friends' => ["praktika", "itis", "42"]
        ]);
    }
}
