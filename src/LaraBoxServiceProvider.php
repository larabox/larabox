<?php namespace Suroviy\LaraBox;

use Storage;
use View;
use FormItem;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class LaraBoxServiceProvider extends ServiceProvider {

	/**
	 * Define Service Providers from our dependencies
	 */
	protected $parent_providers = [
		\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class,
		\Intervention\Image\ImageServiceProvider::class,
		\Laravel\Socialite\SocialiteServiceProvider::class,
		\Roumen\Sitemap\SitemapServiceProvider::class,
		\Roumen\Feed\FeedServiceProvider::class,
		\Maatwebsite\Excel\ExcelServiceProvider::class,

		\Suroviy\SoaAddon\SoaAddonServiceProvider::class,
        \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        \Barryvdh\Debugbar\ServiceProvider::class,

		
	];

	/**
	 * Define aliases to register
	 */
	protected $aliases = [
		'Image' => \Intervention\Image\Facades\Image::class,
		'SEO' => \Artesaos\SEOTools\Facades\SEOTools::class,
		'Socialite' => \Laravel\Socialite\Facades\Socialite::class,
		'Cart' => \Suroviy\LaraBox\Facades\Cart::class,
		'LaraBox' => \Suroviy\LaraBox\Facades\LaraBox::class,
		'Feed' 		=> \Roumen\Feed\Facades\Feed::class,
		'Excel' => \Maatwebsite\Excel\Facades\Excel::class,
	];

	protected $commands = [
		'InstallCommand'
	];

	protected function publishConfig($dir,$name){
		$config_file = $dir . '/../config/'.$name.'.php';

		$this->mergeConfigFrom($config_file, $name);

		$this->publishes([
			$config_file => config_path($name.'.php')
		], 'config');

	}

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->loadViewsFrom(__DIR__.'/../views', 'suroviy.lara_box');

		$this->publishConfig(__DIR__,'suroviy.lara_box');

		$this->publishes([
			__DIR__.'/../publish' => base_path()
		]);

		//$this->commands('\Suroviy\LaraBox\Commands\InstallCommand.php');

		include __DIR__.'/../helpers.php';
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerParentProviders();
		$this->registerAliases();
		$this->registerCommands();
	}

	/**
	 * Register Dependency Providers
	 */
	protected function registerParentProviders()
	{
		foreach ($this->parent_providers as $parentProviderClass)
		{
			$this->app->register($parentProviderClass);
		}
	}

	/**
	 * Register the aliases from this module.
	 */
	protected function registerAliases()
	{
		$loader = AliasLoader::getInstance();
		foreach ($this->aliases as $aliasName => $aliasClass) {
			$loader->alias($aliasName, $aliasClass);
		}
	}

	/**
	 * Register commands
	 */
	protected function registerCommands()
	{
		foreach ($this->commands as $command)
		{
			$this->commands('Suroviy\LaraBox\Commands\\' . $command);
		}
	}

}