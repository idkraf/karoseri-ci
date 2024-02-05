<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi_model extends CI_Model {
    
    var $table = 'smartpos_produksi';
    var $column_search = array('name');
    var $column_order = array(null, 'code', 'date', 'total', null);
    //var $column_search = array('code', 'valid', 'amount');
    var $order = array('id' => 'desc');
    
    private function _get_datatables_query() {

        $this->db->select('smartpos_produksi.*');
        $this->db->select('x1.name, x1.phone');
        $this->db->select('x2.name as vname');
        $this->db->join('smartpos_customers x1', 'x1.id = smartpos_produksi.customer_id');
        $this->db->join('smartpos_vehicle x2', 'x2.id = smartpos_produksi.vehicle_id');
        $this->db->from($this->table);
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
        $this->db->select('smartpos_produksi.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    

    public function add($code, $date, $datedue, $customer_id, $vehicle_id, $template_id, $price, $disc, $bbn, $tax, $taxppn, $total, $totale){
        $data = array(
            'code' => $code,
            'date' => $date,
            'datedue' => $datedue,
            'customer_id' => $customer_id,
            'vehicle_id' => $vehicle_id,
            'template_id' => $template_id,
            'price' => $price,
            'disc' => $disc,
            'bbn' => $bbn,
            'tax' => $tax,
            'taxppn' => $taxppn,
            'total' => $total,
            'totale' => $totale,
        );
        //if($template_id!=0){
        //    $data['template_id'] = $template_id;
        //}

        if ($this->db->insert($this->table, $data)) {
            $id = $this->db->insert_id();
            if($template_id != 0){
                $this->cloneJobTemplate($id, $template_id);
            }
            
            echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('ADDED')));
        }else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
    
    public function cloneJobTemplate($id, $template_id){
        $query = $this->db->where('template_id', $template_id)->get('smartpos_template_job');
        foreach ($query->result() as $row) {           
           // $this->db->where('produksi_id', $row->produksi_id)->update('smartpos_produksi_job', $row); // To update existing record
           $data = array();
           $data['produksi_id'] = $id;
           $data['job_id'] = $row->job_id;
           $data['que'] = $row->que;
           $data['day'] = $row->day;
           //$this->db->insert('smartpos_produksi_job', $data);
           if ($this->db->insert('smartpos_produksi_job', $data)){
                $idpj = $this->db->insert_id();
                $this->cloneItemTemplate($id, $idpj, $row->id);
                $this->cloneStaffTemplate($id, $idpj, $row->id);
           }else {
                echo json_encode(array('status' => 'Error', 'message' =>'Erro duplikat job'));
            }   
           
        }
    }

    public function cloneStaffTemplate($id, $pj, $pjold){
        $query = $this->db->where('produksi_job_id', $pjold)->get('smartpos_template_staff');
        foreach ($query->result() as $row) {      
            $datax = array();
            $datax['produksi_job_id'] = $pj;
            $datax['staff_id'] = $row->staff_id;
            $datax['price'] = $row->price;
            $this->db->insert('smartpos_produksi_staff', $datax);
        }
    }

    public function cloneItemTemplate($id, $pj, $pjold){
        $this->load->model('data_model', 'dmodel');
        $query = $this->db->where('produksi_job_id', $pjold)->get('smartpos_template_item');
        foreach ($query->result() as $row) {      
            $datax = array();
            $datax['produksi_id'] = $id;
            $datax['produksi_job_id'] = $pj;
            $datax['product_id'] = $row->product_id;
            $harga = $this->dmodel->get_column('smartpos_products', 'fproduct_price', ['pid' => $row->product_id]);
            $datax['harga'] = $harga;
            $dharga = $this->dmodel->get_column('smartpos_products', 'disrate', ['pid' => $row->product_id]);
            if($dharga != "0.00"){

            }
            $datax['dharga'] = $dharga;
            $datax['mharga'] = $this->dmodel->get_column('smartpos_products', 'product_price', ['pid' => $row->product_id]);
            $datax['qty'] = $row->qty;
            $datax['subtotal'] = $harga * $row->qty;
            //get data produk with $row->product_id
            $qty = $this->dmodel->get_column('smartpos_products', 'qty', ['pid' => $row->product_id]);
            $indent = 0;
            if($row->qty >= $qty) $indent = $row->qty - $qty;
            if($row->qty <= $qty) $indent = 0;
            $datax['indent'] = $indent;

            //update stok
            $this->db->insert('smartpos_produksi_item', $datax);
            //if ($this->db->insert('smartpost_produksi_item', $row)){
            //}else {
            //    echo json_encode(array('status' => 'Error', 'message' =>'Erro duplikat item'));
            //}
        }
    }

    public function update($id, $date, $datedue, $customer_id, $vehicle_id, $price, $bbn, $tax, $taxppn, $total){
        $data = array(
            'id' => $id,
            'date' => $date,
            'datedue' => $datedue,
            'customer_id' => $customer_id,
            'vehicle_id' => $vehicle_id,
            'price' => $price,
            'bbn' => $bbn,
            'tax' => $tax,
            'taxppn' => $taxppn,
            'total' => $total,
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