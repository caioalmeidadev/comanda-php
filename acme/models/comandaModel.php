<?php

namespace acme\models;
use acme\models\Model;
class comandaModel extends Model
{
    protected $table = 'R000001';




    public function readMesas()
    {
        $query = "select right('000000' || num ,6)num from mesas where STATUS='A'";
        $pdo =  $this->database->prepare($query);
        try
        {
            $pdo->execute();
            return $pdo->fetchAll();

        }catch(PDOException $e)
        {
            dump($e->getMessage());
        }
    }

    public function mesaAberta($mesa)
    {
        $query = "select codigo from $this->table where codigo=$mesa";
        $pdo = $this->database->prepare($query);
        try
        {
            $pdo->execute();
            return $pdo->fetchAll();
        }catch(\PDOException $e)
        {
            dump($e->getMessage());
        }
    }
    public function abrirMesa($mesa,$data,$hora,$cod_funcionario)
    {
        $query = "insert into R000001(codigo,data,hora,cod_funcionario)values($mesa,'$data','$hora','$cod_funcionario')";
        $pdo =  $this->database->prepare($query);
        try
        {
            $pdo->execute();
            return $pdo->rowCount();

        }catch(PDOException $e)
        {
            dump($e->getMessage());
        }
    }
    public function mesasOcupadas()
    {
        $query = "select DISTINCT(cod_mesa) from R000002";
        $pdo =  $this->database->prepare($query);
        try
        {
            $pdo->execute();
            return $pdo->fetchAll();

        }catch(PDOException $e)
        {
            dump($e->getMessage());
        }
    }

    public function limpaMesa($cod_mesa)
    {
      $query = "delete from R000001 where codigo=$cod_mesa";
      $pdo = $this->database->prepare($query);
        try
        {
            $pdo->execute();
            if($pdo->rowCount() > 0)
            {
               $r = true;

            }else{
                $r = false;
            }

            $query2 = "delete from R000002 where cod_mesa=$cod_mesa";
            $pdo2 = $this->database->prepare($query2);
            try {
                $pdo2->execute();
                if ($pdo2->rowCount()) {
                    $r2 = true;
                }else{
                    $r2 =  false;
                }

            }catch(\PDOException $e)
            {dump($e->getMessage());}

            if($r = $r2)
            {return true;}
            else
            {return false;}

        }catch(\PDOException $e)
        {dump($e->getMessage());}
    }


}

?>