<?php namespace UnitSwitcher\API;

class SwitcherShortcode {

	/**
	* Shortcode Options
	* @var array
	*/
	private $options;

	public function __construct()
	{
		add_shortcode('unit_switcher', array($this, 'renderView'));
	}

	/**
	* Shortcode Options
	*/
	private function setOptions($options)
	{
		$this->options = shortcode_atts(array(
			'unit' => null,
			'value' => null,
			'round' => 2
		), $options);
	}

	/**
	* Call the function
	*/
	public function renderView($options)
	{
		$this->setOptions($options);
		if ( isset($this->options['unit']) && isset($this->options['value']) )
			return get_unit_switcher($this->options['value'], $this->options['unit'], $this->options['round']);
	}

}