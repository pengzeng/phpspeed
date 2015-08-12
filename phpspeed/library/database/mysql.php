<?php namespace Library\database;


use PDO,PDOException,PDOStatement;

trait mysql {

    private static $_mysql = null;
    private static $_prefix    = '';
    private function _mysql_connection(){
        if( ! self::$_mysql instanceof PDO){
            $conf = config('mysql') + [
                    'type'    => 'mysql',
                    'host'    => '127.0.0.1',
                    'port'    => '3306',
                    'user'    => 'root',
                    'pass'    => '',
                    'name'    => 'test',
                    'charset' => 'utf8',
                    'prefix'  => ''
                ];
            self::$_prefix = $conf['prefix'];
            try{
                self::$_mysql = new PDO(
                    sprintf("%s:host=%s;prot=%s;dbname=%s;charset=%s",
                        $conf['type'],$conf['host'],$conf['port'],
                        $conf['name'],$conf['charset']),
                    $conf['user'],
                    $conf['pass']);
            }catch (PDOException $e){
                \Library\template::view(ERROR_DEBUG, [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine()
                ]);
            }

        }
        return self::$_mysql;
    }
}