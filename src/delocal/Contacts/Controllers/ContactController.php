<?php


namespace delocal\Contacts\Controllers;


use delocal\Contacts\App\BaseController;
use delocal\Contacts\App\HttpException;
use delocal\Contacts\model\ContactGateway;

class ContactController extends BaseController
{
    public function actionIndex($id)
    {
        if (!$this->request->isGetRequest()) {
            throw new HttpException(404, 'This method is not supported for this route. Supported methods: GET. ');
        }


        $contactGateway = new ContactGateway();
        $dto = $contactGateway->findByPk($id);

        if ($dto == null) {
            throw new HttpException(404, 'Contact not found!');
        }

        header('Content-Type: application/json');

        $result = [
            'id' => $dto->getId(),
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'phoneNumber' => $dto->getPhoneNumber(),
            'address' => $dto->getAddress(),
        ];

        echo json_encode($result);
    }
}