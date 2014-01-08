<?php

use Illuminate\Console\Command;

class CheckCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'check:all';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Queue checks.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$checks = Check::where('paused', '=', 0)
			->get();

		foreach ($checks as $check) {
			$hasChecked = CheckResult::where('check_id', '=', $check->id)
				->where('created_at', '>', date('Y-m-d H:i:s', (time() - $check->interval * 60)))
				->count();

			if ($hasChecked == 0) {
				$this->comment(sprintf('Queue check #%d', $check->id));
				Queue::push('CheckWebsite', $check->id);
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
