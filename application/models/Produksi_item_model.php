<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi_item_model extends CI_Model {
    
    var $table = 'smartpos_produksi_item';
    var $column_search = array('product_name');
    var $column_order = array('id');
    var $order = array('id' => 'desc');
    
    private function _get_datatables_query($id = null) {

        $this->db->select('smartpos_produksi_item.*'); //product_id, produksi_id, produksi_job_id,
        $this->db->select('x1.product_name, x1.product_code');
        $this->db->select('x3.name');
        $this->db->select('x4.date, x4.vehicle_id, x4.customer_id');

        $this->db->join('smartpos_products x1', 'x1.pid = smartpos_produksi_item.product_id');
        $this->db->join('smartpos_produksi_job x2', 'x2.id = smartpos_produksi_item.produksi_job_id');
        $this->db->join('smartpos_job x3', 'x3.id = x2.job_id');
        $this->db->join('smartpos_produksi x4', 'x4.id = smartpos_produksi_item.produksi_id');
        $this->db->from($this->table);
        if ($id != null) {
            $this->db->where('smartpos_produksi_item.produksi_job_id', $id);
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

    function get_datatable($id = null) {
        $this->db->from($this->table);
        if ($id != null) {
            $this->db->where('smartpos_produksi_item.produksi_job_id', $id);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function get_datatables($id = null) {
        $this->_get_datatables_query($id);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
    
    function count_filtered($id = null) {
        $this->_get_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_filtered_1($id = null) {
        //$this->_get_datatables_query($id);
        $this->db->where('produksi_job_id', $id);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all() {
        $this->db->select('smartpos_produksi_item.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }   
    
    public function movers($type = 0, $rid1 = 0, $rid2 = 0, $rid3 = 0, $note = '') {
        $data = array(
            'd_type' => $type,
            'rid1' => $rid1,
            'rid2' => $rid2,
            'rid3' => $rid3,
            'note' => $note
        );
        $this->db->insert('smartpos_movers', $data);
    }

    public function add($produksi_id, $produksi_job_id, $product_id, $mharga, $dharga, $harga, $qty, $indent){

        $subtotal = $harga * $qty;
        $data = array(
            'produksi_id' => $produksi_id,
            'produksi_job_id' => $produksi_job_id,
            'product_id' => $product_id,
            'mharga' => $mharga,
            'dharga' => $dharga,
            'harga' => $harga,
            'qty' => $qty,
            'indent' => $indent,
            'subtotal' => $subtotal
        );

        if ($this->db->insert($this->table, $data)) {
            //stok product decrease

                        
            $this->db->select('qty, product_name');
            $this->db->from('smartpos_products');
            $this->db->where('pid', $product_id);
            $query = $this->db->get();
            $r_n = $query->row_array();
            $product_name = $r_n['product_name'];

           // if ($r_n['qty'] != $qty) {
                $m_product_qty = 0;
                if ($qty >= $r_n['qty']) $m_product_qty =  $qty - $r_n['qty'];
                //f ($r_n['qty'] == $qty) $m_product_qty = 0;
                if ($qty <= $r_n['qty']) $m_product_qty = 0;

                $this->movers(1, $product_id, $m_product_qty, 0, 'Stock Changes');

                //update stok
                $data = array('qty' => $m_product_qty);
                $this->db->set($data);
                $this->db->where('pid', $product_id);
                if ($this->db->update('smartpos_products')) {
                    $this->aauth->applog("[Update Product] -$product_name  -Qty-$qty ID " . $product_id, $this->aauth->get_user()->username);
                                
                    echo json_encode(array('status' => 'Success', 'message' =>
                    $this->lang->line('ADDED')));
                }
           // }

        }else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function update($id, $produksi_id, $produksi_job_id, $product_id, $mharga, $dharga, $harga, $qty, $indent){
        $data = array(
            'produksi_id' => $produksi_id,
            'produksi_job_id' => $produksi_job_id,
            'product_id' => $product_id,
            'mharga' => $mharga,
            'dharga' => $dharga,
            'harga' => $harga,
            'qty' => $qty,
            'indent' => $indent
        );
        
        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->db->update($this->table)) {
            echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('ADDED')));
        }else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
}