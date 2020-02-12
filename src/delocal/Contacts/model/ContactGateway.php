<?php


namespace delocal\Contacts\model;


class ContactGateway extends TableDataGateway
{
	protected $tableName='contacts';

    public function insert(ContactGatewayDTO $dto): bool
    {
        $sql = "INSERT INTO $this->tableName (name, email, phone_number, address), VALUES(?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$dto->getName(), $dto->getEmail(), $dto->getPhoneNumber(), $dto->getAddress()]);
    }

    public function exists(ContactGatewayDTO $dto): bool
	{
		$sql = "SELECT * FROM $this->tableName WHERE name=? COLLATE utf8_bin AND email=? AND phone_number=? AND address=? COLLATE utf8_bin LIMIT 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute([$dto->getName(), $dto->getEmail(), $dto->getPhoneNumber(), $dto->getAddress()]);

		$result = $stmt->fetch(\PDO::FETCH_ASSOC);

		if($result==false){
			return false;
		}

		return true;
	}
}