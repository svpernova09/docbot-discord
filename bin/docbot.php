<?php

include __DIR__.'/../vendor/autoload.php';

use Discord\DiscordCommandClient;
use Discord\Parts\Channel\Message;
use Docbot\Commands\DocsCommand;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$discord = new DiscordCommandClient([
    'token' => $_ENV['BOT_TOKEN'],
    'prefix' => false,
    'caseInsensitiveCommands' => true,
]);

// Register commands
$discord->registerCommand('docs', fn($message) => (new DocsCommand)($message));

// When the Bot is ready
$discord->on('ready', function (DiscordCommandClient $discord) {

    // Listen to messages for text-based reactions
    $discord->on('message', function(Message $message) {
        if (strtolower($message->content) == 'good bot') {
            $message->react('😘');
        }
    });

});

// Start the Bot (must be at the bottom)
$discord->run();