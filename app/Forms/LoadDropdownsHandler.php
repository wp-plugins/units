<?php namespace UnitSwitcher\Forms;

use UnitSwitcher\Entities\Unit\Dropdown;

/**
* Lazy Load the dropdowns for cached pages
*/
class LoadDropdownsHandler {

	public function __construct()
	{
		$this->getDropdowns();
	}

	/**
	* Get the dropdown HTML
	*/
	private function getDropdowns()
	{
		$all_dropdowns = $_POST['dropdowns'];
		$dropdowns = array();
		foreach($all_dropdowns as $key => $item){
			$id = sanitize_text_field($item['id']);
			$unit = sanitize_text_field($item['unit']);
			$value = sanitize_text_field($item['value']);
			$round = sanitize_text_field($item['round']);
			$dd = new Dropdown($unit, $value, $round);
			$dropdowns[$key] = ( $dd->hasAlternates() ) ? $dd->display() : $value . ' ' . $unit;
		}
		$this->sendResponse($dropdowns);
	}

	/**
	* Send the JSON response
	*/
	private function sendResponse($dropdowns)
	{
		return wp_send_json(array(
			'status' => 'success', 
			'dropdowns' => $dropdowns
		));
	}

}