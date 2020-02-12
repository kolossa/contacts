<?php


namespace delocal\Contacts\Controllers;


use delocal\Contacts\App\BaseController;
use delocal\Contacts\model\ContactGateway;
use delocal\Contacts\model\ContactGatewayDTO;

class CreateContactController extends BaseController
{
    public function actionIndex(){

        if(!$this->request->isPutRequest()){
            throw new \Exception('Page not found!', 404);
        }

        $name = $this->request->getPut('name');
        $email = $this->request->getPut('email');
        $phoneNumber = $this->request->getPut('phoneNumber');
        $address = $this->request->getPut('address');

        $dto = new ContactGatewayDTO($name, $email, $phoneNumber, $address);

        $contactGateway = new ContactGateway();
        $contactGateway->insert($dto);

    }
}