<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends CI_Model {

    var $table = 'purchase';
    var $column_order = array(null, 'purchase.id', 'smartpos_supplier.name', 'purchase.date', null);
    var $column_search = array('purchase.code', 'smartpos_supplier.name', 'purchase.date', 'purchase.datedue', 'purchase.status');
    var $order = array('purchase.id' => 'desc');

    public function __construct() {
        parent::__construct();
    }

    public function lastpurchase() {
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->tid;
        } else {
            return 1000;
        }
    }

    public function warehouses() {
        $this->db->select('*');
        $this->db->from('smartpos_warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('loc', 0);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function purchase_details($id) {

        $this->db->select('purchase.*,purchase.id AS iid,SUM(purchase.shipping + purchase.ship_tax) AS shipping,smartpos_supplier.*,smartpos_supplier.id AS cid,smartpos_terms.id AS termid,smartpos_terms.title AS termtit,smartpos_terms.terms AS terms');
        $this->db->from($this->table);
        $this->db->where('purchase.id', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('purchase.loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('purchase.loc', 0);
        } elseif (!BDATA) {
            $this->db->where('purchase.loc', 0);
        }
        $this->db->join('smartpos_supplier', 'purchase.csd = smartpos_supplier.id', 'left');
        $this->db->join('smartpos_terms', 'smartpos_terms.id = purchase.term', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function purchase_products($id) {
        $this->db->select('purchase_item.*');
        $this->db->select('x1.product_name, x1.product_code');
        
        $this->db->join('smartpos_products x1', 'x1.pid = purchase_item.product_id');
        $this->db->from('purchase_item');
        $this->db->where('tid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function purchase_transactions($id) {
        $this->db->select('*');
        $this->db->from('smartpos_transactions');
        $this->db->where('tid', $id);
        $this->db->where('ext', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function purchase_delete($id) {
        $this->db->trans_start();
        $this->db->select('pid,qty');
        $this->db->from('purchase_item');
        $this->db->where('tid', $id);
        $query = $this->db->get();
        $prevresult = $query->result_array();
        foreach ($prevresult as $prd) {
            $amt = $prd['qty'];
            $this->db->set('qty', "qty-$amt", FALSE);
            $this->db->where('pid', $prd['pid']);
            $this->db->update('smartpos_products');
        }
        $whr = array('id' => $id);
        if ($this->aauth->get_user()->loc) {
            $whr = array('id' => $id, 'loc' => $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $whr = array('id' => $id, 'loc' => 0);
        }
        $this->db->delete('purchase', $whr);
        if ($this->db->affected_rows())
            $this->db->delete('purchase_item', array('tid' => $id));
        if ($this->db->trans_complete()) {
            return true;
        } else {
            return false;
        }
    }

    private function _get_datatables_query($params = null) {
        $this->db->select('purchase.*,smartpos_supplier.name');
        $this->db->from($this->table);
        $this->db->join('smartpos_supplier', 'purchase.supplier_id=smartpos_supplier.id', 'left');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('purchase.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('purchase.loc', 0);
        }
        //if ($this->input->post('start_date') && $this->input->post('end_date')) { // if datatable send POST for search
        //    $this->db->where('DATE(purchase.invoicedate) >=', datefordatabase($this->input->post('start_date')));
        //    $this->db->where('DATE(purchase.invoicedate) <=', datefordatabase($this->input->post('end_date')));
        //}
        
        if($params['status'] != 0) 
            $this->db->where('purchase.posting', $params['status']);

        if($params['min'] != null && $params['max'] != null)
            $this->db->where('purchase.date BETWEEN "'. date('Y-m-d', strtotime($params['min'])). '" and "'. date('Y-m-d', strtotime($params['max'])).'"');

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
        $this->db->from($this->table);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('purchase.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('purchase.loc', 0);
        }
        return $this->db->count_all_results();
    }

    public function billingterms() {
        $this->db->select('id,title');
        $this->db->from('smartpos_terms');
        $this->db->where('type', 4);
        $this->db->or_where('type', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function currencies() {

        $this->db->select('*');
        $this->db->from('smartpos_currencies');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function currency_d($id) {
        $this->db->select('*');
        $this->db->from('smartpos_currencies');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function employee($id) {
        $this->db->select('smartpos_employees.name,smartpos_employees.sign,smartpos_users.roleid');
        $this->db->from('smartpos_employees');
        $this->db->where('smartpos_employees.id', $id);
        $this->db->join('smartpos_users', 'smartpos_employees.id = smartpos_users.id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function meta_insert($id, $type, $meta_data) {

        $data = array('type' => $type, 'rid' => $id, 'col1' => $meta_data);
        if ($id) {
            return $this->db->insert('smartpos_metadata', $data);
        } else {
            return 0;
        }
    }

    public function attach($id) {
        $this->db->select('smartpos_metadata.*');
        $this->db->from('smartpos_metadata');
        $this->db->where('smartpos_metadata.type', 4);
        $this->db->where('smartpos_metadata.rid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function meta_delete($id, $type, $name) {
        if (@unlink(FCPATH . 'userfiles/attach/' . $name)) {
            return $this->db->delete('smartpos_metadata', array('rid' => $id, 'type' => $type, 'col1' => $name));
        }
    }

}
