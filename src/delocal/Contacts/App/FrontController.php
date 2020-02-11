<?php 

namespace delocal\Contacts\App;

class FrontController{
	
	protected $routes;
	
	public function __construct($routes){
		
		$this->routes=$routes;
	}
	
	public function findControllerByUrl(string $url) {
		
		$urlInParts=explode('/', $url);
		$filteredUrlInParts=array_filter($urlInParts);
		
		foreach($this->routes as $route=>$values){
			
			$routeInParts=explode('/', $route);
			$filteredRouteInParts=array_filter($routeInParts);
			
			$isRouteMatchWithUrl=true;
			end($filteredRouteInParts);
			end($filteredUrlInParts);
			
			for($i=0;$i<count($filteredRouteInParts);$i++){
				
				$partRoute=current($filteredRouteInParts);
				$partUrl=current($filteredUrlInParts);
				
				
				if(stripos($partRoute, '{')!==false){
					
					continue;
				}
				
				if($partRoute!=$partUrl){
					$isRouteMatchWithUrl=false;
					break;
				}
				
				prev($filteredRouteInParts);
				prev($filteredUrlInParts);
			}
			
			if($isRouteMatchWithUrl){
				
				return $values;
			}
		}
	}
	
	public function run() {}
}