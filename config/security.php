<?php
/**
 * AviNest Enterprise Security & Input Sanitization Helper
 * Protects against Cross-Site Scripting (XSS) and enforces Security Response Headers.
 */

class Security {
    
    /**
     * Sanitize a string input against XSS attacks
     * @param string $data
     * @return string
     */
    public static function cleanInput($data) {
        if (is_null($data)) return '';
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * Recursively sanitize array data
     * @param array $array
     * @return array
     */
    public static function sanitizeArray($array) {
        $clean = [];
        foreach ($array as $key => $value) {
            $cleanKey = self::cleanInput($key);
            if (is_array($value)) {
                $clean[$cleanKey] = self::sanitizeArray($value);
            } else {
                $clean[$cleanKey] = self::cleanInput($value);
            }
        }
        return $clean;
    }

    /**
     * Send Enterprise Security HTTP Headers
     */
    public static function setSecurityHeaders() {
        if (!headers_sent()) {
            header("X-Frame-Options: SAMEORIGIN");
            header("X-Content-Type-Options: nosniff");
            header("X-XSS-Protection: 1; mode=block");
            header("Referrer-Policy: strict-origin-when-cross-origin");
        }
    }
}

// Automatically apply security headers
Security::setSecurityHeaders();
