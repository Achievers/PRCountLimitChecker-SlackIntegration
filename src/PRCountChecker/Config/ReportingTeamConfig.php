<?php

namespace PRCountChecker\Config;

use PRCountChecker\Config;

class ReportingTeamConfig extends Config
{
    public function __construct()
    {
        # PR Counter Settings
        $this->resultsLimit = 1;

        # GitHub Settings
        $this->gitHubUsername = 'xxxx-xxxx';
        $this->gitHubPersonalAccessToken = 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz';
        $this->gitHubSearchQuery = 'team:DEV/reportingTeam is:open is:pr repo:DEV/CODE';

        # Slack Settings
        $this->slackBotName = 'PR-LIMIT-OCTOPUS';
        $this->slackBotAvatar = ':octopus:';
        $this->slackChannel = '#dev_team_reporting_channel';
    }
}
