<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use LaravelZero\Framework\Commands\Command;
use PhpSchool\CliMenu\CliMenu;
use PhpSchool\CliMenu\Style\SelectableStyle;
use function Termwind\render;
use function Termwind\terminal;

class DemoApiCommand extends AbstractCommand
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
     * @return bool
     */
    public function init(): bool
    {
	    // Clear out the terminal messages
//	    terminal()->clear();

	    $option = $this->menu( 'Retrieve data from APIs')
		    ->addOption('breakingBad', 'Get some quotes from Breaking Bad')
		    ->addOption('chuckNorris', 'Retrieve a random Chuck Norris joke')
		    ->addOption('brokenApi', 'Test broken API')
		    ->addLineBreak('=')
		    ->setBackgroundColour('237')
		    ->setForegroundColour('156')
		    ->setBorder(0, 0, 0, 2, '165')
		    ->setPaddingTopBottom(4)
		    ->setPaddingLeftRight(8)
		    ->addLineBreak('-')
		    ->setMarginAuto()
//		    ->setWidth(70)
//		    ->setBackgroundColour('yellow')
//		    ->setForegroundColour('black')
//		    ->setPadding(4)
//		    ->setMargin(4)
//		    ->setBorder(1, 2, 'red')
//		    ->setTitleSeparator('- ')
//		    ->modifySelectableStyle(function (SelectableStyle $style) {
//			    $style->setUnselectedMarker(' ')
//				    ->setSelectedMarker('>');
//		    })
		    ->open();

		if (!$option) {
			$this->warn('Exited menu with no option selected.');
			return false;
		}

	    $this->info("You have chosen to import data from #$option");

		switch ($option) {
			case 'breakingBad':
				$response = $this->fetch(env('BREAKING_BAD_URL'));
				break;
			case 'chuckNorris':
				$response = $this->fetch(env('CHUCK_NORRIS_URL'));
				break;
			case 'brokenApi':
				$response = $this->fetch(env('BROKEN_API'));
				break;
			default:
				break;
		}

		if ($response->successful()) {
			Storage::append($option . 'ImportedData.txt', $response->body());

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
