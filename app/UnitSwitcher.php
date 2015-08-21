<?php 
/**
* Static Wrapper for Bootstrap Class
* Prevents T_STRING error when checking for 5.3.2
*/
class UnitSwitcher {

	public static function init()
	{
		// dev/live
		global $unit_switcher_env;
		$unit_switcher_env = 'live';

		global $unit_switcher_version;
		$unit_switcher_version = '1.0.2';

		$app = new UnitSwitcher\Bootstrap;
	}
}