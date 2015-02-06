<?php namespace AlexaWatcher\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class EloquentMake extends GeneratorCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:eloquent';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Make an eloquent model inside entities folder.';

	/**
	 * Get default namespace for the make command
	 *
	 * @param string $rootNamespace
	 * @return string|void
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Entities';
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return ( __DIR__ . '/stubs/model.stub');
	}
}
