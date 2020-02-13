<?php


namespace delocal\Contacts\Controllers;


use delocal\Contacts\App\BaseController;
use delocal\Contacts\App\HttpException;
use delocal\Contacts\model\ContactGateway;

class ContactsController extends BaseController
{
    public function actionIndex()
    {
        if (!$this->request->isGetRequest()) {
            throw new HttpException(404, 'This method is not supported for this route. Supported methods: GET.');
        }

        $contactGateway = new ContactGateway();
        $contacts=$contactGateway->findAll();

        $result=[];

        foreach ($contacts as $contactDto) {

            $result[]=[
                'id' => $contactDto->getId(),
                'name' => $contactDto->getName(),
                'email' => $contactDto->getEmail(),
                'phoneNumber' => $contactDto->getPhoneNumber(),
                'address' => $contactDto->getAddress(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}