<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_payment_model extends CI_Model {

    var $table = 'purchase_payment';
    var $column_order = array(null, 'purchase_payment.id', 'smartpos_supplier.name', 'purchase.date', null);
    var $column_search = array('purchase_payment.code', 'purchase.code', 'smartpos_supplier.name', 'purchase.date', 'purchase.datedue', 'purchase.status');
    var $order = array('purchase_payment.idp' => 'desc');

    public function __construct() {
        parent::__construct();
    }

    public function purchase_details($id) {

        //$this->db->select('purchase.*,purchase.id AS iid,SUM(purchase.shipping + purchase.ship_tax) AS shipping,smartpos_supplier.*,smartpos_supplier.id AS cid,smartpos_terms.id AS termid,smartpos_terms.title AS termtit,smartpos_terms.terms AS terms');
        
        $this->db->select('purchase.*,purchase.id AS iid,smartpos_supplier.*,smartpos_supplier.id AS cid');
        $this->db->from($this->table);
        $this->db->where('purchase.id', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('purchase.loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('purchase.loc', 0);
        } elseif (!BDATA) {
            $this->db->where('purchase.loc', 0);
        }
        $this->db->join('purchase p', 'p.id = purchase_payment.purchase_id', 'left');
        $this->db->join('smartpos_supplier', 'smartpos_supplier.id = p.supplier_id', 'left');
        //$this->db->join('smartpos_terms', 'smartpos_terms.id = purchase.term', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    private function _get_datatables_query($params = null) {
        $this->db->select('purchase_payment.*');
        $this->db->select('p.*');
        $this->db->select('s.name');
        $this->db->select('a.name as aname');
        $this->db->from($this->table);
        $this->db->join('accounts a', 'a.id = purchase_payment.account_id');
        $this->db->join('purchase p', 'p.id = purchase_payment.purchase_id');
        $this->db->join('smartpos_supplier s', 's.id = p.supplier_id', 'left');
        
        if($params['name'] != 0) 
            $this->db->like('name', $params['name']);
        

        if($params['status'] != 0) 
            $this->db->where('purchase_payment.status', $params['status']);

        if($params['min'] != 0 && $params['max'] != 0)
            $this->db->where('purchase_payment.date BETWEEN "'. date('Y-m-d', strtotime($params['min'])). '" and "'. date('Y-m-d', strtotime($params['max'])).'"');

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

    function get_datatables($search, $min, $max, $posting, $paging) {
        $params = array();
        $params['name'] = $search;
        $params['min'] = $min;
        $params['max'] = $max;
        $params['status'] = $posting;
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}
