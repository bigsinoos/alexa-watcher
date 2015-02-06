<?php namespace AlexaWatcher\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'AlexaWatcher\Console\Commands\Inspire',
		'AlexaWatcher\Console\Commands\AlexaWatcher',
		'AlexaWatcher\Console\Commands\RepoMake',
		'AlexaWatcher\Console\Commands\EloquentMake',
		'AlexaWatcher\Console\Commands\ElqRepoMake'
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('alexa:watch')->hourly();
	}

}
