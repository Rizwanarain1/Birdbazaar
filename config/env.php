<?php
/**
 * AviNest Environment & Production Error Logger
 * Manages Environment Modes (Development vs Production) and routes errors to logs/error.log.
 */

define('APP_ENV', 'development'); // Change to 'production' on live hosting

$logFile = __DIR__ . '/../logs/error.log';

if (APP_ENV === 'production') {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL);
    ini_set('log_errors', '1');
    ini_set('error_log', $logFile);
} else {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

/**
 * Custom Error Logging Helper
 * @param string $message
 */
function logCustomError($message) {
    global $logFile;
    $timestamp = date('[Y-m-d H:i:s]');
    $entry = "$timestamp $message" . PHP_EOL;
    file_put_contents($logFile, $entry, FILE_APPEND);
}
