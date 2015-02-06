<?php namespace AlexaWatcher\Repositories;

interface AlexaStatusRepository {

    /**
     * Get alexa data for site
     *
     * @param $site
     * @return string
     */
    public function getAlexaDataForSite($site);

}
