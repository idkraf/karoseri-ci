<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stockreturn_model extends CI_Model {

    var $table = 'smartpos_stock_r';
    var $column_order = array(null, 'smartpos_stock_r.tid', 'name', 'smartpos_stock_r.invoicedate', 'smartpos_stock_r.total', 'smartpos_stock_r.status', null);
    var $column_search = array('smartpos_stock_r.tid', 'name', 'smartpos_stock_r.invoicedate', 'smartpos_stock_r.total', 'smartpos_stock_r.status');
    var $order = array('smartpos_stock_r.tid' => 'desc');

    public function __construct() {
        parent::__construct();
    }

    public function lastpurchase() {
        $this->db->select('tid');
        $this->db->from($this->table);
        $this->db->order_by('tid', 'DESC');
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

    public function currencies() {

        $this->db->select('*');
        $this->db->from('smartpos_currencies');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function purchase_details($id) {

        $this->db->select('smartpos_stock_r.i_class');
        $this->db->from($this->table);
        $this->db->where('smartpos_stock_r.id', $id);
        $query = $this->db->get();
        $out = $query->row_array();

        if ($out['i_class']) {
            $this->db->select('smartpos_stock_r.*,smartpos_stock_r.id AS iid,SUM(smartpos_stock_r.shipping + smartpos_stock_r.ship_tax) AS shipping,smartpos_customers.*,smartpos_stock_r.loc as loc,smartpos_customers.id AS cid,smartpos_terms.id AS termid,smartpos_terms.title AS termtit,smartpos_terms.terms AS terms');
            $this->db->from($this->table);
            $this->db->where('smartpos_stock_r.id', $id);
            $this->db->join('smartpos_customers', 'smartpos_stock_r.csd = smartpos_customers.id', 'left');
            $this->db->join('smartpos_terms', 'smartpos_terms.id = smartpos_stock_r.term', 'left');
            if ($this->aauth->get_user()->loc) {
                $this->db->where('smartpos_stock_r.loc', $this->aauth->get_user()->loc);
            } elseif (!BDATA) {
                $this->db->where('smartpos_stock_r.loc', 0);
            }
            $query = $this->db->get();
            return $query->row_array();
        } else {

            $this->db->select('smartpos_stock_r.*,smartpos_stock_r.id AS iid,SUM(smartpos_stock_r.shipping + smartpos_stock_r.ship_tax) AS shipping,smartpos_supplier.*,smartpos_stock_r.loc as loc,smartpos_supplier.id AS cid,smartpos_terms.id AS termid,smartpos_terms.title AS termtit,smartpos_terms.terms AS terms');
            $this->db->from($this->table);
            $this->db->where('smartpos_stock_r.id', $id);
            $this->db->join('smartpos_supplier', 'smartpos_stock_r.csd = smartpos_supplier.id', 'left');
            $this->db->join('smartpos_terms', 'smartpos_terms.id = smartpos_stock_r.term', 'left');
            if ($this->aauth->get_user()->loc) {
                $this->db->where('smartpos_stock_r.loc', $this->aauth->get_user()->loc);
            } elseif (!BDATA) {
                $this->db->where('smartpos_stock_r.loc', 0);
            }
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    public function purchase_products($id) {

        $this->db->select('*');
        $this->db->from('smartpos_stock_r_items');
        $this->db->where('tid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function purchase_transactions($id) {

        $this->db->select('*');
        $this->db->from('smartpos_transactions');
        $this->db->where('tid', $id);
        $this->db->where('ext', 6);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function purchase_delete($id) {

        $this->db->trans_start();

        $this->db->select('pid,qty');
        $this->db->from('smartpos_stock_r_items');
        $this->db->where('tid', $id);
        $query = $this->db->get();
        $prevresult = $query->result_array();

        $this->db->select('i_class');
        $this->db->from('smartpos_stock_r');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $stock = $query->row_array();
        if (($stock['i_class'] != 2 && $this->aauth->premission(2)) OR ($stock['i_class'] == 2 && $this->aauth->premission(1))) {
            foreach ($prevresult as $prd) {
                $amt = $prd['qty'];
                $this->db->set('qty', "qty+$amt", FALSE);
                $this->db->where('pid', $prd['pid']);
                $this->db->update('smartpos_products');
            }
            $whr = array('id' => $id);
            if ($this->aauth->get_user()->loc) {
                $whr = array('id' => $id, 'loc' => $this->aauth->get_user()->loc);
            }
            $this->db->delete('smartpos_stock_r', $whr);
            if ($this->db->affected_rows())
                $this->db->delete('smartpos_stock_r_items', array('tid' => $id));
            if ($this->db->trans_complete()) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function _get_datatables_query($type = 0) {
        if ($type) {

            $this->db->select('smartpos_stock_r.id,smartpos_stock_r.tid,smartpos_stock_r.invoicedate,smartpos_stock_r.invoiceduedate,smartpos_stock_r.total,smartpos_stock_r.status,smartpos_customers.name');
            $this->db->from($this->table);
            $this->db->where('smartpos_stock_r.i_class', $type);
            $this->db->join('smartpos_customers', 'smartpos_stock_r.csd=smartpos_customers.id', 'left');
            if ($this->aauth->get_user()->loc) {
                $this->db->where('smartpos_stock_r.loc', $this->aauth->get_user()->loc);
            } elseif (!BDATA) {
                $this->db->where('smartpos_stock_r.loc', 0);
            }
        } else {
            $this->db->select('smartpos_stock_r.id,smartpos_stock_r.tid,smartpos_stock_r.invoicedate,smartpos_stock_r.invoiceduedate,smartpos_stock_r.total,smartpos_stock_r.status,smartpos_supplier.name');
            $this->db->from($this->table);
            $this->db->where('smartpos_stock_r.i_class', $type);
            $this->db->join('smartpos_supplier', 'smartpos_stock_r.csd=smartpos_supplier.id', 'left');
            if ($this->aauth->get_user()->loc) {
                $this->db->where('smartpos_stock_r.loc', $this->aauth->get_user()->loc);
            } elseif (!BDATA) {
                $this->db->where('smartpos_stock_r.loc', 0);
            }
        }
        if ($this->input->post('start_date') && $this->input->post('end_date')) { // if datatable send POST for search
            $this->db->where('DATE(smartpos_stock_r.invoicedate) >=', datefordatabase($this->input->post('start_date')));
            $this->db->where('DATE(smartpos_stock_r.invoicedate) <=', datefordatabase($this->input->post('end_date')));
        }
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

    function get_datatables($type = 0) {
        $this->_get_datatables_query($type);
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
            $this->db->where('smartpos_stock_r.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_stock_r.loc', 0);
        }
        return $this->db->count_all_results();
    }

    public function billingterms() {
        $this->db->select('id,title');
        $this->db->from('smartpos_terms');
        $query = $this->db->get();
        return $query->result_array();
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
