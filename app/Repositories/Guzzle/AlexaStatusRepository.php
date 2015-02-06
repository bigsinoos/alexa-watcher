<?php namespace AlexaWatcher\Repositories\Guzzle;

use AlexaWatcher\Repositories\AlexaStatusRepository as AlexaStatusRepositoryContract;
use GuzzleHttp\Client;

class AlexaStatusRepository implements AlexaStatusRepositoryContract {

    /**
     * @var int
     */
    const TIMEOUT = 30;

    /**
     * @var integer
     */
    const CONNECTION_TIMEOUT = 30;

    /**
     * @var string
     */
    const BASE_URL = 'http://www.alexa.com/';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get alexa data for site
     *
     * @param $site
     * @return string
     */
    public function getAlexaDataForSite($site)
    {
        return (string) $this->client->get(static::BASE_URL . 'siteinfo/' . $site, [
            'timeout' => static::TIMEOUT
        ])->getBody();
    }
}