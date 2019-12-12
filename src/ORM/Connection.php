<?php


namespace JbSilva\ORM;

abstract class Connection
{
    public static $pdo;

    //método conexão abre a conexão com o Banco
    public static function init()
    {
        try {
            if (!isset(self::$pdo)) {
                self::$pdo = new \PDO(
                    getenv('DB_CONNECTION') . ':host=' . getenv('DB_HOST')
                    . ';dbname=' . getenv('DB_DATABASE') . ';charset=utf8',
                    getenv('DB_USERNAME'),
                    getenv('DB_PASSWORD'),
                    [\PDO::ATTR_PERSISTENT => true]
                );
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }

            return self::$pdo;
        } catch (PDOException $exc) {
            echo "ERRO: " . $exc->getMessage();
        }
    }//fim método conecta

    //método desconecta fecha a conexão com o Banco
    public function close()
    {
        if (isset(self::$pdo)) {
            self::$pdo = null;
        }
    }//fim metodo desconecta
}
