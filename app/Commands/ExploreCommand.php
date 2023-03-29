<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class ExploreCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'user:create 
                            {name : The name of the user (required)} 
                            {--age= : The age of the user (optional)}
                            {user? : The ID of the user (optional)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Exploring laravel zero commands';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
	    $userId = $this->argument( 'user' );
	    $name = $this->argument( 'name' );

	    if ( ! $userId ) {
		    $this->warn( 'No user id was provided. Assigning one automatically' );
	    }

	    $options = $this->options();
	    $this->table( [ 'Name', 'Age' ], [ [$name, $options['age']]]);

		$this->newLine(1);

	   $userRole = $this->choice( 'What is the user role you wish to assign this user',
		    [ 'Admin', 'Dealer' ],
	    2 //Default index
	    );

		$email = $this->ask('What is your email?');

		$this->line('Email entered: ', $email);

		if (!$this->confirm('Does this email look correct?')){
			$email = $this->anticipate('Please enter your email again', [$email]);
		}

		$this->info('User data entered successfully');
	    $this->newLine(2);

		$this->table([ 'Name', 'Age', 'User role', 'Email' ], [[$name, $options['age'], $userRole, $email]]);
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
