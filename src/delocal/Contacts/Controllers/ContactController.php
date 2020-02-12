<?php


namespace delocal\Contacts\Controllers;


use delocal\Contacts\App\BaseController;
use delocal\Contacts\model\ContactGateway;

class ContactController extends BaseController
{
    public function actionIndex($id)
    {
        if (!$this->request->isGetRequest()) {
            throw new \Exception('Page not found!', 404);
        }


        $contactGateway = new ContactGateway();
        $dto = $contactGateway->findByPk($id);

        if ($dto == null) {
            throw new \Exception('Contact not found!', 404);
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