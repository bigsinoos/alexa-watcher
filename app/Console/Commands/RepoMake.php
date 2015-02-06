<?php namespace AlexaWatcher\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RepoMake extends GeneratorCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:repo';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a repository interface and implementation if needed.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		parent::fire();

		if ($this->option('elq'))
		{
			$this->call(
				'make:elq-repo',
				['name' => 'Eloquent' . $this->argument('name')]
			);
		}
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['elq', null, InputOption::VALUE_NONE, 'Create eloquent implementation.', null],
		];
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return __DIR__ . '/stubs/repo-interface.stub';
	}

	/**
	 * Get default namespace
	 *
	 * @param string $root
	 * @return string
	 */
	protected function getDefaultNamespace($root)
	{
		return $root . '\Repositories';
	}
}
