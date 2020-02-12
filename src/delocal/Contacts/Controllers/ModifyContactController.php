<?php


namespace delocal\Contacts\Controllers;


use delocal\Contacts\App\BaseController;
use delocal\Contacts\model\ContactGateway;

class ModifyContactController extends BaseController
{
    public function actionIndex()
    {
        if (!$this->request->isPutRequest()) {
            throw new \Exception('This method is not supported for this route. Supported methods: PUT.', 404);
        }

        $oldEmail = $this->request->getPut('old_email');
        $newEmail = $this->request->getPut('new_email');

        if ($oldEmail == '' ||
            $newEmail == '' ||
            !filter_var($oldEmail, FILTER_VALIDATE_EMAIL) ||
            !filter_var($newEmail, FILTER_VALIDATE_EMAIL)
        ) {
            throw new \Exception('Missing data!', 400);

            return;
        }

        $contactGateway = new ContactGateway();

        $storedContactDto = $contactGateway->findByEmail($oldEmail);

        if($storedContactDto==null){

            throw new \Exception('Contact not found by email: '.$oldEmail, 404);
        }

        $result=$contactGateway->changeEmail($oldEmail, $newEmail);

        if($result){

            http_response_code(200);
        }
    }
}