<?php


namespace delocal\Contacts\model;


class ContactGateway extends TableDataGateway
{
    public function insert(ContactGatewayDTO $dto): bool
    {
        $sql = "INSERT INTO contacts (name, email, phone_number, address), VALUES(?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$dto->getName(), $dto->getEmail(), $dto->getPhoneNumber(), $dto->getAddress()]);
    }
}