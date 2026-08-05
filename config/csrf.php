<?php
/**
 * AviNest Anti-CSRF Token Manager
 * Generates and validates Cross-Site Request Forgery tokens.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CSRF {

    /**
     * Generate or return existing CSRF Token for the user session
     * @return string
     */
    public static function generateToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Verify incoming request CSRF Token against session token using timing-attack safe comparison
     * @param string $token
     * @return bool
     */
    public static function verifyToken($token) {
        if (empty($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
}
