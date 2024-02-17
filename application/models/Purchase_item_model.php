<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_item_model extends CI_Model {

    var $table = 'purchase_item';
    var $order = array('id' => 'desc');
    var $column_search = array('name');
    
    private function _get_datatables_query($params = null) {

        $this->db->select('purchase_item.*');
        $this->db->select('x1.product_name, x1.product_code');
        $this->db->select('x2.code, x2.date');
        $this->db->select('x3.name');
        $this->db->select('x4.title');

        $this->db->join('smartpos_products x1', 'x1.pid = purchase_item.product_id');
        $this->db->join('purchase x2', 'x2.id = purchase_item.tid');
        $this->db->join('smartpos_supplier x3', 'x3.id = x2.supplier_id', 'left');
        $this->db->join('smartpos_product_cat x4', 'x4.id = x1.pcat', 'left');

        $this->db->from($this->table);
        $i = 0;
       // if($params!=null) $this->db->where('tid',$params);
        
        if ($this->input->post('status')) {
            $this->db->where('purchase_item.indent >', '1');
        }
        
        if ($this->input->post('tid')) {
            $this->db->where('purchase_item.tid', $this->input->post('tid'));
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

    function get_datatables($tid = null) {
        $params = array();
        $params['tid'] = $tid;
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
        $this->db->select('purchase_item.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function purchase_products($id) {

        $this->db->select('purchase_item.*');
        $this->db->select('x1.product_name, x1.product_code');

        $this->db->join('smartpos_products x1', 'x1.pid = purchase_item.product_id');
        $this->db->from('purchase_item');
        $this->db->where('purchase_item.tid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

}