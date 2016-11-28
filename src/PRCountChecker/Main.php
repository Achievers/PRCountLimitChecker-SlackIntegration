<?php

namespace PRCountChecker;

class Main
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var Slack
     */
    private $slackService;
    /**
     * @var GitHub
     */
    private $gitHubService;

    public function __construct(Config $config)
    {
        $this->validateConfiguration($config);
        $this->config = $config;
        $this->slackService = new Slack(
            $this->config->slackIncomingWebHookUrl,
            $this->config->slackChannel,
            $this->config->slackBotName,
            $this->config->slackBotAvatar
        );
        $this->gitHubService = new GitHub(
            $this->config->gitHubDomainUrl,
            $this->config->gitHubUsername,
            $this->config->gitHubPersonalAccessToken,
            $this->config->gitHubSearchQuery
        );
    }

    /**
     * None of the values should be empty, validate that.
     *
     * @param Config $config
     */
    private function validateConfiguration(Config $config)
    {
        $properties = get_object_vars($config);
        foreach ($properties as $name => $value) {
            if (empty($value)) {
                throw new \InvalidArgumentException(
                    "Config property cannot be empty: {$name}"
                );
            }
        }
    }

    public function checkAndNotifyOnLimitBreached()
    {
        $count = $this->gitHubService->getNumberOfSearchResults();
        $output = '';
        if ($count >= $this->config->resultsLimit) {
            $output = $this->slackService->postMessageToSlackChannel(<<<SLACKMSG
{$this->config->slackBotMessage}
Number of open PRs is: *{$count}*
SLACKMSG
            );
        }
        return $output;
    }
}
