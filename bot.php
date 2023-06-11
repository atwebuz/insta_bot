<?php

require_once __DIR__ . '/vendor/autoload.php';

use Telegram\Bot\Api;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Update;

class DownloadCommand extends Command
{
    protected $name = 'download';

    public function handle($arguments)
    {
        $videoUrl = $arguments;

        // Download the video using file_get_contents()
        $videoContent = file_get_contents($videoUrl);

        // Save the video file
        file_put_contents('video.mp4', $videoContent);

        // Send the video file to the user
        $this->replyWithVideo([
            'video' => fopen('video.mp4', 'r'),
        ]);
    }
}

$telegram = new Api('6052629950:AAFOdPDzWcK65TS37sRyt3RPRZVBAvJod3k');

$telegram->addCommand(DownloadCommand::class);

$telegram->commandsHandler(true);
