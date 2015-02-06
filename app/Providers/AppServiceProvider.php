<?php namespace AlexaWatcher\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'AlexaWatcher\Services\Registrar'
		);

		$this->app->bind(
			'AlexaWatcher\Repositories\PushableRepository',
			'AlexaWatcher\Repositories\Config\ConfigPushableRepository'
		);

		$this->app->bind(
			'AlexaWatcher\Repositories\SiteStatusRepository',
			'AlexaWatcher\Repositories\Cache\CacheSiteStatusRepository'
		);

		$this->app->bind(
			'AlexaWatcher\Repositories\AlexaStatusRepository',
			'AlexaWatcher\Repositories\Guzzle\AlexaStatusRepository'
		);

		$this->app->bind(
			'AlexaWatcher\Services\AlexaFetcherInterface',
			'AlexaWatcher\Services\AlexaFetcher'
		);
	}

}
