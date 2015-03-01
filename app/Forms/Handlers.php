<?php namespace UnitSwitcher\Forms;

use UnitSwitcher\Forms\UserPreferenceHandler;
use UnitSwitcher\Forms\NonceHandler;
use UnitSwitcher\Forms\LoadDropdownsHandler;

/**
* Form Handlers
*/
class Handlers {

	public function __construct()
	{
		// Front End Form
		add_action( 'wp_ajax_nopriv_unitswitcher', array($this, 'saveUserPreferences' ));
		add_action( 'wp_ajax_unitswitcher', array($this, 'saveUserPreferences' ));

		// Nonce Generation
		add_action( 'wp_ajax_nopriv_unitswitchernonce', array($this, 'nonceHandler' ));
		add_action( 'wp_ajax_unitswitchernonce', array($this, 'nonceHandler' ));

		// Load Dropdowns
		add_action( 'wp_ajax_nopriv_unitswitcher_dropdowns', array($this, 'loadDropdowns' ));
		add_action( 'wp_ajax_unitswitcher_dropdowns', array($this, 'loadDropdowns' ));
	}

	/**
	* User Preference Handler
	*/
	public function saveUserPreferences()
	{
		new UserPreferenceHandler;
	}

	/**
	* Generate a Nonce
	*/
	public function nonceHandler()
	{
		new NonceHandler;
	}

	/**
	* Lazy Load Handler (Cached Pages)
	*/
	public function loadDropdowns()
	{
		new LoadDropdownsHandler;
	}

}