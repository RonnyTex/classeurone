<?php

declare(strict_types=1);

namespace Infrastructure\Framework\Database;

use PDO;
use PDOException;

class Database {

    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {

        if (self::$connection === null) {
            $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
            $port = $_ENV['DB_PORT'] ?? '5432';
            $dbname = $_ENV['DB_NAME'] ?? 'app';
            $user = $_ENV['DB_USER'] ?? 'postgres';
            $password = $_ENV['DB_PASS'] ?? '';

            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

            try {
                self::$connection = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // gestion des erreurs
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // fetch propre
                    PDO::ATTR_EMULATE_PREPARES => false, // vraie sécurité PostgreSQL
                    PDO::ATTR_PERSISTENT => true, // connexion persistante 🔥
                ]);
            } catch (PDOException $e) {
                throw new PDOException(
                    "Database connection failed: " . $e->getMessage(),
                    (int)$e->getCode()
                );
            }
        }

        return self::$connection;
    }

    /**
     * INSERT / UPDATE / DELETE
     */
    public static function execute(string $query, array $params = []): bool
    {
        $stmt = self::getConnection()->prepare($query);
        return $stmt->execute($params);
    }

    /**
     * Exécuter une requête SELECT
     */
    public static function fetchAll(string $query, array $params = []): array
    {
        $stmt = self::getConnection()->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

}