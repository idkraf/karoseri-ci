<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {
   
    /**
     * [total_currency description]
    * @param  [type] $column_name [description]
    * @param  [type] $where       [description]
    * @param  [type] $table_name  [description]
    * @return [type]              [description]
    */

    function total_count($column_name = null, $where = null, $table_name)
    {
        $this->db->select_sum($column_name);
        // If Where is not NULL
        if(!empty($where) && count($where) > 0 )
        {
            $this->db->where($where);
        }

        $this->db->from($table_name);

        // Return Count Column
        return $this->db->get()->row($column_name);//table_name array sub 0
    }
    
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function get_column($table, $data = null, $where = null)
    {
        $this->db->select($data);        
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->get()->row($data);//table_name array sub 0
    }


    public function getWhere($table, $where = null)
    {
        return $this->db->get_where($table, $where)->result_array();       
    }

    public function getIfExist($table, $where = null)
    {
        $this->db->where($where);
        $this->db->from($table);
        $query = $this->db->get();
        //$query = $this->db->get_where($table, $where)->result_array();
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function count_all($table, $where){
        //$this->db->select('smartpos_produksi.id');
        $this->db->where($where);
        $this->db->select($table.'id');
        $this->db->from($table);
        return $this->db->count_all_results();
    }
    public function count_filtered($table, $where){

        $this->db->where($where);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->num_rows();
    }
}