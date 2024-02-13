<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class QueryBuilder
{
    private string $query;

    public function __construct(
        private PDO $database
    ) {
    }

    public function addUser(string $username, string $password): bool
    {
        $this->query = "INSERT INTO Users (Username, Password) VALUES (:username, :pw)";
        $statement = $this->database->prepare($this->query);

        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':pw', $password, PDO::PARAM_STR);

        $success = $statement->execute();

        return $success;
    }


    public function getAllFromTable(string $table): array
    {
        $this->query = "SELECT * FROM $table";
        $statement = $this->database->query($this->query);

        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
}
