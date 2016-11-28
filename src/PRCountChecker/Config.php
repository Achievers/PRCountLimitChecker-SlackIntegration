<?php

namespace PRCountChecker;

/**
 * Extend this config and set the correct values to each property. See the config/ folder for examples.
 *
 * Class Config
 * @package PRCountChecker
 */
class Config
{
    /** @var int PR LIMIT set here. */
    public $resultsLimit = 5;

    public $gitHubUsername;
    public $gitHubPersonalAccessToken;
    public $gitHubSearchQuery; # Test this here: https://github.com/pulls?q=Searchtermhere
    public $gitHubDomainUrl = 'https://github.achievers.com/'; # Eg. http://github.com/

    public $slackChannel;
    public $slackBotName;
    public $slackBotAvatar;
    public $slackBotMessage = "!!! WE ARE CURRENTLY AT THE PR LIMIT !!!";
    public $slackIncomingWebHookUrl = 'https://hooks.slack.com/services/zzz/zzz/zzz';
}
