<?php namespace library\database;

/*
|------------------------------------------------------------------------------
| mysql driver
|------------------------------------------------------------------------------
*/

use PDO,PDOException,PDOStatement,Exception;

class pdodriver {

    static public function _connect( $confname ){
        static $pdo;
        if( ! $pdo[$confname] instanceof PDO){
            $conf = config( $confname );
            try{
                $pdo[$confname] = new PDO(
                    sprintf("%s:host=%s;prot=%s;dbname=%s;charset=%s",
                        $conf['type'],$conf['host'],$conf['port'],
                        $conf['name'],$conf['charset']),
                    $conf['user'],
                    $conf['pass']);
            }catch (PDOException $e){
                throw new Exception($e->getMessage());
            }

        }
        return $pdo[$confname];
    }
}

class mysql{
    private $prefix = '';
    private $param  = array();
    private $sql    = '';
    public  $table  = '';
    private $limit  = 100000;
    private $config = array();
    public function __construct( $tname = '' , $confname){
        $this->table = $tname;
        $this->config = $confname;
    }

    /**
     *
     * @param
     * @return
     */
    public function group($d){
        if(!$d) return $this;
        $this->param['group'] = $d;
        return $this;
    } // end func

    /**
     *
     * @param
     * @return
     */
    public function having($d){
        if(!$d) return $this;
        $this->param['having'] = $d;
        return $this;
    } // end func


    /**
     *
     * @param
     * @return
     */
    public function join($d){
        if(!$d) return $this;
        $this->param['join'] = $d;
        return $this;
    }

    /**
     *
     * @param
     * @return
     */
    public function order($d){
        if(!$d) return $this;
        $this->param['order'] = $d;
        return $this;
    } // end func

    /**
     *
     * @param
     * @return
     */
    public function field($d, $select = false){
        if(!$d) return $this;
        $this->param['field'] = $select ? $this->get_feild($d) : $d;
        return $this;
    } // end func

    /**
     *
     * @param
     * @return
     */
    public function limit($d){
        if(!$d) return $this;
        $this->param['limit'] = $d;
        return $this;
    } // end func

    /**
     *
     * @param
     * @return
     */
    public function where($d){
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
                        $s.=' AND `'.$k.'` BETWEEN \''.$v[1].'\' AND \''.$v[2].'\'';
                        break;
                    case 'NBTN' :
                        $s.=' AND `'.$k.'` NOT BETWEEN \''.$v[1].'\' AND \''.$v[2].'\'';
                        break;
                    case 'EXP':
                        $s.=' AND `'.$k.'` '.$v[1];
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
    public function first(){
        $sql = 'SELECT ';
        $sql.= $this->param['field'] ? $this->param['field'] : '*';
        $sql.= ' FROM '.$this->table;
        $sql.= $this->param['join']  ? ' '.$this->param['join'] : '';
        $sql.= $this->param['where'] ? ' WHERE '.$this->param['where'] : '';
        $sql.= $this->param['group'] ? ' GROUP BY '.$this->param['group'] : '';
        $sql.= $this->param['having'] ? ' HAVING '.$this->param['having'] : '';
        $sql.= $this->param['order'] ? ' ORDER BY '.$this->param['order'] : '';
        $sql.=' LIMIT 1';
        return $this->_query($sql)->fetch( PDO::FETCH_ASSOC );
    } // end func

    public function value( $f = false ){
        if(is_string($f)) return $this->first()[$f];
        else return false;
    }

    /**
     *  mysql select
     * @param
     * @return
     */
    public function select(){
        $sql = 'SELECT ';
        $sql.= $this->param['field'] ? $this->param['field'] : '*';
        $sql.= ' FROM '.$this->table;
        $sql.= $this->param['join']  ? ' '.$this->param['join'] : '';
        $sql.= $this->param['where'] ? ' WHERE '.$this->param['where'] : '';
        $sql.= $this->param['group'] ? ' GROUP BY '.$this->param['group'] : '';
        $sql.= $this->param['having'] ? ' HAVING '.$this->param['having'] : '';
        $sql.= $this->param['order'] ? ' ORDER BY '.$this->param['order'] : '';
        $sql.= $this->param['limit'] ? ' LIMIT '.$this->param['limit'] : ' LIMIT '.$this->limit;
        return $this->_query($sql)->fetchAll( PDO::FETCH_ASSOC );
    } // end func

    public function delete(){
        $sql = 'DELETE FROM '.$this->table;
        $sql.= $this->param['where'] ? ' WHERE '.$this->param['where'] : '';
        return $this->_exec($sql);
    }

    /**
     * mysql count
     * @param
     * @return
     */
    public function count(){
        $sql = 'SELECT COUNT(*) FROM '.$this->table;
        $sql.= $this->param['join']  ? ' '.$this->param['join'] : '';
        $sql.= $this->param['where'] ? ' WHERE '.$this->param['where'] : '';
        return $this->_query($sql)->fetchColumn();
    } // end func

    public function sum( $field ){
        $sql = 'SELECT SUM(`'.$field.'`) FROM '.$this->table;
        $sql.= $this->param['join']  ? ' '.$this->param['join'] : '';
        $sql.= $this->param['where'] ? ' WHERE '.$this->param['where'] : '';
        return $this->_query($sql)->fetchColumn();
    }

    /**
     * mysql update
     * @param
     * @return
     */
    public function save($pam){
        $upstr = 'UPDATE '.$this->table.' SET ';
        if(is_array($pam)){
            foreach($pam as $k => $v) {
                $upstr.='`'.$k.'`=\''.$v.'\',';
            }
            $upstr = substr($upstr,0,count($upstr)-2);
        }else $upstr.=$pam;
        $upstr.= ' WHERE '.$this->param['where'];
        return $this->_exec($upstr);
    } // end func

    public function inc($field, $value = false){
        $upstr = 'UPDATE '.$this->table.' SET ';
        if($value){
            $upstr.=$field.'='.$field.'+'.$value;
        }else{
            $upstr.=$field.'='.$field.'+1';
        }
        $upstr.= ' WHERE '.$this->param['where'];
        return $this->_exec($upstr);
    }

    public function dec($field, $value = false){
        $upstr = 'UPDATE '.$this->table.' SET ';
        if($value){
            $upstr.=$field.'='.$field.'-'.$value;
        }else{
            $upstr.=$field.'='.$field.'-1';
        }
        $upstr.= ' WHERE '.$this->param['where'];
        return $this->_exec($upstr);
    }

    public function last_sql(){
        return $this->sql;
    }

    public function get_feild($field = false){
        if(empty($field)) return '*';
        $columns = $this->_query('SHOW COLUMNS FROM '.$this->table)->fetchAll();
        $ret = [];
        $field = explode(',',$field);
        $count = count($columns);
        for($i=0;$i<$count;$i++){
            if(array_search($columns[$i]['Field'],$field) === false)
                $ret[] = '`'.$columns[$i]['Field'].'`';
        }
        return implode(',', $ret);
    }


    public function _query( $sql ){
        $this->sql = $sql;
        $this->param = [];
        $result = $this->_connect()->query($sql);
        $error  = $this->_connect()->errorInfo();
        if(!($error[0] == '00000')) throw new Exception($error[1].':'.$error[2]);
        return $result;
    }

    public function _exec( $sql ){
        $this->sql = $sql;
        $this->param = [];
        $result = $this->_connect()->exec($sql);
        $error  = $this->_connect()->errorInfo();
        if(!($error[0] == '00000')){
            dump($this->last_sql());
            throw new Exception($error[1].':'.$error[2]);
        }
        return $result;
    }

    public function _connect(){
        return pdodriver::_connect( $this->config );
    }

    /*
     * 启动事务
     * @access public
     * @return void
     */
    public function startTrans() {
        return $this->_connect()->beginTransaction();
    }

    /*
     * 提交事务
     * @access public
     * @return boolean
     */
    public function commit() {
        return $this->_connect()->commit();
    }

    /*
     * 事务回滚
     * @access public
     * @return boolean
     */
    public function rollback() {
        return $this->_connect()->rollBack();
    }
}
