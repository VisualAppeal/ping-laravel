<?php

class CheckWebsite
{
	public function fire($job, $data)
	{
		$check = Check::findOrFail($data);
		$headers = array();
		$options = array();

		if (!empty($check->username)) {
			$options['auth'] = array($check->username, $check->password);
		}


		try {
			$rumStart = microtime(true);
			$response = Requests::get($check->url, $headers, $options);
			$rum = round((microtime(true) - $rumStart) * 1000);
		} catch (Requests_Exception $e) {
			$rum = round((microtime(true) - $rumStart) * 1000);
			if (CheckResult::create(array(
				'check_id' => $check->id,
				'status_code' => 0,
				'success' => false,
				'rum' => $rum,
				'content' => trans('check.errors.resolve-host', array('host' => $check->url)),
			))) {
				$job->delete();
			} else {
				$job->release();
			}

			return true;
		}


		if ($response->success) {
			if (CheckResult::create(array(
				'check_id' => $check->id,
				'status_code' => $response->status_code,
				'success' => $response->success,
				'rum' => $rum,
			))) {
				$job->delete();
			} else {
				$job->release();
			}
		} else {
			if (CheckResult::create(array(
				'check_id' => $check->id,
				'status_code' => $response->status_code,
				'success' => $response->success,
				'content' => $response->body,
				'headers' => json_encode($response->headers->getValues()),
				'rum' => $rum,
			))) {
				$job->delete();
			} else {
				$job->release();
			}
		}
	}
}