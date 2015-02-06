<?php namespace AlexaWatcher\Repositories\Config;

use AlexaWatcher\Entities\Pushable;
use AlexaWatcher\Repositories\PushableRepository;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Collection;

class ConfigPushableRepository implements PushableRepository{

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var Pushable
     */
    protected $entity;

    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @param Repository $config
     */
    public function __construct(Repository $config, Pushable $entity, Collection $collection)
    {
        $this->config = $config;
        $this->entity = $entity;
        $this->collection = $collection;
    }

    /**
     * Get all people
     *
     * @return static
     */
    public function getAll()
    {
        $config = $this->config->get('alexa.pushables');

        $array = [];

        foreach($config as $person)
        {
            $array[] = $this->entity->createFromArray($person);
        }

        return $this->collection->make($array);
    }
}