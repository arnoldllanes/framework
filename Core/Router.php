<?php

/**
 * Router
 */
class Router {
	/**
	 * Associative array of routes (the routing table)
	 * @var array
	 */
	protected $routes = [];

	/**
	 *  Parameters from the matched route
	 * @var array
	 */
	protected $params = [];

	/**
	 * Add a route to the routing table
	 *
	 * @param string $route The routeURL
	 * @param array $params Parameters (controller, action, etc.)
	 *
	 * @return void
	 */
	public function add($route, $params = [])
	{
		// Convert the reoute to a regular expression: escape forward slashes
		$route = preg_replace('/\//','\\/', $route);
		
		// Convert variables e.g. {controller}
		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z]+)', $route);

		// Add start and end delimiters , and case insensitive flag
		$route = '/^' . $route . '$/i';

		$this->routes[$route] = $params;

	}

	/**
	 * Get all the routes from the routing table
	 * @return array
	 */
	public function getRoutes()
	{
		return $this->routes;
	}

	/**
	 * Match the route to the routes in the routing table, setting the $params property
	 * if a route is found.
	 * 
	 * @param strin $url The route URL
	 *
	 * @return boolean true if a match found, otherwise return false
	 */
	public function match($url)
	{
		//MAtch to the fixed URL format /controller/action
		//$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

			foreach($this->routes as $route => $params) {
				if(preg_match($route, $url, $matches)) {
					//Get named capture group values
					//$params = [];
					foreach($matches as $key => $match){
						if(is_string($key)) {
							$params[$key] = $match;
						}
					}
					$this->params = $params;
					return true;
				}
			}
		return false;
	}

	/**
	 * Get the currently matched parameters 
	 *
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}
}