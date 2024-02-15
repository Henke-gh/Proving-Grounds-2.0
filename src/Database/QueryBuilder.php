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

    public function getUsernames(): array
    {
        $this->query = "SELECT Username FROM Users";
        $statement = $this->database->query($this->query);

        $usernames = $statement->fetchAll(PDO::FETCH_COLUMN);

        return $usernames;
    }

    public function getAllFromTable(string $table): array
    {
        $this->query = "SELECT * FROM $table";
        $statement = $this->database->query($this->query);

        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public function addHero(int $userID, string $heroJSON, int $version): bool
    {
        $this->query = "INSERT INTO heroes (User_ID, heroData, heroVersion) VALUES (:userID, :heroData, :heroVersion)";
        $statement = $this->database->prepare($this->query);

        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
        $statement->bindParam(':heroData', $heroJSON, PDO::PARAM_STR);
        $statement->bindParam(':heroVersion', $version, PDO::PARAM_INT);

        $success = $statement->execute();

        return $success;
    }

    public function updateHero(int $userID, string $heroData): bool
    {
        $this->query = "UPDATE heroes SET heroData = :heroData, heroVersion = heroVersion + 1 WHERE User_ID = :userID";
        $statement = $this->database->prepare($this->query);

        $statement->bindParam(':heroData', $heroData, PDO::PARAM_STR);
        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);

        $success = $statement->execute();

        return $success;
    }

    public function getHero(int $userID): array
    {
        $this->query = "SELECT heroData FROM heroes WHERE User_ID = $userID";
        $statement = $this->database->query($this->query);

        $heroData = $statement->fetchColumn();

        if ($heroData === false) {
            return $hero = []; //If no data is saved/ found.
        }

        $hero = unserialize($heroData);
        return $hero;
    }

    //Add hero to tombstone
    public function writeOnTombstone(int $userID, string $heroName, string $heroLevel, string $date): bool
    {
        $this->query = "INSERT INTO tombstone (User_ID, heroName, heroLevel, date) VALUES (:User_ID, :heroName, :heroLevel, :date)";
        $statement = $this->database->prepare($this->query);

        $statement->bindParam(':User_ID', $userID, PDO::PARAM_INT);
        $statement->bindParam(':heroName', $heroName, PDO::PARAM_STR);
        $statement->bindParam(':heroLevel', $heroLevel, PDO::PARAM_INT);
        $statement->bindParam(':date', $date, PDO::PARAM_STR);

        $success = $statement->execute();

        return $success;
    }
}
