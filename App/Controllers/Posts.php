<?php 

namespace App\Controllers;
/**
 * Posts Controller
 */

class Posts extends \Core\Controller {
	/**
	 * Show the index page
	 * @return void
	 */

	public function index()
	{
		echo 'Hello from the index in the posts controller';
		echo '<p>Query string parameters: <pre>' . htmlspecialchars(print_r($_GET, true)) . '</pre></p>';
	}

	public function addNew()
	{
		echo 'here is the add new method';
	}

	public function edit()
	{
		echo 'Hello from the edit action in the Posts Controller!';
		echo '<p>Route parameters: <pre>' . htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
	}
}