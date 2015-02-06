<?php namespace AlexaWatcher\Repositories;

interface PushableRepository {
    /**
     * Get All pushable users
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll();
}
