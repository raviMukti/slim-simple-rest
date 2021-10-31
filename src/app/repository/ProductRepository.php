<?php

namespace Api\repository;

use Exception;
use PDO;

interface BaseRepository
{
    function save(array $data);
    function delete(int $id);
    function findAll();
    function findById(int $id);
}

class ProductRepository implements BaseRepository
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    function save(array $data)
    {
        try{
            $query = "INSERT INTO products(name, price, qty, created_at, updated_at) VALUES (:productName, :productPrice, :productQuantity, NOW(), NOW());";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
            "productName" => $data["productName"],
            "productPrice" => $data["productPrice"],
            "productQuantity" => $data["productQuantity"]
            ]);

            return $this->db->lastInsertId();
        }catch(Exception $e)
        {
            throw $e;
        }
    }

    function delete(int $id)
    {
        
    }

    function findAll()
    {
        
    }

    function findById(int $id)
    {
        $query = "SELECT * FROM products WHERE id = :productId;";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            "productId" => $id
        ]);
        return $stmt->fetch();
    }
}