<?php namespace UnitSwitcher\Entities\Unit;

use UnitSwitcher\Config\SettingsRepository;
use UnitSwitcher\Entities\Unit\Calculator;
use UnitSwitcher\Entities\User\UserPreference;

/**
* Builds a dropdown of available alternates for a given unit
*/
class Dropdown {

	/**
	* The Unit
	*/
	private $unit;

	/**
	* The default number
	*/
	private $number;

	/**
	* Round to
	*/
	private $round;

	/**
	* Alternates for a given unit
	* @var array
	*/
	private $alternates;

	/**
	* Calculator
	*/
	private $calculator;

	/**
	* Settings Repository
	*/
	private $settings_repo;

	/**
	* User Preference
	*/
	private $user_preference;


	public function __construct($unit, $number, $round)
	{
		$this->settings_repo = new SettingsRepository;
		$this->calculator = new Calculator;
		$this->user_preference = new UserPreference;
		$this->number = $number;
		$this->unit = $unit;
		$this->round = $round;
		$this->alternates = $this->settings_repo->getAlternates($this->unit);
	}

	/**
	* Get calculated alternate
	*/
	private function alternateNumber($alternate)
	{
		if ( $alternate == $this->unit ) return $this->number;
		return round($this->calculator->calculate($alternate, $this->number), intval($this->round));
	}

	/**
	* Display the Menu
	* @return html
	* @todo make first item the users saved preference
	*/
	public function display()
	{
		if ( !$this->alternates ) return;
		
		$out = $this->selectedUnit($this->alternates);
		$out .= '<ul class="dropdown-menu">';
		foreach ( $this->alternates as $key => $alternate ){
			if ( $key == 0 ) {
				$out .= $this->defaultUnit(); 
				continue;
			}
			$out .= '<li><a href="#" data-alternate="' . $alternate . '" data-parentunit="' . $this->unit . '" data-unitswitcher data-unitvalue="' . $this->alternateNumber($alternate) . '">' . $alternate . '</a></li>';
		}
		$out .= '</ul></div>';
		return $out;
	}

	/**
	* Selected Unit
	*/
	private function selectedUnit($alternates)
	{
		$preference = $this->user_preference->get($this->unit);

		$out = '<div class="unit-switcher-switch dropdown">';

		if ( !$preference ) {
			$out .= '<a href="#" data-unit-dropdown data-unit="' . $this->unit . '" class="unit-switcher-toggle" data-value="' . $this->number . '" data-round="' . $this->round . '"><span class="unit-switcher-value">' . $this->number . ' ' . $this->unit . '</span><span class="unit-switcher-caret"></span></a>';
			return $out;
		}
		
		foreach ( $alternates as $alternate ){
			if ( $alternate !== $preference ) continue;
			$out .= '<a href="#" data-unit-dropdown data-unit="' . $this->unit . '" class="unit-switcher-toggle" data-value="' . $this->number . '" data-round="' . $this->round . '"><span class="unit-switcher-value">' . $this->alternateNumber($alternate) . ' ' . $alternate . '</span><span class="unit-switcher-caret"></span></a>';
		}
		return $out;
	}

	/**
	* Displayed Unit
	* @param string $alternate
	*/
	private function defaultUnit()
	{
		$out = '<li><a href="#" data-alternate="' . $this->unit . '" data-parentunit="' . $this->unit . '" data-unitswitcher data-unitvalue="' . $this->number . '">' . $this->unit . '</a></li>';
		return $out;
	}


	/**
	* Does this unit have alternates
	*/
	public function hasAlternates()
	{
		return ( empty($this->alternates) ) ? false : true;
	}

}