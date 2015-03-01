<?php namespace UnitSwitcher\Config;

class SettingsRepository {

	/**
	* Output Dependency
	* @return array
	* @since 0.1
	*/
	public function outputDependency($dependency = 'css')
	{
		$option = get_option('unitswitcher_dependencies');
		return ( isset($option[$dependency]) && $option[$dependency] == 'true' ) ? true : false;
	}

	/**
	* Get All Units
	* @return array
	* @since 0.1
	*/
	public function allUnits()
	{
		return get_option('unitswitcher_units');
	}

	/**
	* Get all alternate units for a provided unit
	* @return array
	* @since 0.1
	* @param string $unit
	*/
	public function getAlternates($unit)
	{
		$units = get_option('unitswitcher_units');
		foreach($units as $single_unit){
			if ( $single_unit['default'] == $unit ) $selected_unit = $single_unit;
		}
		if ( !isset($selected_unit) ) return false;
		$unit_list = array($selected_unit['default']);
		foreach($selected_unit['alternates'] as $alternate){
			array_push($unit_list, $alternate['name']);
		}
		return $unit_list;
	}

	/**
	* Get the Formula for a provided alternate Unit
	*/
	public function getFormula($unit)
	{
		$units = get_option('unitswitcher_units');
		foreach($units as $single_unit) {
			if ( !isset($single_unit['alternates']) ) continue;
			foreach($single_unit['alternates'] as $alternate){
				if ( $alternate['name'] == $unit ) return $alternate['formula'];
			}
		}
	}

	/**
	* Get the save type
	*/
	public function saveType()
	{
		$option = get_option('unitswitcher_save', true);
		return ( $option !== 'none') ? $option : false;
	}

	/**
	* Is Page Caching Enabled?
	*/
	public function cacheEnabled()
	{
		$option = get_option('unitswitcher_cache');
		return ( $option !== "" && $option == 'true' ) ? true : false;
	}

}