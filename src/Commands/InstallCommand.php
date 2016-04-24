<?php namespace Suroviy\LaraBox\Commands;

use Storage;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;
use SleepingOwl\Admin\Model\Permission as PermissionModel;


class InstallCommand extends Command
{

	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'larabox:install';
	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Install the LaraBox';

	protected $stubs = [
		'menu',
		'bootstrap',
		'routes',
		'User',
		'Role',
		'Permission'
	];

	/**
	 * Execute the console command.
	 * @return void
	 */
	public function fire()
	{

		$this->reaplaceFile('app'.DIRECTORY_SEPARATOR.'User.php');
		$this->reaplaceFile('app'.DIRECTORY_SEPARATOR.'Exceptions'.DIRECTORY_SEPARATOR.'Handler.php');
		$this->reaplaceFile('app'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Kernel.php');
		$this->reaplaceFile('app'.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'routes.php');

		$this->reaplaceFile('app'.DIRECTORY_SEPARATOR.'Admin'.DIRECTORY_SEPARATOR.'menu.php');
		$this->reaplaceFile('app'.DIRECTORY_SEPARATOR.'Admin'.DIRECTORY_SEPARATOR.'User.php');

		$this->reaplaceFile('package.json');
		$this->reaplaceFile('gulpfile.js');
		
	}

	public function reaplaceFile($path){

		$copyPath = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'publish'.DIRECTORY_SEPARATOR.$path;

		if ( is_file( base_path($path) ) ){

			unlink(base_path($path));
			$this->info('remove '. base_path($path));

		}else{

			$this->info('not file '. base_path($path));
		}


		if ( is_file( $copyPath ) ){
			if ( copy($copyPath,base_path($path)) ){
				$this->info('copy '. $copyPath.' to '.base_path($path));
			}else{
				$this->error('error copy '. $copyPath .' to '.base_path($path));
			}
		}else{
			$this->error('not file '. $copyPath.' to '.base_path($path));
		}

		$this->info('-------------------------------------------------------------------------');
	}
}