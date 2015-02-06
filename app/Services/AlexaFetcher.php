<?php namespace AlexaWatcher\Services;

use AlexaWatcher\Exceptions\AlexaRankNotFoundException;
use AlexaWatcher\Repositories\AlexaStatusRepository;
use Sunra\PhpSimple\HtmlDomParser;

class AlexaFetcher implements AlexaFetcherInterface{

    /**
     * @var AlexaStatusRepository
     */
    protected $repo;

    /**
     * @param AlexaStatusRepository $repo
     */
    public function __construct(AlexaStatusRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Fetch and parse data from alexa endpoint
     *
     * @param $site
     * @return mixed
     * @throws AlexaRankNotFoundException
     */
    public function fetchFor($site)
    {
        $str = $this->repo->getAlexaDataForSite($site);

        $html = HtmlDomParser::str_get_html($str);

        $data = $html->find('.countryRank .metrics-data', 0);

        if(! is_object($data)){

            throw new AlexaRankNotFoundException("We couldn't find any rank from the html");

        }

        return [
            'country_rank' => $data->plaintext
        ];
    }
}