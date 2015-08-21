<?php namespace UnitSwitcher;
/**
* Plugin Bootstrap
*/
class Bootstrap {

	public function __construct()
	{
		$this->startSession();
		$this->init();
		$this->setFormActions();
		add_filter( 'plugin_action_links_' . 'units/units.php', array($this, 'settingsLink' ) );
		add_action( 'plugins_loaded', array($this, 'addLocalization') );
	}

	/**
	* Initialize
	*/
	public function init()
	{
		new Config\Settings;
		new Activation\Activate;
		new Activation\Dependencies;
		new API\SwitcherShortcode;
	}

	/**
	* Set Form Actions & Handlers
	*/
	public function setFormActions()
	{
		new Forms\Handlers;
	}


	/**
	* Add a link to the settings on the plugin page
	*/
	public function settingsLink($links)
	{ 
		$settings_link = '<a href="options-general.php?page=unit-switcher">' . __('Settings','unitswitcher') . '</a>'; 
		$help_link = '<a href="http://unitswitcher.com">' . __('FAQ','unitswitcher') . '</a>'; 
		array_unshift($links, $help_link); 
		array_unshift($links, $settings_link);
		return $links; 
	}


	/**
	* Localization Domain
	*/
	public function addLocalization()
	{
		load_plugin_textdomain(
			'unitswitcher', 
			false, 
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
	}

	/**
	* Initialize a Session
	*/
	public function startSession()
	{
		if ( !session_id() ) session_start();
	}



}