<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use function Termwind\render;

abstract class AbstractCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

	abstract protected function init(): bool;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        render(view('title'));

		$this->init();
    }

	/**
	 * @param $infoMessage
	 * @param $verbosity
	 *
	 * @return void
	 */
	public function info( $infoMessage, $verbosity = null) {
		parent::info(render(view('info', ['message' => $infoMessage])));
	}

	/**
	 * @param $warningMessage
	 * @param $verbosity
	 *
	 * @return void
	 */
	public function warn( $warningMessage, $verbosity = null) {
		parent::info(render(view('warning', ['message' => $warningMessage])));
	}

	/**
	 * @param $errorMessage
	 * @param $verbosity
	 *
	 * @return void
	 */
	public function error( $errorMessage, $verbosity = null) {
		parent::info(render(view('error', ['message' => $errorMessage])));
	}
}
