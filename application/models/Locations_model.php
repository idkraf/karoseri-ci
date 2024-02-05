<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Locations_model extends CI_Model {

    public function locations_list() {
        $query = $this->db->query("SELECT * FROM smartpos_locations ORDER BY id DESC");
        return $query->result_array();
    }

    public function locations_list2() {
        $where = '';
        if ($this->aauth->get_user()->loc)
            $where = 'WHERE id=' . $this->aauth->get_user()->loc . '';
        $query = $this->db->query("SELECT * FROM smartpos_locations $where ORDER BY id DESC");
        return $query->result_array();
    }

    public function view($id) {

        $this->db->from('smartpos_locations');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function create($name, $address, $city, $region, $country, $postbox, $phone, $email, $taxid, $image, $cur_id, $ac_id, $wid) {
        $data = array(
            'cname' => $name,
            'address' => $address,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'postbox' => $postbox,
            'phone' => $phone,
            'email' => $email,
            'taxid' => $taxid,
            'logo' => $image,
            'ext' => $ac_id,
            'cur' => $cur_id,
            'ware' => $wid
        );

        if ($this->db->insert('smartpos_locations', $data)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function edit($id, $name, $address, $city, $region, $country, $postbox, $phone, $email, $taxid, $image, $cur_id, $ac_id, $wid) {
        $data = array(
            'cname' => $name,
            'address' => $address,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'postbox' => $postbox,
            'phone' => $phone,
            'email' => $email,
            'taxid' => $taxid,
            'logo' => $image,
            'ext' => $ac_id,
            'cur' => $cur_id,
            'ware' => $wid
        );

        $this->db->set($data);
        $this->db->where('id', $id);

        if ($this->db->update('smartpos_locations')) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
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

    public function accountslist() {
        $this->db->select('*');
        $this->db->from('smartpos_accounts');

        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function online_pay_settings($id) {

        $this->db->select('smartpos_accounts.id,smartpos_accounts.holder,');
        $this->db->from('smartpos_locations');
        $this->db->where('smartpos_locations.id', $id);
        $this->db->join('smartpos_accounts', 'smartpos_locations.ext = smartpos_accounts.id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function warehouses() {
        $this->db->select('*');
        $this->db->from('smartpos_warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

}
