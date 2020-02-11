<?php 

namespace delocal\Contacts\App;

class FrontController{
	
	protected $routes;
	protected $controllerClassName;
	protected $controllerActionMethodName;
	protected $params;
	
	public function __construct($routes){
		
		$this->routes=$routes;
	}
	
	protected function findControllerByUrl(string $url): void {
		
		$urlInParts=explode('/', $url);
		$filteredUrlInParts=array_filter($urlInParts);
		
		
		foreach($this->routes as $route=>$routingValues){
			
			if($this->setControllerByRoute($route, $routingValues, $filteredUrlInParts)){
				return;
			}
		}
		
		throw new \Exception('Controller not found!', 404);
	}
	
	protected function setControllerByRoute($route, $routingValues, $filteredUrlInParts): bool {
		
		$params=[];
		$routeInParts=explode('/', $route);
		$filteredRouteInParts=array_filter($routeInParts);
		
		end($filteredRouteInParts);
		end($filteredUrlInParts);
		
		for($i=0;$i<count($filteredRouteInParts);$i++){
			
			$partRoute=current($filteredRouteInParts);
			$partUrl=current($filteredUrlInParts);
			
			if(stripos($partRoute, '{')!==false){
				
				$params[]=$partUrl;
			}else{
				if($partRoute!=$partUrl){
					return false;
				}
			}				
			
			prev($filteredRouteInParts);
			prev($filteredUrlInParts);
		}
		
		$this->controllerClassName=$routingValues['controller'];
		$this->controllerActionMethodName=$routingValues['action'];
		$this->params=$params;
		return true;
	}
	
	public function run(string $url) {
		
		$this->findControllerByUrl($url);
		call_user_func_array([new $this->controllerClassName, $this->controllerActionMethodName], $this->params);
	}
}