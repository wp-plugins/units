<?php namespace UnitSwitcher\Entities\Unit;

/**
* Validates Unit Settings
*/
class UnitValidator {

	/**
	* New Input
	*/
	private $input;

	/**
	* Error Message
	*/
	private $error;


	public function __construct($input)
	{
		$this->input = $input;
	}

	/**
	* Public validate method
	*/
	public function validates($input)
	{
		if ( !$this->validateUnits() ) return false;
		return true;
	}

	/**
	* Validate primary units
	*/
	private function validateUnits()
	{
		foreach ( $this->input as $unit ){
			if ( !isset($unit['default']) || $unit['default'] == "" ) {
				$this->error = __('A primary unit name is required.', 'unitswitcher');
				return false;
			}
			if ( !isset($unit['default_singular']) || $unit['default_singular'] == "" ) {
				$this->error = __('A primary unit singular name is required.', 'unitswitcher');
				return false;
			}
			if ( !isset($unit['alternates']) || $unit['alternates'] == "" ) {
				$this->error = __('At least one alternate unit is required.', 'unitswitcher');
				return false;
			}
			foreach ( $unit['alternates'] as $alternate ){
				if ( !$this->validateAlternates($alternate) ) return false;
			}
		}
		return true;
	}

	/**
	* Validate alternates
	*/
	private function validateAlternates($alternate)
	{
		if ( !isset($alternate['formula']) || $alternate['formula'] == "" ) {
			$this->error = __('Formulas are required for all alternates', 'unitswitcher');
			return false;
		}
		if ( !isset($alternate['name']) || $alternate['name'] == "" ) {
			$this->error = __('All alternates require a name', 'unitswitcher');
			return false;
		}
		if ( !isset($alternate['name_singular']) || $alternate['name_singular'] == "" ) {
			$this->error = __('All alternates require a singular name', 'unitswitcher');
			return false;
		}
		return true;
	}

	/**
	* Get the error message
	*/
	public function error()
	{
		return $this->error;
	}

}