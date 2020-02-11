<?php


namespace delocal\Contacts\Controllers;


use delocal\Contacts\App\BaseController;

class CreateContactController extends BaseController
{
    public function actionIndex(){

        if(!$this->request->isPutRequest()){
            throw new \Exception('Page not found!', 404);
        }

        if (strncmp($this->request->getContentType(), 'application/json', 16) === 0){
            $rawBody=file_get_contents('php://input');
            $result = json_decode($rawBody);
            var_dump($result);
        }

    }
}