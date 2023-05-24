<?php

class DatabaseModel
{
    private $db = null;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE_NAME . ";charset=utf8mb4", DB_USERNAME, DB_PASSWORD);

            if (mysqli_connect_errno()) {
                http_response_code(500);
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            http_response_code(500);
            throw new Exception($e->getMessage());
        }
    }

    public function select($query = "", $params = array())
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            // $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            // $stmt->close();
            return $stmt;
        } catch (Exception $e) {
            http_response_code(500);
            throw new Exception($e->getMessage());
        }
        return false;
    }

    private function executeStatement($query = "", $params = array())
    {
        try {
            $stmt = $this->db->prepare($query);

            if ($stmt === false) {
                http_response_code(500);
                throw new Exception("Unable to do prepared statement: " . $query);
            }

            foreach ($params as $param => $value) {
                $stmt->bindValue($param, $value);
            }

            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            http_response_code(500);
            throw new Exception($e->getMessage());
        }
    }
}