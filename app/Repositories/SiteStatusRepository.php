<?php namespace AlexaWatcher\Repositories;

interface SiteStatusRepository {

    /**
     * Update site status
     *
     * @param $site
     * @param array $status
     * @return array
     */
    public function updateOrCreateStatusBySite($site, array $status);

    /**
     * Get a site status from cache
     *
     * @param $site
     * @return array
     */
    public function getStatusBySite($site);

}
