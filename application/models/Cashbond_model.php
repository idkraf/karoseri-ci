<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cashbond_model extends CI_Model {

      
    var $tablex = 'cashbond';
    var $order = array('id' => 'asc');
    var $column_search = array('code');
    
    private function _get_datatables_query() {
        //create join data staff
        //join idstaff

        $this->db->from($this->tablex);
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
        $this->db->select('cashbond.id');
        $this->db->from($this->tablex);
        return $this->db->count_all_results();
    }

    public function add_account($code, $tanggal, $account_id, $staff_id, $description, $total, $payment, $status){
        $data = array(
            'code' => $code,
            'tanggal' => $tanggal,
            'account_id' => $account_id,
            'staff_id' => $staff_id,
            'description' => $description,
            'total' => $total,
            'payment' => $payment,
            'status' => $status
        );

        if ($this->db->insert('cashbond', $data)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED') . "  <a href='" . base_url('cashbond') . "' class='btn btn-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a> <a href='add' class='btn btn-info btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a>"));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
    

    public function update_account($id, $code, $tanggal, $account_id, $staff_id, $description, $total, $payment, $status){
        $data = array(
            'code' => $code,
            'tanggal' => $tanggal,
            'account_id' => $account_id,
            'staff_id' => $staff_id,
            'description' => $description,
            'total' => $total,
            'payment' => $payment,
            'status' => $status
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->db->update($this->tablex)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED') . "  <a href='" . base_url('cashbond') . "' class='btn btn-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a> <a href='add' class='btn btn-info btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a>"));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    
}
