<?php


namespace delocal\Contacts\Controllers;


use delocal\Contacts\App\BaseController;
use delocal\Contacts\App\HttpException;
use delocal\Contacts\model\ContactGateway;
use delocal\Contacts\model\ContactGatewayDTO;

class CreateContactController extends BaseController
{
    public function actionIndex()
    {

        if (!$this->request->isPutRequest()) {
            throw new HttpException(404, 'This method is not supported for this route. Supported methods: PUT.');
        }

        $name = $this->request->getPut('name');
        $email = $this->request->getPut('email');
        $phoneNumber = $this->request->getPut('phoneNumber');
        $address = $this->request->getPut('address');

        if ($name == '' ||
            $email == '' ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            $phoneNumber == '' ||
            $address == ''
        ) {
            throw new HttpException(400, 'Missing data!');

            return;
        }

        $dto = new ContactGatewayDTO(null, $name, $email, $phoneNumber, $address);

        $contactGateway = new ContactGateway();

        $storedContactDto = $contactGateway->findByEmail($dto->getEmail());

        if ($storedContactDto == null) {

            $contactGateway->insert($dto);
            http_response_code(201);

        } else {

            http_response_code(204);
        }
    }
}