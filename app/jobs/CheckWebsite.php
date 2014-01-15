<?php

class CheckWebsite
{
	public function fire(Illuminate\Queue\Jobs\Job $job, $data)
	{
		$check = Check::findOrFail($data);
		$headers = array();
		$options = array();

		if (!empty($check->username)) {
			$options['auth'] = array($check->username, $check->password);
		}

		try {
			$latencyStart = microtime(true);
			$response = Requests::get($check->url, $headers, $options);
			$latency = round((microtime(true) - $latencyStart) * 1000);
		} catch (Requests_Exception $e) {
			$latency = round((microtime(true) - $latencyStart) * 1000);
			if (CheckResult::create(array(
				'check_id' => $check->id,
				'status_code' => 0,
				'success' => false,
				'latency' => $latency,
				'content' => trans('check.errors.resolve-host', array('host' => $check->url)),
			))) {
				$job->delete();
			} else {
				$job->release();
			}

			return true;
		}

		$lastCheck = CheckResult::where('check_id', '=', $check->id)
			->orderBy('created_at', 'desc')
			->first();

		if ($response->success) {
			if (isset($lastCheck) and !$lastCheck->success) {
				Mail::queue('email.check.online', array('check' => $check), function($message) use($check) {
					$message->to($check->theUser->email)
						->subject(trans('check.job.email.online.subject', array('title' => $check->title)));
				});
			}

			if (CheckResult::create(array(
				'check_id' => $check->id,
				'status_code' => $response->status_code,
				'success' => true,
				'latency' => $latency,
			))) {
				$job->delete();
			} else {
				$job->release();
			}
		} else {
			if (isset($lastCheck) and $lastCheck->success) {
				Mail::queue('email.check.offline', array('check' => $check, 'response' => $response), function($message) use($check) {
					$message->to($check->theUser->email)
						->subject(trans('check.job.email.offline.subject', array('title' => $check->title)));

				});
			}

			if (CheckResult::create(array(
				'check_id' => $check->id,
				'status_code' => $response->status_code,
				'success' => false,
				'content' => $response->body,
				'headers' => json_encode($response->headers->getValues()),
				'latency' => $latency,
			))) {
				$job->delete();
			} else {
				$job->release();
			}
		}
	}
}