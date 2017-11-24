<?php
/**
 * Created by PhpStorm.
 * User: Caio Almeida
 * Date: 12/02/2016
 * Time: 14:33
 */

namespace acme\database;
use PDO;


class Connection{

    const INIFILE = './config/database.ini';
    private $iniData;

    public function __construct()
    {
        $this->iniData = parse_ini_file(self::INIFILE);

    }

    public function connection()
    {
        if($this->iniData['driver'] == 'mysql')
        {
         $pdo = new PDO($this->iniData['driver'] . ':host=' . $this->iniData['host'] . ';dbname=' . $this->iniData['database'], $this->iniData['username'], $this->iniData['password']);
        }
        if($this->iniData['driver']=='firebird')
        {
            $pdo = new PDO($this->iniData['driver'] . ':dbname=' . $this->iniData['database'] . ';host=' . $this->iniData['host'], $this->iniData['username'], $this->iniData['password']);
            $pdo->setAttribute(PDO::FB_ATTR_TIMESTAMP_FORMAT, '%s');
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

        return $pdo;
    }

}
?>