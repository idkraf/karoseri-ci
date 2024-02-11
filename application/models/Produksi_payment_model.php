<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi_payment_model extends CI_Model {
    
    var $table = 'smartpos_produksi_payment';
    var $column_search = array('name');
    var $column_order = array(null, 'code', 'date', 'total', null);
    //var $column_search = array('code', 'valid', 'amount');
    var $order = array('id' => 'desc');
    
    private function _get_datatables_query() {

        $this->db->select('smartpos_produksi_payment.*');
        $this->db->select('x1.name, x1.phone');
        $this->db->select('x2.name as vname');
        $this->db->join('smartpos_customers x1', 'x1.id = smartpos_produksi_payment.customer_id');
        $this->db->join('smartpos_vehicle x2', 'x2.id = smartpos_produksi_payment.vehicle_id');
        $this->db->from($this->table);
        $i = 0;

        if ($this->input->post('min') && $this->input->post('max')) { // if datatable send POST for search
            $this->db->where('DATE(smartpos_produksi_payment.date) >=', datefordatabase($this->input->post('min')));
            $this->db->where('DATE(smartpos_produksi_payment.date) <=', datefordatabase($this->input->post('max')));
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

    function get_datatables() {
        $this->_get_datatables_query();
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
        $this->db->select('smartpos_produksi_payment.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}