<?php

//Core App Class

class Core {
	protected $currentController = 'Pages';
	protected $currentMethod = 'index';
	protected $params = [];


	public function __construct() {
		// Testing
		// print_r($this->getUrl());

		$url = $this->getUrl();

		// Look inside the cotroller for the first value, ucwords capitalize First Letter
		if (file_exists('../app/controllers/' .ucwords($url[0]). '.php')) {
			
			// Set a new Controller
			$this->currentController = ucwords($url[0]);
			unset($url[0]);
		}

		// Require the controller 
		require_once('../app/controllers/' . $this->currentController. '.php');
		// Instantiate the new controller
		$this->currentController = new $this->currentController;

		// Checking for the 2nd part of the URL
		if(isset($url[1])) {
			if(method_exists($this->currentController, $url[1])) {
				$this->currentMethod = $url[1];
				unset($url[1]);
			}
		}

		// Get the parameters
		$this->params = $url ? array_values($url) : []; //Check for params, if it is not keep it empty

		// Call a callback with array of params
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

	}
	// Getting the URL
	public function getUrl() {
		if(isset($_GET['url'])) {

			// get ride of the ending slash
			$url = rtrim($_GET['url'], '/');
			
			// Get ride of @ $ ...etc
			$url = filter_var($url, FILTER_SANITIZE_URL);

			// break the url into an array
			$url = explode('/', $url);

			// return it
			return $url;
		}
	}
}