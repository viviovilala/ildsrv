<?php

$envFile = __DIR__ . '/../../.env';

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Skip comment lines
        if (strpos(ltrim($line), '#') === 0) {
            continue;
        }

        if (strpos($line, '=') !== false) {
            list($key, $value) = array_map('trim', explode('=', $line, 2));
            putenv("$key=$value");
        }
    }
} else {
    error_log('[ILDIS] WARNING: .env file not found at ' . $envFile . '. Falling back to runtime environment variables.');
}

/**
 * Whether session/identity cookies should use the Secure flag.
 * HTTP Docker installs (e.g. http://localhost:8080) must not set Secure or the browser drops the session.
 */
function ildis_cookie_secure(): bool
{
    $explicit = getenv('COOKIE_SECURE');
    if ($explicit !== false && $explicit !== '') {
        return filter_var($explicit, FILTER_VALIDATE_BOOLEAN);
    }

    $domain = getenv('PUBLIC_DOMAIN') ?: '';
    return stripos($domain, 'https://') === 0;
}

/**
 * Define YII_DEBUG and YII_ENV from environment (Docker, .env) before the app boots.
 */
function ildis_define_yii_constants(): void
{
    if (!defined('YII_DEBUG')) {
        $debug = getenv('YII_DEBUG');
        $enabled = $debug !== false && $debug !== ''
            && filter_var($debug, FILTER_VALIDATE_BOOLEAN);
        define('YII_DEBUG', $enabled);
    }

    if (!defined('YII_ENV')) {
        $env = getenv('YII_ENV');
        define('YII_ENV', ($env === false || $env === '') ? 'prod' : $env);
    }
}
