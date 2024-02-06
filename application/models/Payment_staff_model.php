<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_staff_model extends CI_Model {

    var $table = 'payment_staff';
    var $order = array('id' => 'desc');
    var $column_search = array('name', 'tanggal', 'status');
    
    private function _get_datatables_query($params = null) {

        $this->db->select('payment_staff.*');
        $this->db->select('x1.name, x1.code');
        $this->db->join('smartpos_employees x1', 'x1.id = payment_staff.employee_id');
        $this->db->join('accounts x2', 'x2.id = payment_staff.account_id');
        $this->db->from($this->table);
        $i = 0;
        
        if($params['status'] != 0) 
            $this->db->where('payment_staff.status', $params['status']);

        if($params['min'] != null && $params['max'] != null)
            $this->db->where('tanggal BETWEEN "'. date('Y-m-d', strtotime($params['min'])). '" and "'. date('Y-m-d', strtotime($params['max'])).'"');


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
        $this->db->select('payment_staff.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function add($produksi_staff_id, $code, $tanggal, $account_id, $staff_id, $total, $discount, $payment, $status){
        $data = array(
            'produksi_staff_id' => $produksi_staff_id,
            'code' => $code,
            'tanggal' => $tanggal,
            'account_id' => $account_id,
            'staff_id' => $staff_id,
            'total' => $total,
            'discount' => $discount,
            'payment' => $payment,
            'status' => $status
        );

        if ($this->db->insert('payment_staff', $data)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
    

    public function update($id, $code, $tanggal, $account_id, $staff_id, $total, $discount, $payment, $status){
        $data = array(
            'code' => $code,
            'tanggal' => $tanggal,
            'account_id' => $account_id,
            'staff_id' => $staff_id,
            'total' => $total,
            'discount' => $discount,
            'payment' => $payment,
            'status' => $status
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->db->update($this->tablex)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
}