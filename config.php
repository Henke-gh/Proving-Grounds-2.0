<?php

declare(strict_types=1);

return [
    'database' => [
        'driver' => $_ENV['DATABASE_DRIVER'],
        'host' => $_ENV['DATABASE_HOST'],
        'database' => $_ENV['DATABASE_NAME'],
        'username' => $_ENV['DATABASE_USER'],
        'password' => $_ENV['DATABASE_PASSWORD'],
    ],
];
