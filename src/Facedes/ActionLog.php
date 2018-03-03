<?php

namespace SheaXiang\ActionLog\Facades;

use Illuminate\Support\Facades\Facade;

class ActionLog extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'ActionLog';
	}
}