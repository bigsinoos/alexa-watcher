<?php namespace AlexaWatcher\Commands;

use Illuminate\Support\Collection;

class PerformWatch extends Command {

	public $site, $pushables;

	/**
	 * Create a new command instance.
	 *
	 * @param $site
	 * @param Collection $pushables
	 */
	public function __construct($site, Collection $pushables)
	{
		$this->site = $site;
		$this->pushables = $pushables;
	}

}
