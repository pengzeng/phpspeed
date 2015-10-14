<?php namespace library\database;

/*
|------------------------------------------------------------------------------
| mysql driver
|------------------------------------------------------------------------------
*/

use PDO,PDOException,PDOStatement;

trait pdodriver {

    private function _connect(){
        static $pdo;
        if( ! $pdo instanceof PDO){
            $conf = config('mysql') + [
                    'type'    => 'mysql',
                    'host'    => '127.0.0.1',
                    'port'    => '3306',
                    'user'    => 'root',
                    'pass'    => '',
                    'name'    => 'test',
                    'charset' => 'utf8'
                ];
            try{
                $pdo = new PDO(
                    sprintf("%s:host=%s;prot=%s;dbname=%s;charset=%s",
                        $conf['type'],$conf['host'],$conf['port'],
                        $conf['name'],$conf['charset']),
                    $conf['user'],
                    $conf['pass']);
            }catch (PDOException $e){
                \Library\exception::outerror(404, [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine()
                ]);
            }

        }
        return $pdo;
    }

    private function _query( $sql ){
        return $this->_connect()->query($sql);
    }

    private function _exec( $sql ){
        return $this->_connect()->exec($sql);
    }
}

class mysql{
    use pdodriver;
    private $prefix = '';
    private $param  = [];
    private $sql    = '';
    public  $table  = '';
    private $base   = [
        'field' => false,
        'where' => false,
        'group' => false,
        'order' => false,
        'limit' => false,
    ];
    private $limit  = 10000;
    private $config = [];
    public function __construct( $tname = '' ){
        $this->table = $tname;
    }

    /**
     *
     * @param
     * @return
     */
    function group($d){
        if(!$d) return $this;
        $this->param['group'] = $d;
        return $this;
    } // end func
    /**
     *
     * @param
     * @return
     */
    function order($d){
        if(!$d) return $this;
        $this->param['order'] = $d;
        return $this;
    } // end func

    /**
     *
     * @param
     * @return
     */
    function field($d){
        if(!$d) return $this;
        $this->param['field'] = $d;
        return $this;
    } // end func

    /**
     *
     * @param
     * @return
     */
    function limit($d){
        if(!$d) return $this;
        $this->param['limit'] = $d;
        return $this;
    } // end func

    /**
     *
     * @param
     * @return
     */
    function where($d){
        $s = '';
        if( ! ( is_string($d) || is_array($d) ) ){
            return $this;
        }
        if(is_string($d)) {
            $s.= $d;
            $this->param['where'] = $s;
            return $this;
        }
        foreach($d as $k => $v) {
            if(is_array($v)){
                switch(strtoupper($v[0])){
                    case 'OR' :
                        $s.=' AND `'.$k.'`=\''.$v[1].'\' OR `'.$k.'`=\''.$v[2].'\'';
                        break;
                    case 'IN' :
                        $s.=' AND `'.$k.'` IN('.$v[1].')';
                        break;
                    case 'NOTIN' :
                        $s.=' AND `'.$k.'` NOT IN('.$v[1].')';
                        break;
                    case 'GT' :
                        $s.=' AND `'.$k.'`>\''.$v[1].'\'';
                        break;
                    case 'EGT' :
                        $s.=' AND `'.$k.'`>=\''.$v[1].'\'';
                        break;
                    case 'LT' :
                        $s.=' AND `'.$k.'`<\''.$v[1].'\'';
                        break;
                    case 'ELT' :
                        $s.=' AND `'.$k.'`<=\''.$v[1].'\'';
                        break;
                    case 'NEQ' :
                        $s.=' AND `'.$k.'`<>\''.$v[1].'\'';
                        break;
                    case 'LIKE' :
                        $s.=' AND `'.$k.'` LIKE \''.$v[1].'\'';
                        break;
                    case 'BTN' :
                        $s.=' AND `'.$k.'` BETWEEN \''.$v[1].'\' AND '.$v[2].'\'';
                        break;
                    case 'NBTN' :
                        $s.=' AND `'.$k.'` NOT BETWEEN \''.$v[1].'\' AND '.$v[2].'\'';
                        break;
                    case 'EXP':
                        $s.=' AND `'.$k.'` '.$v[1].'\'';
                        break;
                }
            }else{
                $s.=' AND `'.$k.'`=\''.$v.'\'';
            }
        }
        $this->param['where'] = substr($s,4);
        return $this;
    } // end func

    /**
     * mysql add
     * @param
     * @return
     */
    public function insert($d, $ignore = false){
        $sql = $ignore ? 'INSERT IGNORE INTO '.$this->table : 'INSERT INTO '.$this->table;
        $field = '';
        $value = '';
        foreach($d as $k => $v) {
            if (empty($field)) {
                $field = '`'.$k.'`';
                $value = '\''.$v.'\'';
            }else {
                $field .= ',`'.$k.'`';
                $value .= ',\''.$v.'\'';
            }
        }
        $sql.=' ('.$field.')'.' VALUES('.$value.')';
        return $this->_exec($sql) ? $this->_connect()->lastInsertId() : false;
    } // end func

    /**
     * mysql first
     * @param
     * @return
     */
    function first($d = false){
        $sql = 'SELECT ';
        $sql.= $this->param['field'] ? $this->param['field'] : '*';
        $sql.= ' FROM '.$this->table;
        if ($d) {
            $sql.= ' WHERE id='.$d;
        }elseif($this->param['where']) {
            $sql.= ' WHERE '.$this->param['where'];
            $sql.= $this->param['group'] ? ' GROUP BY '.$this->param['group'] : '';
            $sql.= $this->param['order'] ? ' ORDER BY '.$this->param['order'] : '';
        }
        $sql.=' LIMIT 1';
        return $this->_query($sql)->fetch( PDO::FETCH_ASSOC );
    } // end func


    /**
     *  mysql select
     * @param
     * @return
     */
    function select(){
        $sql = 'SELECT ';
        $sql.= $this->param['field'] ? $this->param['field'] : '*';
        $sql.= ' FROM '.$this->table;
        $sql.= $this->param['where'] ? ' WHERE '.$this->param['where'] : '';
        $sql.= $this->param['group'] ? ' GROUP BY '.$this->param['group'] : '';
        $sql.= $this->param['order'] ? ' ORDER BY '.$this->param['order'] : '';
        $sql.= $this->param['limit'] ? ' LIMIT '.$this->param['limit'] : ' LIMIT '.$this->limit;
        return $this->_query($sql)->fetchAll( PDO::FETCH_ASSOC );
    } // end func


    /**
     * mysql count
     * @param
     * @return
     */
    function count(){
        $sql = 'SELECT COUNT(*) FROM '.$this->table;
        $sql.= $this->param['where'] ? ' WHERE '.$this->param['where'] : '';
        return $this->_query($sql)->fetchColumn();
    } // end func


    /**
     * mysql update
     * @param
     * @return
     */
    function save($pam){
        $upstr = 'UPDATE '.$this->table.' SET ';
        foreach($pam as $k => $v) {
            $upstr.='`'.$k.'`=\''.$v.'\',';
        }
        $upstr = substr($upstr,0,count($upstr)-2);
        $upstr.= ' WHERE '.$this->param['where'];
        return $this->_exec($upstr);
    } // end func

    function inc($field, $value = false){
        $upstr = 'UPDATE '.$this->table.' SET ';
        if($value){
            $upstr.=$field.'='.$field.'+'.$value;
        }else{
            $upstr.=$field.'='.$field.'+1';
        }
        $upstr.= ' WHERE '.$this->param['where'];
        return $this->_exec($upstr);
    }

    function dec($field, $value = false){
        $upstr = 'UPDATE '.$this->table.' SET ';
        if($value){
            $upstr.=$field.'='.$field.'-'.$value;
        }else{
            $upstr.=$field.'='.$field.'-1';
        }
        $upstr.= ' WHERE '.$this->param['where'];
        return $this->_exec($upstr);
    }

}
