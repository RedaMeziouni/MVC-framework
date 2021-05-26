<?php

class Pages extends Controller {
	public function __construct() {
		// Testing
		// echo 'loaded';
		$this->userModel = $this->model('User');
	}

	public function index() {
		// Data 
		$data = [
			'title' => '',
			'description' => ''
		];

		// Set the default view
		$this->view('pages/index', $data); 
	}

	public function about() {
		echo 'About';
	}
}