<?php namespace UnitSwitcher\Entities\User;

use UnitSwitcher\Config\SettingsRepository;

/**
* User Preference Service Class
*/
class UserPreference {

	/**
	* Parent Unit
	*/
	private $parent_unit;

	/**
	* Selected Unit
	*/
	private $selected_unit;

	/**
	* Settings Repository
	*/
	private $settings_repo;


	public function __construct()
	{
		$this->settings_repo = new SettingsRepository;
	}


	/**
	* Save a unit preference
	*/
	public function save($parent_unit, $selected_unit)
	{
		$this->parent_unit = $parent_unit;
		$this->selected_unit = $selected_unit;
		$saveType = $this->settings_repo->saveType();
		if ( $saveType ) $this->routeSaveType($saveType);
	}

	/**
	* Retrieve a user preference
	*/
	public function get($unit)
	{
		$saveType = $this->settings_repo->saveType();
		if ( !$saveType ) return false;
		if ( $saveType == 'session' ) return $this->getSessionPreference($unit);
		if ( $saveType == 'cookie' ) return $this->getCookiePreference($unit);
	}


	/**
	* Get User Preference from session
	*/
	private function getSessionPreference($unit)
	{
		if ( !isset($_SESSION['unitswitcher_units'][$unit]) ) return false;
		return $_SESSION['unitswitcher_units'][$unit];
	}


	/**
	* Get User Preference from cookie
	*/
	private function getCookiePreference($unit)
	{
		if ( !isset($_COOKIE['unitswitcher_units'][$unit]) ) return false;
		return $_COOKIE['unitswitcher_units'][$unit];
	}


	/**
	* Determine method of saving and save
	*/
	private function routeSaveType($type)
	{
		if ( $type == 'session' ) return $this->saveToSession();
		if ( $type == 'cookie' ) return $this->saveToCookie();
	}


	/**
	* Save to the Session
	*/
	private function saveToSession()
	{
		$_SESSION['unitswitcher_units'][$this->parent_unit] = $this->selected_unit;
		return;
	}

	/**
	* Save to Cookies
	*/
	private function saveToCookie()
	{
		setcookie('unitswitcher_units[' . $this->parent_unit . ']', $this->selected_unit, time()+3600, '/' );
		return;
	}


}