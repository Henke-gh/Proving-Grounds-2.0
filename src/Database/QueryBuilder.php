<?php

declare(strict_types=1);

namespace App\Database;

use PDOException;
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
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "INSERT INTO Users (Username, Password) VALUES (:username, :pw)";
            $statement = $this->database->prepare($this->query);

            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':pw', $password, PDO::PARAM_STR);

            $success = $statement->execute();

            return $success;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }

    public function getUsernames(): array
    {
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "SELECT Username FROM Users";
            $statement = $this->database->query($this->query);

            $usernames = $statement->fetchAll(PDO::FETCH_COLUMN);

            return $usernames;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }

    public function getAllFromTable(string $table): array
    {
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "SELECT * FROM $table";
            $statement = $this->database->query($this->query);

            $table = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $table;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }

    public function addHero(int $userID, string $heroJSON, int $version): bool
    {
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "INSERT INTO heroes (User_ID, heroData, heroVersion) VALUES (:userID, :heroData, :heroVersion)";
            $statement = $this->database->prepare($this->query);

            $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
            $statement->bindParam(':heroData', $heroJSON, PDO::PARAM_STR);
            $statement->bindParam(':heroVersion', $version, PDO::PARAM_INT);

            $success = $statement->execute();

            return $success;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }

    public function updateHero(int $userID, string $heroData): bool
    {
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "UPDATE heroes SET heroData = :heroData, heroVersion = heroVersion + 1 WHERE User_ID = :userID";
            $statement = $this->database->prepare($this->query);

            $statement->bindParam(':heroData', $heroData, PDO::PARAM_STR);
            $statement->bindParam(':userID', $userID, PDO::PARAM_INT);

            $success = $statement->execute();

            return $success;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }

    public function deleteHero(int $userID): bool
    {
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "DELETE FROM heroes WHERE User_ID = $userID";
            $statement = $this->database->query($this->query);

            $success = $statement->execute();

            return $success;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }

    public function getHero(int $userID): array
    {
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "SELECT heroData FROM heroes WHERE User_ID = $userID";
            $statement = $this->database->query($this->query);

            $heroData = $statement->fetchColumn();

            if ($heroData === false) {
                return $hero = []; //If no data is saved/ found.
            }

            $hero = unserialize($heroData);
            return $hero;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }

    //Add hero to tombstone
    public function writeOnTombstone(int $userID, string $heroName, string $heroLevel, string $date): bool
    {
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "INSERT INTO tombstone (User_ID, heroName, heroLevel, date) VALUES (:User_ID, :heroName, :heroLevel, :date)";
            $statement = $this->database->prepare($this->query);

            $statement->bindParam(':User_ID', $userID, PDO::PARAM_INT);
            $statement->bindParam(':heroName', $heroName, PDO::PARAM_STR);
            $statement->bindParam(':heroLevel', $heroLevel, PDO::PARAM_INT);
            $statement->bindParam(':date', $date, PDO::PARAM_STR);

            $success = $statement->execute();

            return $success;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }

    public function readTombstone(): array
    {
        //this is perhaps not THE way to do it, but it's what we got right now. baseURL is set in bootstrap.php
        global $baseURL;

        try {
            $this->query = "SELECT * FROM tombstone ORDER BY heroLevel DESC LIMIT 50";
            $statement = $this->database->query($this->query);

            $tombstone = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($tombstone === false) {
                return $tombstone = [];
            }

            return $tombstone;
        } catch (PDOException $error) {
            $_SESSION['exceptionError'] = $error;
            header('Location:' . $baseURL . '/app/error.php');
        }
    }
}
