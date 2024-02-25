<?php

declare(strict_types=1);

// Function to sanitize input data
function sanitizePost($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES);

    return $input;
}
