<?php


namespace delocal\Contacts\Controllers;


use delocal\Contacts\App\BaseController;
use delocal\Contacts\App\HttpException;
use delocal\Contacts\model\ContactGateway;

class ModifyContactController extends BaseController
{
    public function actionIndex()
    {
        if (!$this->request->isPutRequest()) {
            throw new HttpException(404, 'This method is not supported for this route. Supported methods: PUT.');
        }

        $oldEmail = $this->request->getPut('old_email');
        $newEmail = $this->request->getPut('new_email');

        if ($oldEmail == '' ||
            $newEmail == '' ||
            !filter_var($oldEmail, FILTER_VALIDATE_EMAIL) ||
            !filter_var($newEmail, FILTER_VALIDATE_EMAIL)
        ) {
            throw new HttpException(400, 'Missing data!');

            return;
        }

        $contactGateway = new ContactGateway();

        $storedContactDto = $contactGateway->findByEmail($oldEmail);

        if($storedContactDto==null){

            throw new HttpException(404, 'Contact not found by email: '.$oldEmail);
        }

        $result=$contactGateway->changeEmail($oldEmail, $newEmail);

        if($result){

            http_response_code(200);
        }
    }
}