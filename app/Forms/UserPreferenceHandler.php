<?php namespace UnitSwitcher\Forms;

use UnitSwitcher\Entities\User\UserPreference;

/**
* User Preferences Handler
*/
class UserPreferenceHandler {

	/**
	* Form Data
	*/
	private $data;

	/**
	* User Preference Service Class
	*/
	private $user_preference;

	public function __construct()
	{
		$this->user_preference = new UserPreference;
		$this->setFormData();
		$this->validateNonce();
		$this->savePreference();
		return wp_send_json(array('status'=>'success','message'=>'ok'));
	}

	/**
	* Set Form Data
	*/
	private function setFormData()
	{
		$this->data['nonce'] = sanitize_text_field($_POST['nonce']);
		$this->data['parent_unit'] = sanitize_text_field($_POST['parent_unit']);
		$this->data['selected_unit'] = sanitize_text_field($_POST['selected_unit']);
	}

	/**
	* Validate the Nonce
	*/
	private function validateNonce()
	{
		if ( !wp_verify_nonce( $this->data['nonce'], 'unit_switcher_nonce' ) ) return $this->sendError();
	}

	/**
	* Save the user preference
	*/
	private function savePreference()
	{
		$this->user_preference->save($this->data['parent_unit'], $this->data['selected_unit']);
	}

	/**
	* Send an Error Response
	*/
	private function sendError()
	{
		return wp_send_json(array('status'=>'error', 'message'=>'Invalid form field'));
	}

}