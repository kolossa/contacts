<?php


namespace delocal\Contacts\model;


class ContactGateway extends TableDataGateway
{
    protected $tableName = 'contacts';

    public function insert(ContactGatewayDTO $dto): bool
    {
        $sql = "INSERT INTO $this->tableName (name, email, phone_number, address) VALUES(?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$dto->getName(), $dto->getEmail(), $dto->getPhoneNumber(), $dto->getAddress()]);
    }

    public function findByEmail(string $email): ?ContactGatewayDTO
    {
        $sql = "SELECT * FROM $this->tableName WHERE email=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }

        return new ContactGatewayDTO($result['name'], $result['email'], $result['phone_number'], $result['address']);
    }

    public function findByPk(int $id): ?ContactGatewayDTO
    {
        $sql = "SELECT * FROM $this->tableName WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }

        return new ContactGatewayDTO($result['id'], $result['name'], $result['email'], $result['phone_number'], $result['address']);
    }

    public function changeEmail(string $oldEmail, string $newEmail): bool
    {

        $sql = "UPDATE $this->tableName SET email=? WHERE email=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$newEmail, $oldEmail]);
    }
}