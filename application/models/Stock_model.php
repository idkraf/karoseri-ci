<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

    var $table = 'opname';
    var $order = array('id' => 'desc');
    var $column_search = array('name');
    
    private function _get_datatables_query($params = null) {

        $this->db->select('opname.*');
        $this->db->select('x1.product_name, x1.product_code, x1.product_qty');
        $this->db->join('smartpos_products x1', 'x1.pid = opname.product_id');
        $this->db->from($this->table);
        $i = 0;
        if($params != null){
            $this->db->where($params);
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

    function get_datatables($id) {
        $params = array();
        $params['product_id'] = $id;

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
        $this->db->select('opname.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function stock_r(){
        $data = array(
            'tid' => $invocieno, 
            'invoicedate' => $bill_date, 
            'invoiceduedate' => $bill_due_date, 
            'subtotal' => $subtotal, 
            'shipping' => $shipping, 
            'ship_tax' => $shipping_tax, 
            'ship_tax_type' => $ship_taxtype, 
            'total' => $total, 
            'notes' => $notes, 
            'csd' => $customer_id, 
            'eid' => $this->aauth->get_user()->id, 
            'taxstatus' => $tax, 
            'discstatus' => $discstatus, 
            'format_discount' => $discountFormat, 
            'refer' => $refer, 
            'term' => $pterms, 
            'loc' => $this->aauth->get_user()->loc, 
            'i_class' => $person_type, 
            'multi' => $currency,
        );
        if ($this->db->insert('smartpos_stock_r', $data)) {
        
        }
    }
    
    public function stock_transaksi(){
        //get data account from accounts_config for inventory
        //id:14 name:sop_opname_inventory account_id:34
        
        $data = array(
            'acid' => $acid,
            'account' => $account['holder'],
            'type' => 'Income',
            'cat' => 'Purchase',
            'credit' => $amount,
            'payer' => $cname,
            'payerid' => $cid,
            'method' => $pmethod,
            'date' => $paydate,
            'eid' => $this->aauth->get_user()->id,
            'tid' => $tid,
            'note' => $note,
            'ext' => 6
        );
        $this->db->insert('smartpos_transactions', $data);
    }
}