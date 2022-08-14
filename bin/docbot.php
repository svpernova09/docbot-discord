<?php

include __DIR__.'/../vendor/autoload.php';

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Docbot\MessageParser;


$discord = new Discord([
    'token' => getenv('DOCBOT_TOKEN'),
]);

// When the Bot is ready
$discord->on('ready', function (Discord $discord) {

    // Listen for messages
    $discord->on('message', function (Message $message, Discord $discord) {

        // If message is from a bot
        if ($message->author->bot) {
            // Do nothing
            return;
        }

        $parser = new MessageParser;
        $result = $parser($message);

        if ($result !== false){
            $message->reply($result);
        }
    });

});

// Start the Bot (must be at the bottom)
$discord->run();