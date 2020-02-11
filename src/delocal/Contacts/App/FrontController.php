<?php 

namespace delocal\Contacts\App;

class FrontController{
	
	protected $routes;
	protected $controllerClassName;
	protected $controllerActionMethodName;
	protected $params;

    /**
     * @var Request $request
     */
	protected $request;
	
	public function __construct($routes){
		
		$this->routes=$routes;
		$this->request=new Request($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
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

		$controller=new $this->controllerClassName($this->request);
		call_user_func_array([$controller, $this->controllerActionMethodName], $this->params);
	}
}