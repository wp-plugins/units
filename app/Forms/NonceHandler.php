<?php namespace UnitSwitcher\Forms;

/**
* Creates a Nonce for Cached Pages
*/
class NonceHandler {

	public function __construct()
	{
		$this->generateNonce();
	}

	private function generateNonce()
	{
		$data = array(
			'status' => 'success',
			'nonce' => wp_create_nonce('unit_switcher_nonce')
		);
		return wp_send_json($data);
	}

}