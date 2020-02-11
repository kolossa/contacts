<?php 

namespace delocal\Contacts\Controllers;

use delocal\Contacts\App\BaseController;

class TestController extends BaseController {
	
	public function actionIndex($id){
		
		var_dump($id);
	}
}