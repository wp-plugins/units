<?php namespace UnitSwitcher\Activation;

use UnitSwitcher\Helpers;
use UnitSwitcher\Config\SettingsRepository;

/**
* Plugin Dependencies
*/
class Dependencies {

	/**
	* Plugin Directory
	*/
	private $plugin_dir;

	/**
	* Plugin Version
	*/
	private $plugin_version;

	/**
	* Settings Repository
	*/
	private $settings_repo;


	public function __construct()
	{
		$this->settings_repo = new SettingsRepository;
		$this->setPluginVersion();
		$this->plugin_dir = Helpers::plugin_url();
		add_action( 'admin_enqueue_scripts', array($this, 'adminStyles') );
		add_action( 'admin_enqueue_scripts', array($this, 'adminScripts') );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontendStyles' ));
		add_action( 'wp_enqueue_scripts', array( $this, 'frontendScripts' ));
	}

	/**
	* Set the Plugin Version
	*/
	private function setPluginVersion()
	{
		global $unit_switcher_version;
		$this->plugin_version = $unit_switcher_version;
	}

	/**
	* Admin Styles
	*/
	public function adminStyles()
	{
		wp_enqueue_style(
			'unit-switcher-admin', 
			$this->plugin_dir . '/assets/css/unit-switcher-admin.css', 
			array(), 
			$this->plugin_version
		);
	}

	/**
	* Admin Scripts
	*/
	public function adminScripts()
	{
		wp_enqueue_script(
			'unit-switcher-admin', 
			$this->plugin_dir . '/assets/js/unit-switcher-admin.min.js', 
			array('jquery'), 
			$this->plugin_version
		);
		wp_localize_script( 
			'unit-switcher-admin', 
			'unit_switcher', 
			array( 
				'name' => __('Name', 'unitswitcher'),
				'singular_name' => __('Singular Name', 'unitswitcher'),
				'formula' => __('Formula', 'unitswitcher')
			)
		);
	}

	/**
	* Front End Styles
	*/
	public function frontendStyles()
	{
		if ( !$this->settings_repo->outputDependency('css') ) return;
		wp_enqueue_style(
			'unit-switcher', 
			$this->plugin_dir . '/assets/css/unit-switcher.css', 
			array(), 
			$this->plugin_version
		);
	}

	/**
	* Front End Scripts
	*/
	public function frontendScripts()
	{
		if ( !$this->settings_repo->outputDependency('js') ) return;
		wp_enqueue_script(
			'unit-switcher', 
			$this->plugin_dir . '/assets/js/unit-switcher.min.js', 
			array('jquery'), 
			$this->plugin_version
		);
		wp_localize_script(
			'unit-switcher',
			'unit_switcher',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'unit_switcher-nonce' ),
				'cache' => $this->settings_repo->cacheEnabled()
			)
		);
	}

}