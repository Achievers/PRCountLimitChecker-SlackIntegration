# PRCountLimitChecker-SlackIntegration

Checks the PR count based on a specified search config.
If the limit is breached, it will post a specified message onto your specified slack channel using web hooks!

### Adding a new config
Under the `src/PRCountChecker/Config/` directory you will find a class that extends `PRCountChecker/Config.php`. Simply add a new config class and set the config variables in the constructor. Once the new class is created, go to `index.php` and add the class to the `getConfigs` container. 

### Dependencies
* Should be run on a Unix environment.
* `curl` cmd-line utility installed.
* Composer
* PHP 5+

### Installation
1. First thing is first, we need to use composer to get it's dependencies.
```
# curl -sS https://getcomposer.org/installer | php
# php composer.phar install
```
2. Run this program as a cron on a server, and add a new config for each team that would like to use this checker. Only 1 instance of this program is required for multiple teams.

### How to run the program
`php index.php GET /run`

### Example post on Slack

![image](https://cloud.githubusercontent.com/assets/3977724/20727538/e10047a0-b647-11e6-98cf-cf92b9d7c96c.png)
