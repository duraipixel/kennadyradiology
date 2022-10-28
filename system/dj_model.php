<?php 
error_reporting(0);
class DjModel {
    public $where;
    public $select;
    public $from;
    public $like;
    public $pdo_DB;
    public $group_by;
    public $having;
    public $order_by;
    public $join;
    public $where_In;
    public $where_raw;
    public $limit;
    public function __construct() {
        global $config;
        $this->where = [];
        $this->select = '';
        $this->from = '';
        $this->like = '';
        $this->join = '';
        $this->group_by = '';
        $this->having = '';
        $this->order_by = '';
        $this->where_In = '';
        $this->where_raw = '';
        $this->limit = '';
        $dsn = 'mysql:host=localhost;port='.$config['dbport'].';dbname='.$config['db_name'].'';
        
        $this->pdo_DB = new \PDO($dsn, $config['db_username'], $config['db_password']);
        $this->pdo_DB->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // print_r( $this->pdo_DB);die;
        
    }
    public function select($select) {
       $this->select = $select;
       return $this;
    } 

    public function from($table_name) {
        $this->from = ' from '.$table_name;
        return $this;
     } 

    public function whereRaw($query_string) {
        $this->where[] = ' ( '.$query_string .') ';
        return $this;
    }

    public function where($condition, $value = '') {
        $where = [];
        if( is_array($condition) && !empty( $condition ) && empty( $value) ) {
            foreach ($condition as $key => $value) {
                $where[] = $key." = '".$value."'";
            }
           
        } else if( is_string( $condition ) && !empty( $value ) ) {
            $where[]      = $condition ." = '".$value."'";
        }

        if( !empty( $where )  ) {
            $this->where[] = implode( ' and ', $where );
        }
        
        return $this;
    }

    public function whereNotEqual($condition) {
        $where = [];
        if( $condition ) {
            foreach ($condition as $key => $value) {
                $where[] = $key." != '".$value."'";
            }
        }
        if( !empty( $where )) {
            $this->where[] = implode( ' and ', $where );
        }
        return $this;
    }
    public function whereNotNull($column) {
        $this->where[] = $column .' IS NOT NULL';
        return $this;
    }

    public function whereNull($column) {
        $this->where[] = $column .' IS NULL';
        return $this;
    }

    public function whereDateBetween($condition) {
        $between = [];
        if( $condition ) {
            foreach ($condition as $key => $value) {
                $field  = $key;
                $dates = $value;
                if( $dates ) {
                    $between[] = $field." >= '".$dates[0]."'";
                    $between[] = $field." <= '".$dates[1]."'";
                }
            }
        }
        if( !empty( $between )) {
            $this->where[] = implode( ' and ', $between );
        }
        return $this;
    } 

    public function whereIN($field, $arr) {
        
        if( !empty( $arr )) {
            
            $this->where[] = $field .' IN ('.implode( ',', $arr ).')';
           
        }
        return $this;
    }

    public function groupBy($field){
        $this->group_by = 'group by '.$field;
        return $this;
    }

    public function havingRaw($query){
        $this->group_by .= ' HAVING '.$query;
        return $this;
    }

    public function orderBy($field, $order){
        $this->order_by = ' ORDER BY '.$field.' '.$order;
        return $this;
    }

    public function orderRaw($orderString){
        $this->order_by = ' ORDER BY '.$orderString;
        return $this;
    }

    public function like($like_arr) {
        $where = [];
        if( $like_arr ) {
            foreach ($like_arr as $key => $value) {
                $where[] = $key." Like '%".$value."%'";
            }
        }
        if( !empty( $where )) {
            $this->where[] = '('.implode( ' or ', $where ).')';
        }
        return $this;
    }

    public function join($foreign_table, $on_condition, $join_type = '') {
        //foreign table, foretata
        $this->join .= ' '.$join_type.' join '.$foreign_table.' on '.$on_condition;
        return $this;
    }
    public function limit($start, $length) {
        $this->limit .= ' Limit '.$start.','.$length;
        return $this;
    }

    public function get($show_query = '') {
        $where = '';
        if( !empty( $this->where ) ) {
            $where = implode( ' and ', $this->where );
            $where = ' where '.$where;
        }
        if( empty( $where ) && !empty( $this->where_In) ) {
            $where = ' where '.$this->where_In;
        } else if( ( !empty( $this->where_In ) ) ) {
            $where .= ' and ('.$this->where_In.' )';
        }
        $db_query = ($this->select ? ('select '.$this->select) : 'select * ').$this->from.$this->join.$where.' '.$this->group_by.$this->order_by.$this->limit;
        if( !empty( $show_query ) ) {
            echo $db_query; die;
        }        
        // echo $db_query;
        $result = $this->pdo_DB->query($db_query)->fetchAll(PDO::FETCH_OBJ);

        $this->select = '';
        $this->from = '';
        $this->like = '';
        $this->join = '';
        $this->limit = '';
        $this->group_by = '';
        $this->where_In = '';
        $this->where = [];
        $this->order_by = '';
        return $result;
    }

    public function count($show_query = '') {
        $where = '';
        if( !empty( $this->where ) ) {
            $where = implode( ' and ', $this->where );
            $where = ' where '.$where;
        }
       
        $db_query = ($this->select ? ('select '.$this->select) : 'select count(*) as count ').$this->from.$this->join.$where.' '.$this->group_by.$this->order_by.$this->limit;
        
        $result = $this->pdo_DB->query($db_query)->fetch();
        $this->select = '';
        $this->from = '';
        $this->like = '';
        $this->group_by = '';
        $this->limit = '';
        $this->join = '';
        $this->where = [];
        $this->order_by = '';
        return $result['count'];
    }

    public function first($show_query = '') {
        $where = '';
        if( !empty( $this->where ) ) {
            $where = implode( ' and ', $this->where );
            $where = ' where '.$where;
        }
        if( empty( $where ) && !empty( $this->where_In) ) {
            $where = ' where '.$this->where_In;
        } else if( ( !empty( $this->where_In ) ) ) {
            $where .= ' and ('.$this->where_In.' )';
        }
        
        $db_query = ($this->select ? ('select '.$this->select) : 'select * ').$this->from.$this->join.$where.' '.$this->group_by.$this->order_by.$this->limit;
        if( !empty( $show_query ) ) {
            echo $db_query; die;
        }   
        // echo $db_query; die;
        $result = $this->pdo_DB->query($db_query)->fetch(PDO::FETCH_OBJ);

        $this->select = '';
        $this->from = '';
        $this->like = '';
        $this->limit = '';
        $this->group_by = '';
        $this->join = '';
        $this->where_In = '';
        $this->where = [];
        $this->order_by = '';
        return $result;

    }

    public function insert($data = array(), $table)
    {
        
        $column = array_keys( $data );
        $column_value = [];
        if( isset( $column ) && !empty( $column ) ) {
            foreach ($column as $items ) {
                $column_value[] = ':'.$items;
            }
        }
		$columnField = implode( ',', $column);
        $columnValue = implode( ',', $column_value);
        $sql = "INSERT INTO $table ($columnField) VALUES ($columnValue)";
        $stmt= $this->pdo_DB->prepare($sql);
        $stmt->execute($data);
        return $this->pdo_DB->lastInsertId();

    }

    public function update($table, $update_data, $where ) {
        $fields = array_keys($update_data );
        $where_fields = array_keys($where );
        if( isset( $fields ) && !empty( $fields ) && isset( $where_fields ) && !empty( $where_fields ) ) {
            $flabels = [];
            foreach ($fields as $key => $value) {
                $flabels[] = $value.'=:'.$value;
            }
            if( !empty( $flabels ) ) {
                $update_data = array_merge($update_data, $where);
                // print_r( $update_data);die;
                $update_fields = implode(',', $flabels);
                $where_fields = $where_fields[0].'=:'.$where_fields[0];
                $sql = "UPDATE $table SET $update_fields WHERE $where_fields";
                $stmt= $this->pdo_DB->prepare($sql);

                $stmt->execute($update_data);
            }
        }
       
    }


}
