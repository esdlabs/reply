<?php namespace Esdlabs\Reply\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Auth\AuthManager
 * @see \Illuminate\Auth\Guard
 */
class Reply extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'Reply'; }

}
