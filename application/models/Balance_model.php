<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_model extends CI_Model {
    
    var $table = 'accounts';
    var $order = array('id' => 'desc');
    var $column_search = array('description');
    
    private function _get_datatables_query($params = null) {
        $this->select('accounts.*, ledger.*');
        $this->db->from($this->table);
        $this->db->join('ledger l', 'l.account_id == accounts_id');
        //if($params['account_id'] != null)
         //   $this->db->where('account_id', $params['account_id']);
        
        //if($params['min'] != null && $params['max'] != null)
        //$this->db->where('tanggal BETWEEN "'. date('Y-m-d', strtotime($params['min'])). '" and "'. date('Y-m-d', strtotime($params['max'])).'"');
        
        $i = 0;

        foreach ($this->column_search as $item) { // loop column
            if ($this->input->post('search')['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($id) {
        $params = array();
        $params['account_id'] = $id;
        $this->_get_datatables_query($params);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
    
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->select('accounts.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}