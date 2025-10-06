<?php

namespace App\Service;

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use function PHPUnit\Framework\matches;

class GreetingGenerator
{

    public function __construct(private LoggerInterface $logger, private string $lang)
    {
    }

    public function getGreeting(): string
    {
        $messagesEng = [
            "Hello!",
            "Hi!",

        ];

        $messagesRus = [
            "Привет!",
            "Добрый вечер!"
        ];

        $messages = match($this->lang) {
            "russian" => $messagesRus,
            "english" => $messagesEng,
            default => array_merge($messagesRus, $messagesEng)
        };

        $index = array_rand($messages);
        $chosen = $messages[$index];
        $this->logger->info("Greeting is $chosen");
        return $chosen;
    }
}
