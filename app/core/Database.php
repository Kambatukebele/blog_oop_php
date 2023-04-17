<?php
class Database
{
    private function DB_CONNECT()
    {

        try {

            $query = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            $pdo = new PDO($query, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Failed to connect: " . $e->getMessage();
        }

        $pdo = null;
    }

    public function READ_DB(string $query, array $data = [])
    {
        $conn = $this->DB_CONNECT();
        $stmt = $conn->prepare($query);
        $stmt->execute($data);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return false;
    }

    public function WRITE_DB(string $query, array $data = [])
    {
        $conn = $this->DB_CONNECT();
        $stmt = $conn->prepare($query);
        $result = $stmt->execute($data);

        if ($result) {
            return true;
        }

        return false;
    }
}