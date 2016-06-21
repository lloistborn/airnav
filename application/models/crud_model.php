<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {
    public function __construct() {
         parent::__construct();
    }

    public function list_field($table) {
        return $this->db->list_fields($table);
    } 
    
    public function list_data_fields($table) {
        return $this->db->field_data($table);
    }
    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    public function edit($table, $data, $id_field, $param, $limit = FALSE) {
        if($limit)
            $this->db->limit(1);
        $this->db->where($id_field, $param);
        return $this->db->update($table, $data);
    }
    public function edit_where($table, $data, $data_param, $limit = FALSE) {
        if($limit)
            $this->db->limit(1);
        $this->db->where($data_param);
        return $this->db->update($table, $data);
    }
    
    public function delete($table, $id_field, $param) {
        $this->db->where($id_field, $param);
        return $this->db->delete($table);
    }

    public function get_all($table) {
        return $this->db->get($table);
    }

    public function get_perpage($table, $id_field, $start, $perpage) {
        $this->db->limit($perpage, $start);
        $this->db->order_by($id_field, 'desc');
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }

    public function get_autocomplete($table, $id_field) {
        $this->db->select($id_field);
        $this->db->order_by($id_field, 'asc');
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }

    public function get_where($table, $array_field, $limit=null, $order_field=null)
    {
        if($order_field) $this->db->order_by($order_field, 'asc');
        
        if($limit) {
            $this->db->limit(1);
            $query = $this->db->get_where($table, $array_field);
            // var_dump($this);
            return $query->row_array();
        }
        $query = $this->db->get_where($table, $array_field);
        return $query->result();
    }

    public function detail($table, $id_field, $param) {
        $this->db->where($id_field, $param);
        $query = $this->db->get($table);
        if($query->num_rows() > 0) {
            return $query->row();
        }
        return array();
    }   

    /* 
    select only one row in multiple field 

    when field selected only one, just use string as param in $fields
    ex: fields = 'account_username';

    but when field selected > 1 , then init fields with array
    ex: fields = ['account_username', 'account_password', ...]; 
    
    return value only one record
    */
    public function detail_field($fields, $table, $id_field, $param) {  

        $field = $fields;

        if(count($fields) > 1) 
            $field = implode(',', $fields);
        
        $this->db->select($field);
        $this->db->limit(1);
        $this->db->from($table);
        $this->db->where($id_field, $param);

        $query = $this->db->get();

        // echo "<pre>";
        // print_r($this->db->last_query()); 
        // print_r($query);

        if($query->num_rows() > 0) {
            return $query->row();
        }
        return false; 
    }

    /* 
    select only one row in multiple field join with multiple table

    when field selected only one, just use string as param in $fields
    ex: fields = 'account_username';

    but when field selected > 1 , then init fields with array
    ex: fields = ['account_username', 'account_password', ...]; 
    
    return value only one record
    */
    public function detail_field_join($fields, $table, $joined_table, $onjoin, $id_field, $param) {  

        $field = $fields;
        if(count($fields) > 1) 
            $field = implode(',', $fields);

        $this->db->select($field);
        $this->db->limit(1);
        $this->db->from($table);
        $this->db->join($joined_table, $onjoin);
        $this->db->where($id_field, $param);

        $query = $this->db->get();

        print_r($this->db->last_query());

        if($query->num_rows() > 0) {
            return $query->row();
        }
        return false; 
    }

    public function count_result($table) {
        return $this->db->count_all_results($table);
    }
    
    public function searching($table, $id_field, $param, $limit=0, $offset=0) {
        $this->db->like($id_field, $param);
        $list_header = $this->list_field($table);
        foreach($list_header as $row_field) {
            $this->db->or_like($row_field,$param);          
        }
        if($limit==0 && $offset==0) {
            $count = $this->db->get($table);
            return $count->num_rows();
        }
        else {
            return $this->db->get($table, $limit, $offset);
        }
    }
}