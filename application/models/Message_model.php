<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {

    public function employee_details($id) {

        $this->db->select('smartpos_employees.*');
        $this->db->from('smartpos_employees');
        $this->db->where('smartpos_pms.id', $id);
        $this->db->join('smartpos_pms', 'smartpos_employees.id = smartpos_pms.sender_id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

}
