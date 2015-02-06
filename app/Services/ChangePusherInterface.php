<?php namespace AlexaWatcher\Services;

use Illuminate\Support\Collection;

interface ChangePusherInterface {

    /**
     * Push changes
     *
     * @param $before
     * @param $after
     * @param $site
     * @param array $pushables
     * @return void
     */
    public function push($before, $after, $site, Collection $pushables);

}