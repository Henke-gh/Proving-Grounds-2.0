<?php

declare(strict_types=1);

// Function to sanitize input data
function sanitizePost($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES);

    return $input;
}

function profanityCheck(string $name): bool
{
    $profanity = ['neger', 'nigger', 'jew', 'jude', 'kuk', 'fitta', 'cunt', 'cock', 'hitler', 'n1gger'];
    $nameToLower = strtolower($name);

    foreach ($profanity as $word) {
        if (strpos($nameToLower, $word) !== false) {
            return true;
        }
    }

    return false;
}
