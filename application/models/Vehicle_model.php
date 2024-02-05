<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model {
    
    var $table = 'smartpos_vehicle';
    var $column_order = array(null, 'code', 'name', 'police', 'body', 'machine', 'colour', 'year', null);
    var $column_search = array('code', 'name');
    var $order = array('id' => 'desc');
    
    private function _get_datatables_query() {
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
        $this->db->select('smartpos_vehicle.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function add($code, $name, $police, $body, $machine, $colour, $year, $notes){
        
        $data = array(
            'code' => $code,
            'name' => $name,
            'police' => $police,
            'body' => $body,
            'machine' => $machine,
            'colour' => $colour,
            'year' => $year,
            'notes' => $notes,
        );
        if ($this->db->insert($this->table, $data)) {
            echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('ADDED')));
        }else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
    
    public function update($id, $code, $name, $police, $body, $machine, $colour, $year, $notes){

        $data = array(
            'code' => $code,
            'name' => $name,
            'police' => $police,
            'body' => $body,
            'machine' => $machine,
            'colour' => $colour,
            'year' => $year,
            'notes' => $notes,
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
    
    public function delete_i() {
        if ($this->aauth->premission(11)) {
            $id = $this->input->post('deleteid');
           
            $this->db->delete($this->table, array('id' => $id));
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));

        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
}