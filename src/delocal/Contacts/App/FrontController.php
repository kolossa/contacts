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
	
	public function findControllerByUrl(string $url) {
		
		$urlInParts=explode('/', $url);
		$filteredUrlInParts=array_filter($urlInParts);
		$isRouteMatchWithUrl=true;
		
		foreach($this->routes as $route=>$values){
			
			$params=[];
			$routeInParts=explode('/', $route);
			$filteredRouteInParts=array_filter($routeInParts);
			
			$isRouteMatchWithUrl=true;
			end($filteredRouteInParts);
			end($filteredUrlInParts);
			
			for($i=0;$i<count($filteredRouteInParts);$i++){
				
				$partRoute=current($filteredRouteInParts);
				$partUrl=current($filteredUrlInParts);
				
				if(stripos($partRoute, '{')!==false){
					
					$params[]=$partUrl;
				}else{
					if($partRoute!=$partUrl){
						$isRouteMatchWithUrl=false;
						break;
					}
				}				
				
				prev($filteredRouteInParts);
				prev($filteredUrlInParts);
			}
			
			if($isRouteMatchWithUrl){
				
				$this->controllerClassName=$values['controller'];
				$this->controllerActionMethodName=$values['action'];
				$this->params=$params;
				break;
			}
		}
		
		if(!$isRouteMatchWithUrl){
			
			throw new \Exception('Controller not found!', 404);
		}
	}
	
	public function run(string $url) {
		
		$this->findControllerByUrl($url);
		call_user_func_array([new $this->controllerClassName, $this->controllerActionMethodName], $this->params);
	}
}