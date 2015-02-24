<?php namespace UnitSwitcher\Entities\Unit;

use UnitSwitcher\Config\SettingsRepository;

/**
* Calculates an alternate given a number
*/
class Calculator {

	/**
	* The Unit
	*/
	private $unit;

	/**
	* The default number
	*/
	private $number;

	/**
	* Settings Repository
	*/
	private $settings_repo;

	public function __construct()
	{
		$this->settings_repo = new SettingsRepository;
	}
	
	/**
	* Public API method
	* @return float
	*/
	public function calculate($unit, $number)
	{
		$this->unit = $unit;
		$this->number = $number;
		$formula = $this->settings_repo->getFormula($unit);
		$result = $this->extractFormula($formula);
		return $result;
	}

	/**
	* Extract the formula and replace X with number
	* @return float
	*/
	private function extractFormula($formula)
	{
		$calc = str_replace('X', $this->number, $formula);
		
		// Remove whitespaces
		$calc = preg_replace('/\s+/', '', $calc);
		
		// What is a number
		$number = '(?:\d+(?:[,.]\d+)?|pi|π)';

		// Allowed PHP functions
		$functions = '(?:sinh?|cosh?|tanh?|abs|acosh?|asinh?|atanh?|exp|log10|deg2rad|rad2deg|sqrt|ceil|floor|round)'; 
		
		// Allowed math operators
		$operators = '[+\/*\^%-]'; 

		// Final regexp, heavily using recursive patterns
		$regexp = '/^(('.$number.'|'.$functions.'\s*\((?1)+\)|\((?1)+\))(?:'.$operators.'(?2))?)+$/';

		if ( preg_match($regexp, $calc) ){
    		$calc = preg_replace('!pi|π!', 'pi()', $calc); // Replace pi with pi function
    		eval('$result = '.$calc.';');
    		return $result;
		}
		
		return false;
	}

}