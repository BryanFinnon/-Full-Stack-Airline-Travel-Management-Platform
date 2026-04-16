<?php

class Passenger
{
    public function __construct(private PDO $db)
    {
    }

    public function create(array $data): int
    {
        $sql = "
            INSERT INTO passengers (user_id, first_name, last_name, email, phone, passport_number, nationality)
            VALUES (:user_id, :first_name, :last_name, :email, :phone, :passport_number, :nationality)
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":user_id" => $data["user_id"] ?? null,
            ":first_name" => $data["first_name"],
            ":last_name" => $data["last_name"],
            ":email" => $data["email"],
            ":phone" => $data["phone"] ?? null,
            ":passport_number" => $data["passport_number"],
            ":nationality" => $data["nationality"] ?? null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function findExistingByPassport(string $passportNumber): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM passengers WHERE passport_number = :passport_number LIMIT 1");
        $stmt->execute([":passport_number" => $passportNumber]);
        $passenger = $stmt->fetch();

        return $passenger ?: null;
    }
}
