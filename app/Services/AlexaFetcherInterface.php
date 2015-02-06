<?php namespace AlexaWatcher\Services;

interface AlexaFetcherInterface {
    /**
     * Fetch and parse data from alexa endpoint
     *
     * @param $site
     * @return mixed
     */
    public function fetchFor($site);
}