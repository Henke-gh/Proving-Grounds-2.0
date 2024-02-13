<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class Connection
{
    public static function make(string $driver, string $host, string $database, string $username, string $password): PDO
    {
        return new PDO(
            sprintf(
                '%s:host=%s;dbname=%s',
                $driver,
                $host,
                $database
            ),
            $username,
            $password
        );
    }
}
