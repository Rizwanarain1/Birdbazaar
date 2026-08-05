<?php
/**
 * AviNest Database Connection Handler (PDO Architecture)
 * Provides a secure, single-instance PDO connection to MySQL database.
 */

class Database {
    private static $host = "localhost";
    private static $db_name = "avinest_db";
    private static $username = "root";
    private static $password = "";
    private static $conn = null;

    /**
     * Get active PDO database connection
     * @return PDO
     */
    public static function getConnection() {
        if (self::$conn === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                self::$conn = new PDO($dsn, self::$username, self::$password, $options);
            } catch (PDOException $e) {
                // In production, log error instead of displaying raw message
                http_response_code(500);
                echo json_encode([
                    "success" => false,
                    "message" => "Database Connection Error: " . $e->getMessage()
                ]);
                exit;
            }
        }
        return self::$conn;
    }
}
