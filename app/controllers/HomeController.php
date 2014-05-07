<?php

class HomeController extends BaseController
{
	public function index()
	{
		return View::make('home.index');
	}

	public function imprint()
	{
		return View::make('site.en.imprint');
	}

	public function privacy()
	{
		return View::make('site.en.privacy');
	}
}