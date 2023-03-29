<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class MenuCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:menu';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Testing creating interactive menus';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $option = $this->menu('Pizza menu', [
		    'Freshly baked muffins',
		    'Freshly baked croissants',
		    'Turnovers, crumb cake, cinnamon buns, scones',
	    ])
//		    ->setForegroundColour('green')
//		    ->setBackgroundColour('black')
//		    ->setWidth(200)
//		    ->setPadding(10)
//		    ->setMargin(5)
//		    ->setExitButtonText("Abort")
//		    // remove exit button with
//		    // ->disableDefaultItems()
//		    ->setTitleSeparator('*-')
//		    ->addLineBreak('<3', 2)
//		    ->addStaticItem('AREA 2')
		    ->addQuestion('Make your own', 'Describe your pizza...')
		    ->open();

	    $this->info("You have chosen the option number #$option");

	    $this->notify("Hello Web Artisan", "Love beautiful code", "icon.png");
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
}
