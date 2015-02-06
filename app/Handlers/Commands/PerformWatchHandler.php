<?php namespace AlexaWatcher\Handlers\Commands;

use AlexaWatcher\Commands\PerformWatch;

use AlexaWatcher\Exceptions\StatusNotFoundException;
use AlexaWatcher\Repositories\SiteStatusRepository;
use AlexaWatcher\Services\AlexaFetcherInterface;
use AlexaWatcher\Services\ChangeEmailPusher;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;

class PerformWatchHandler {

	/**
	 * @var PerformWatch
	 */
	protected $command;

	/**
	 * @var Dispatcher
	 */
	protected $events;

	/**
	 * @var SiteStatusRepository
	 */
	protected $oldRepo;

	/**
	 * @var AlexaFetcherInterface
	 */
	protected $fetcher;

	/**
	 * @var array
	 */
	protected $oldStatus;

	/**
	 * @var array
	 */
	protected $newStatus;

	/**
	 * @var ChangeEmailPusher
	 */
	protected $emailPusher;

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(
		Dispatcher $events,
		SiteStatusRepository $oldRepo,
		AlexaFetcherInterface $alexaFetcher,
		ChangeEmailPusher $emailPusher
	){
		$this->events = $events;
		$this->oldRepo = $oldRepo;
		$this->fetcher = $alexaFetcher;
		$this->emailPusher = $emailPusher;
	}

	/**
	 * Handle the command.
	 *
	 * @param  PerformWatch  $command
	 * @return void
	 */
	public function handle(PerformWatch $command)
	{
		$this->command = $command;

		try {

			$this->oldStatus = $this->oldRepo->getStatusBySite($command->site);

		}catch (StatusNotFoundException $e){

			$this->oldStatus = [
				'country_rank' => null
			];

		}

		$this->newStatus = $this->fetcher->fetchFor($command->site);

		$this->doPush();
	}

	/**
	 * Do the pushing
	 *
	 * @return void
	 */
	protected function doPush()
	{
		if($this->shouldBePushed())
		{
			$this->updateSiteStatus();

			$this->sendEmailNotifications();
		}
	}

	/**
	 * Send email notifications
	 *
	 * @return void
	 */
	protected function sendEmailNotifications()
	{
		$this->emailPusher->push(
			$this->newStatus['country_rank'],
			$this->oldStatus['country_rank'],
			$this->command->site,
			$this->command->pushables
		);
	}

	/**
	 * Should the change be pushed or not
	 *
	 * @return bool
	 */
	protected function shouldBePushed()
	{
		return  true; //$this->oldStatus['country_rank'] != $this->newStatus['country_rank'];
	}

	/**
	 * Update site status
	 *
	 * @return void
	 */
	protected function updateSiteStatus()
	{
		$this->oldRepo->updateOrCreateStatusBySite($this->command->site, $this->newStatus);
	}
}
