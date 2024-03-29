<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stockout_model extends CI_Model {

    var $table = 'stockout';
    var $order = array('id' => 'desc');
    var $column_search = array('name');
    
    private function _get_datatables_query($params = null) {

        $this->db->select('stockout.*');
        $this->db->select('x1.product_name, x1.product_code');
        $this->db->select('x2.name as jname');
        $this->db->select('x3.name as cname');
        $this->db->select('x4.code as pcode, x4.date');
        $this->db->select('x5.name as vname');

        $this->db->join('smartpos_products x1', 'x1.pid = stockout.product_id');
        $this->db->join('smartpos_job x2', 'x2.id = stockout.job_id');
        $this->db->join('smartpos_customers x3', 'x3.id = stockout.customer_id');
        $this->db->join('smartpos_produksi x4', 'x4.id = stockout.produksi_id');
        $this->db->join('smartpos_vehicle x5', 'x5.id = stockout.vehicle_id');

        $this->db->from($this->table);
        $i = 0;
        
        if($params['status'] != 0) 
        $this->db->where('opname.status', $params['status']);

        //if($params['min'] != null && $params['max'] != null)
         //   $this->db->where('tanggal BETWEEN "'. date('Y-m-d', strtotime($params['min'])). '" and "'. date('Y-m-d', strtotime($params['max'])).'"');

        if ($this->input->post('min') && $this->input->post('max')) { // if datatable send POST for search
            $this->db->where('DATE(stockout.tanggal) >=', datefordatabase($this->input->post('min')));
            $this->db->where('DATE(stockout.tanggal) <=', datefordatabase($this->input->post('max')));
        }
        

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

    function get_datatables($min, $max, $st) {
        $params = array();
        $params['min'] = $min;
        $params['max'] = $max;
        $params['status'] = $st;

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
        $this->db->select('stockout.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}