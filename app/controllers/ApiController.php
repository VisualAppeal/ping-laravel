<?php

class ApiController extends BaseController
{
	public function checkUptime($id)
	{
		$check = Check::findOrFail($id);

		$data = DB::table('checks_results')
			->select(array(
				DB::raw('UNIX_TIMESTAMP(`created_at`) * 1000 AS `x`'),
				DB::raw('`success` AS `y`'),
			))
			->where('check_id', '=', $check->id)
			->where('created_at', '>', DB::raw('NOW() - INTERVAL 1 MONTH'))
			->orderBy('created_at', 'asc')
			->get();

		$data = array_map(function($result) {
			return array(
				'x' => (int) $result->x,
				'y' => (int) $result->y,
				'color' => ($result->y == 0) ? '#D95C5C' : '#A1CF64',
			);
		}, $data);

		return array(array(
			'name' => trans('check.uptime'),
			'data' => $data,
		));
	}

	public function checkLog($id)
	{
		$check = Check::findOrFail($id);

		return $check->getLog();
	}

	public function checkRum($id)
	{
		$check = Check::findOrFail($id);

		$data = DB::table('checks_results')
			->select(array(
				DB::raw('UNIX_TIMESTAMP(`created_at`) * 1000 AS `x`'),
				DB::raw('`rum` AS `y`'),
			))
			->where('check_id', '=', $check->id)
			->where('created_at', '>', DB::raw('NOW() - INTERVAL 1 WEEK'))
			->orderBy('created_at', 'asc')
			->get();

		$data = array_map(function($result) use($check) {
			return array(
				'x' => (int) $result->x,
				'y' => (int) $result->y,
				'color' => ($result->y / 1000 < $check->rum_tolerating) ? ($result->y / 1000 < $check->rum_satisfied) ? '#A1CF64' : '#F05940' : '#D95C5C'
			);
		}, $data);

		return array(array(
			'name' => trans('check.rum'),
			'data' => $data,
		));
	}
}