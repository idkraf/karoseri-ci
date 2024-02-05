<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template_staff_model extends CI_Model {
    
    var $table = 'smartpos_template_staff';
    var $column_search = array('username');
    var $column_order = array('id');
    //var $column_search = array('code', 'valid', 'amount');
    var $order = array('id' => 'desc');


    private function _get_datatables_query($id = null) {

        $this->db->select('smartpos_template_staff.*');
        $this->db->select('x1.username, x1.email');
        $this->db->select('x3.name');

        $this->db->join('smartpos_users x1', 'x1.id = smartpos_template_staff.staff_id');
        $this->db->join('smartpos_template_job x2', 'x2.id = smartpos_template_staff.produksi_job_id');
        $this->db->join('smartpos_job x3', 'x3.id = x2.job_id');
        $this->db->from($this->table);
        if ($id != null) {
            $this->db->where('smartpos_template_staff.produksi_job_id', $id);
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

    function get_datatables($id = null) {
        $this->_get_datatables_query($id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        return $query->result();
    }
    
    function count_filtered_1($id = null) {
        $this->db->where('produksi_job_id', $id);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_filtered($id = null) {
        $this->_get_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->select('smartpos_template_staff.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    

    public function add($produksi_job_id, $staff_id, $price){
        $data = array(
            'produksi_job_id' => $produksi_job_id,
            'staff_id' => $staff_id,
            'price' => $price
        );

        if ($this->db->insert($this->table, $data)) {
            echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('ADDED')));
        }else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function update($id, $produksi_job_id, $staff_id, $price){
        $data = array(
            'produksi_job_id' => $produksi_job_id,
            'staff_id' => $staff_id,
            'price' => $price
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