<?php
/**
 * Patch GHCR image: honor RECAPTCHA_ENABLED and avoid login crash when keys are empty.
 * Run inside app container: php /tmp/patch-recaptcha-container.php
 */

$paramsFile = '/var/www/common/config/params.php';
$loginFile = '/var/www/backend/views/site/login.php';

if (!is_file($paramsFile)) {
    fwrite(STDERR, "params.php not found\n");
    exit(1);
}

$paramsContent = file_get_contents($paramsFile);
if (strpos($paramsContent, 'recaptcha.enabled') === false) {
    $enabled = getenv('RECAPTCHA_ENABLED');
    if ($enabled === false || $enabled === '') {
        $enabled = false;
    } else {
        $enabled = filter_var($enabled, FILTER_VALIDATE_BOOLEAN);
    }

    $replacement = "'recaptcha.enabled' => " . ($enabled ? 'true' : 'false') . ",\n"
        . "    'recaptcha.siteKey' => getenv('RECAPTCHA_SITE_KEY') ?: '',\n"
        . "    'recaptcha.secretKey' => getenv('RECAPTCHA_SECRET_KEY') ?: '',";

    $paramsContent = preg_replace(
        "/'recaptcha\\.siteKey'\\s*=>\\s*getenv\\([^)]+\\),\\s*\\n\\s*'recaptcha\\.secretKey'\\s*=>\\s*getenv\\([^)]+\\),/",
        $replacement,
        $paramsContent,
        1,
        $count
    );

    if ($count < 1) {
        fwrite(STDERR, "Could not patch params.php — unexpected format\n");
        exit(1);
    }

    file_put_contents($paramsFile, $paramsContent);
    echo "Patched {$paramsFile}\n";
}

if (is_file($loginFile) && strpos(file_get_contents($loginFile), 'recaptcha.enabled') === false) {
    $enabled = getenv('RECAPTCHA_ENABLED');
    $useRecaptcha = $enabled !== false && $enabled !== ''
        && filter_var($enabled, FILTER_VALIDATE_BOOLEAN);

    $login = file_get_contents($loginFile);
    if (!$useRecaptcha) {
        $login = preg_replace(
            '/\s*<\?= \$form->field\(\$model, \'reCaptcha\'.*?\?>/s',
            '',
            $login
        );
        file_put_contents($loginFile, $login);
        echo "Removed reCaptcha widget from {$loginFile}\n";
    }
}

echo "Done.\n";
