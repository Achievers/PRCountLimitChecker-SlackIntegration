<?php

namespace PRCountChecker;

class Slack
{
    private $incomingWebHookURL;
    private $channel;
    private $botName;
    private $botAvatarIcon; # Using slacks emoji syntax eg. :smiley:

    public function __construct($incomingWebHookUrl, $channelName, $botName, $botIcon)
    {
        $this->incomingWebHookURL = $incomingWebHookUrl;
        $this->channel = $channelName;
        $this->botName = $botName;
        $this->botAvatarIcon = $botIcon;
    }

    public function postMessageToSlackChannel($message)
    {
        $curlCmd = <<<CMD
curl -s -X POST --data-urlencode 'payload={"channel": "{$this->channel}", "username": "{$this->botName}", "text": "{$message}", "icon_emoji": "{$this->botAvatarIcon}"}' {$this->incomingWebHookURL}
CMD;
        $output = `$curlCmd`;
        return $output;
    }
}
