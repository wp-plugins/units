<?php namespace UnitSwitcher\Forms;

/**
* Form Handlers
*/
class Handlers {

	public function __construct()
	{
		// Front End Form
		add_action( 'wp_ajax_nopriv_unitswitcher', array($this, 'saveUserPreferences' ));
		add_action( 'wp_ajax_unitswitcher', array($this, 'saveUserPreferences' ));
	}

	/**
	* User Preference Handler
	*/
	public function saveUserPreferences()
	{
		new UserPreferenceHandler;
	}

}