<?php

	// Load the modele and the View

	class Controller {

		// Load the Model
		public function model($model) {

			// require the Model
			require_once('../app/models/' .$model. '.php');

			// Instantiate the Model
			return new $model();
		}

		// Load View
		public function view($view, $data = []) {
			// View search for the view inside /views -- data responsible for the data that we pass from the view

			if(file_exists('../app/views/' .$view. '.php')){

				// If the views existes
				require_once('../app/views/' .$view. '.php');
			} else {
				// OtherWise
				die("View doesn't exists.");
			}
		}
	}