<?php

class Product
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function all()
    {
        $result = $this->conn->query("SELECT * FROM items ORDER BY id ASC");
        return $result;
    }

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($name, $category, $price, $quantity, $description, $status)
    {
        $stmt = $this->conn->prepare("INSERT INTO items (name, category, price, quantity, description, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdiss", $name, $category, $price, $quantity, $description, $status);

        return $stmt->execute();
    }

    public function update($id, $name, $category, $price, $quantity, $description, $status)
    {
        $stmt = $this->conn->prepare("UPDATE items SET name = ?, category = ?, price = ?, quantity = ?, description = ?, status = ? WHERE id = ?");
        $stmt->bind_param("ssdissi", $name, $category, $price, $quantity, $description, $status, $id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM items WHERE id = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
