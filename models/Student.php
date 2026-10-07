<?php

class Student {
    private $conn;
    private $table = "students";

    public function __construct($db) {
        $this->conn = $db;
    }


    public function authenticate($ic, $password) {
        $query = "SELECT id, name, ic, program, password, marks
                  FROM {$this->table} WHERE ic = :ic LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ic", $ic);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            return $row;
        }
        return false;
    }


    public function getById($id) {
        $query = "SELECT id, name, ic, program, profile_picture, marks
                  FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfileImage($id, $filename) {
        $query = "UPDATE {$this->table} SET profile_picture = :profile_picture WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":profile_picture", $filename);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function getPasswordHash($id) {
        $query = "SELECT password FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['password'] : null;
    }

    public function updatePassword($id, $newHashedPassword) {
        $query = "UPDATE {$this->table} SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":password", $newHashedPassword);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function getAll() {
        $query = "SELECT id, name, ic, program, marks FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create($name, $ic, $program, $marks, $hashedPassword) {
        $query = "INSERT INTO {$this->table} (name, ic, program, marks, password)
                  VALUES (:name, :ic, :program, :marks, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":ic", $ic);
        $stmt->bindParam(":program", $program);
        $stmt->bindParam(":marks", $marks);
        $stmt->bindParam(":password", $hashedPassword);
        return $stmt->execute();
    }


    public function update($id, $name, $ic, $program, $marks) {
        $query = "UPDATE {$this->table}
                  SET name = :name, ic = :ic, program = :program, marks = :marks
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":ic", $ic);
        $stmt->bindParam(":program", $program);
        $stmt->bindParam(":marks", $marks);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

 
    public function icExists($ic, $excludeId = null) {
        $query = "SELECT id FROM {$this->table} WHERE ic = :ic";
        if ($excludeId) {
            $query .= " AND id != :id";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ic", $ic);
        if ($excludeId) {
            $stmt->bindParam(":id", $excludeId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
