<?php namespace AlexaWatcher\Repositories\Cache;

use AlexaWatcher\Exceptions\StatusNotFoundException;
use AlexaWatcher\Repositories\SiteStatusRepository;
use Illuminate\Contracts\Cache\Repository;

class CacheSiteStatusRepository implements SiteStatusRepository {

    /**
     * @var Repository
     */
    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Update site status
     *
     * @param $site
     * @param array $status
     * @return void
     */
    public function updateOrCreateStatusBySite($site, array $status)
    {
        $this->cache->forever($site, $status);
    }

    /**
     * Get a site status from cache
     *
     * @param $site
     * @return array
     * @throws StatusNotFoundException
     */
    public function getStatusBySite($site)
    {
        if($this->cache->has($site))
        {
            return $this->cache->get($site);
        }

        throw new StatusNotFoundException("No status found for site [{$site}].");
    }
}