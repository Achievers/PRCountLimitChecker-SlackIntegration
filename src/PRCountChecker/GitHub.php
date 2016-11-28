<?php

namespace PRCountChecker;

class GitHub
{
    private $domainUrl;
    private $username;
    private $personalAccessToken;
    private $searchQuery;

    public function __construct($domainUrl, $username, $personalAccessToken, $searchQuery)
    {
        $this->domainUrl = $domainUrl;
        $this->username = $username;
        $this->personalAccessToken = $personalAccessToken;
        $this->searchQuery = $searchQuery;
    }

    public function getNumberOfSearchResults()
    {
        $response = $this->runSearchQuery();
        $numberOfResults = $this->countSearchQueryResults($response);

        return $numberOfResults;
    }

    /**
     * @return string JSON String
     */
    private function runSearchQuery()
    {
        $githubSearchQuery = urlencode($this->searchQuery);
        $curlCmd = <<<CMD
curl -s -k -u {$this->username}:{$this->personalAccessToken} {$this->domainUrl}api/v3/search/issues?q={$githubSearchQuery}
CMD;
        $output = `$curlCmd`;
        return $output;
    }

    /**
     * @param string $responseJsonString
     * @return int Count of the results in the response.
     */
    private function countSearchQueryResults($responseJsonString)
    {
        $responseObj = json_decode($responseJsonString, true);
        $count = 0;
        if (!empty($responseObj['items'])) {
            $count = count($responseObj['items']);
        }
        return $count;
    }
}
