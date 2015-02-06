<?php namespace AlexaWatcher\Console\Commands;

use AlexaWatcher\Commands\PerformWatch;
use AlexaWatcher\Repositories\PushableRepository;
use Illuminate\Config\Repository;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Symfony\Component\Console\Input\InputArgument;

class AlexaWatcher extends Command {

	use DispatchesCommands;

	/**
	 * @var Repository
	 */
	protected $config;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'alexa:watch';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Watch changes for a site.';

	/**
	 * @var PushableRepository
	 */
	protected $repo;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Repository $config, PushableRepository $repo)
	{
		$this->config = $config;
		$this->repo = $repo;

		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$pushables = $this->getPushables();

		$site = ($inputSite = $this->argument('site')) ? $inputSite : $this->config->get('alexa.default_site');

		$watchCommand = new PerformWatch($site, $pushables);

		$this->dispatch($watchCommand);

		$this->info('Pushing Done!');
	}

	/**
	 * Get pushable collection
	 *
	 * @return \Illuminate\Support\Collection
	 */
	protected function getPushables()
	{
		return $this->repo->getAll();
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['site', InputArgument::OPTIONAL, 'Site to watch for.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
		];
	}

}
