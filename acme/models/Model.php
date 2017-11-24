<?php
namespace acme\models;

use acme\interfaces\IModel;
use acme\database\Connection;
use PDOException;
use acme\database\AttributesCreate;
use acme\database\AttributesUpdate;

class Model implements IModel
{
    public $database;


    public function __construct()
    {
        $database = new Connection;
        $this->database = $database->connection();


    }

    public function create($attributes)
    {
        //insert into usuarios(name,email,password)values(:name,:email,:password);
        $attributesCreate = new AttributesCreate();
        $fields = $attributesCreate->createFields($attributes);
        $values = $attributesCreate->createValues($attributes);
        $query = "insert into $this->table($fields)values($values);";
        $pdo = $this->database->prepare($query);
        $bindParameters = $attributesCreate->bindCreateParameters($attributes);

        try
        {
            $pdo->execute($bindParameters);
            return $this->database->lastInsertId();

        }catch(PDOException $e)
        {
            dump($e->getMessage());
        }

    }
    public function read()
    {
        $query = "select * from $this->table";
        $pdo = $this->database->prepare($query);
        try
        {
            $pdo->execute();
            return $pdo->fetchAll();

        }catch(PDOException $e)
        {
            dump($e->getMessage());
        }
    }
    public function update($id,$attributes)
    {
        $attributesUpdate = new AttributesUpdate();
        $fields = $attributesUpdate->updateFields($attributes);
        $query = "update $this->table set $fields where codigo = :id";
        $pdo = $this->database->prepare($query);
        $bindUpdateParameters = $attributesUpdate->bindUpdateParameters($attributes);
        $bindUpdateParameters['id'] = $id;
        try
        {
            $pdo->execute($bindUpdateParameters);
            return $pdo->rowCount();

        }
        catch(PDOException $e)
        {
            dump($e->getMessage());
        }
    }
    public function delete($name, $value)
    {
        $query = "delete from $this->table where $name = :$name";
        $pdo = $this->database->prepare($query);
        try
        {
            $pdo->bindParam(":$name",$value);
            $pdo->execute();
            return $pdo->rowCount();
        }
        catch(PDOException $e)
        {
            dump($e->getMessage());
        }

    }
    public function findBy($name, $value)
    {
        $query = "select *  from $this->table where $name = $value";
        $pdo = $this->database->prepare($query);
        try
        {

            $pdo->execute();
            return $pdo->fetchAll();
        }
        catch(PDOException $e)
        {
            dump($e->getMessage());
        }
    }
}
?>