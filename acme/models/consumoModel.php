<?php
namespace acme\models;
use acme\models\Model;


class consumoModel extends Model
{
    protected $table = 'R000002';

    public function consumo($value)
    {
        $query = "select P.PRODUTO,R.CODIGO,R.COD_MESA,R.COD_PRODUTO,CAST(R.QTDE AS FLOAT) QTDE,CAST(UNITARIO AS FLOAT) UNITARIO,CAST(TOTAL AS FLOAT) TOTAL,CANCELADO
                    from R000002 R , c000025 P where r.cod_mesa=:pMesa and P.CODIGO=R.COD_PRODUTO";
        $pdo = $this->database->prepare($query);
        try {
            $pdo->bindParam(":pMesa", $value);
            $pdo->execute();
            return $pdo->fetchAll();

        } catch (PDOException $e) {
            dump($e->getMessage());
        }
    }

    public function geraCodigo()
    {
        $query = "select max(codigo) codigo from R000002";
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

    public function cancelaProduto($produto, $mesa)
    {
        $query = "update $this->table set cancelado=1 where cod_produto=$produto and cod_mesa=$mesa";
        $pdo = $this->database->prepare($query);
        try {
            $pdo->execute();
            if ($pdo->rowCount() == 1) {
                return true;
            } else {
                return false;
            }

        } catch (\PDOException $e) {
            dump($e->getMessage());
        }
    }


    public function readProduto()
    {
        $query = "select codigo,produto from c000025";
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

    public function findByProduto($id)
    {
        $query = "select codigo, produto, cast(precovenda as float) precovenda,unidade from c000025 where codigo='$id'";
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

    public function realizaPedido($produto,$preco,$qtde,$total,$mesa)
    {
        $query = "insert into R000002(cod_mesa,cod_produto,qtde,unitario,total,cancelado,status_imp) values($mesa,'$produto',$qtde,$preco,$total,0,1)";
        $pdo = $this->database->prepare($query);
        try
        {
            $pdo->execute();
          return  $pdo->rowCount();
        }catch(\PDOException $e)
        {dump($e->getMessage());}
    }

    public function readProdutoByGrupo($cod_grupo)
    {
        $query = "select codigo,produto from C000025 where codgrupo='$cod_grupo' order by produto;";

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

    public function readGrupos()
    {
        $query = "select codigo,grupo from C000017 order by grupo";
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

}
?>