<?php namespace UnitSwitcher\Config;

use UnitSwitcher\Helpers;
use UnitSwitcher\Config\SettingsRepository;
use UnitSwitcher\Entities\Unit\UnitValidator;

/**
* Plugin Settings
*/
class Settings {

	/**
	* Settings Repository
	*/
	private $settings_repo;


	public function __construct()
	{
		$this->settings_repo = new SettingsRepository;
		add_action( 'admin_init', array( $this, 'registerSettings' ) );
		add_action( 'admin_menu', array( $this, 'registerSettingsPage' ) );
	}


	/**
	* Register the settings page
	*/
	public function registerSettingsPage()
	{
		add_options_page( 
			__('Units Settings', 'unitswitcher'),
			__('Units', 'unitswitcher'),
			'manage_options',
			'unit-switcher', 
			array( $this, 'settingsPage' ) 
		);
	}


	/**
	* Display the Settings Page
	* Callback for registerSettingsPage method
	*/
	public function settingsPage()
	{
		$tab = ( isset($_GET['tab']) ) ? $_GET['tab'] : 'general';
		include( Helpers::view('settings/settings') );
	}


	/**
	* Register the settings
	*/
	public function registerSettings()
	{
		register_setting( 'unit-switcher-general', 'unitswitcher_dependencies' );
		register_setting( 'unit-switcher-general', 'unitswitcher_save' );
		register_setting( 'unit-switcher-general', 'unitswitcher_cache' );
		register_setting( 'unit-switcher-units', 'unitswitcher_units', array($this, 'validateUnits') );
	}

	/**
	* Validate Units
	*/
	public function validateUnits($input)
	{
		$validator = new UnitValidator($input);
		if ( $validator->validates($input) ) return $input;
		add_settings_error( 'unit-switcher-units', 'unit-switcher', $validator->error(), 'error' );
		return false;
	}

}