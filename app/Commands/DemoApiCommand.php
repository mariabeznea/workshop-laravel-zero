<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use LaravelZero\Framework\Commands\Command;
use PhpSchool\CliMenu\CliMenu;

class DemoApiCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'import:api-data';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command to import data from different APIs';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $option = $this->menu( 'Retrieve data from APIs')
		    ->addOption('breaking_bad', 'Get some quotes from Breaking Bad')
		    ->addOption('chuck_norris', 'Retrieve a random Chuck Norris joke')
		    ->addLineBreak('=')
		    ->open();

		if (!$option) {
			$this->warn('Exited menu with no option selected.');
			return false;
		}

	    $this->info("You have chosen to import data from #$option");

	    $this->notify("API notification", "Data import started", "icon.png");

		switch ($option) {
			case 'breaking_bad':
				$response = $this->fetch(env('BREAKING_BAD_URL'));
				break;
			case 'chuck_norris':
				$response = $this->fetch(env('CHUCK_NORRIS_URL'));
				break;
			default:
				break;
		}

		if ($response->successful()) {
			Storage::append('importedData.txt', $response->body());

			$this->notify("API notification", "Finished importing data into the txt file", "icon.png");
		}

	    $this->info("Exiting command.");
		return true;
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

	private function fetch( string $url ) {
		$response = Http::get( $url );

		if ( $response->failed() ) {
			$this->error('Could not retrieve data from API. Client or Server error occurred.');
		}

		return $response;
	}
}
