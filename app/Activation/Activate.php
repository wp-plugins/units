<?php namespace UnitSwitcher\Activation;
/**
* Plugin Activation
*/
class Activate {

	public function __construct()
	{
		$this->setOptions();
	}

	/**
	* Default Units
	*/
	public function defaultUnits()
	{
		$units = array(
			array(
				'default' => 'feet',
				'default_singular' => 'foot',
				'alternates' => array(
					array(
						'name' => 'inches',
						'name_singular' => 'in',
						'formula' => 'X*12'
					),
					array(
						'name' => 'centimeters',
						'name_singular' => 'cm',
						'formula' => 'X*30.48'
					),
					array(
						'name' => 'yards',
						'name_singular' => 'yard',
						'formula' => 'X*0.333333'
					),
					array(
						'name' => 'miles',
						'name_singular' => 'mile',
						'formula' => 'X/5280'
					),
				)
			),
			array(
				'default' => 'acres',
				'default_singular' => 'acre',
				'alternates' => array(
					array(
						'name' => 'kilometers squared',
						'name_singular' => 'km2',
						'formula'=> 'X*0.00404686'
					),
					array(
						'name' => 'square miles',
						'name_singular' => 'sq mi',
						'formula'=> 'X*0.0015625'
					),
					array(
						'name' => 'square feet',
						'name_singular' => 'sq ft',
						'formula'=> 'X*43560'
					)
				)
			)
		);
		return $units;
	}

	/**
	* Default Plugin Options
	*/
	private function setOptions()
	{
		if ( !get_option('unitswitcher_dependencies') 
			&& get_option('unitswitcher_dependencies') !== "" ){
			update_option('unitswitcher_dependencies', array(
				'css' => 'true',
				'js' => 'true'
			));
		}
		if ( !get_option('unitswitcher_save') ){
			update_option('unitswitcher_save', 'none');
		}
		if ( !get_option('unitswitcher_cache') ){
			update_option('unitswitcher_cache', 'false');
		}
		if ( !get_option('unitswitcher_units') ){
			update_option('unitswitcher_units', $this->defaultUnits() );
		}
	}

}