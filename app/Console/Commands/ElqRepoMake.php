<?php namespace AlexaWatcher\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Stringy\Stringy;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ElqRepoMake extends GeneratorCommand{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:elq-repo';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create an eloquent implementation.';

	/**
	 * Replace the class name for the given stub.
	 *
	 * @param  string  $stub
	 * @param  string  $name
	 * @return string
	 */
	protected function replaceClass($stub, $name)
	{
		$interface = $this->getInterfaceName();

		$class = str_replace($this->getNamespace($name).'\\', '', $name);

		return str_replace(['{{class}}', '{{interface}}'], [$class, $interface], $stub);
	}

	/**
	 * Get interface name
	 *
	 * @return string
	 */
	protected function getInterfaceName()
	{
		return preg_replace('/^' . preg_quote('Eloquent', '/') . '/', '', $this->argument('name'));
	}

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return __DIR__ . '/stubs/repo-eloquent.stub';
	}

	/**
	 * Get default namespace
	 *
	 * @param string $root
	 * @return string
	 */
	public function getDefaultNamespace($root)
	{
		return $root . '\Repositories\Eloquent';
	}
}
