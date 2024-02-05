<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model {

    var $table = 'smartpos_accounts';

    public function __construct() {
        parent::__construct();
    }

    public function accountslist($l = true, $lid = 0) {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($l) {
            if ($this->aauth->get_user()->loc) {
                $this->db->where('loc', $this->aauth->get_user()->loc);
                if (BDATA)
                    $this->db->or_where('loc', 0);
            } else {
                if (!BDATA)
                    $this->db->where('loc', 0);
            }
        } else {
            $this->db->where('loc', $lid);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function details($acid) {

        $this->db->select('*');
        $this->db->from('smartpos_accounts');
        $this->db->where('id', $acid);
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('loc', 0);
            $this->db->group_end();
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function addnew($accno, $holder, $intbal, $acode, $lid, $account_type) {
        $data = array(
            'acn' => $accno,
            'holder' => $holder,
            'adate' => date('Y-m-d H:i:s'),
            'lastbal' => $intbal,
            'code' => $acode,
            'loc' => $lid,
            'account_type' => $account_type
        );

        if ($this->db->insert('smartpos_accounts', $data)) {
            $this->aauth->applog("[Account Created] $accno - $intbal ID " . $this->db->insert_id(), $this->aauth->get_user()->username);
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED') . "  <a href='" . base_url('accounts') . "' class='btn btn-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a> <a href='add' class='btn btn-info btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a>"));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function edit($acid, $accno, $holder, $acode, $lid, $account_equity = '') {
        if ($account_equity) {
            $data = array(
                'acn' => $accno,
                'holder' => $holder,
                'code' => $acode,
                'loc' => $lid,
                'lastbal' => $account_equity
            );
        } else {
            $data = array(
                'acn' => $accno,
                'holder' => $holder,
                'code' => $acode,
                'loc' => $lid
            );
        }

        $this->db->set($data);
        $this->db->where('id', $acid);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        }

        if ($this->db->update('smartpos_accounts')) {
            $this->aauth->applog("[Account Edited] $accno - ID " . $acid, $this->aauth->get_user()->username);
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function account_stats() {
        $whr = ' ';
        if ($this->aauth->get_user()->loc) {
            $whr = ' WHERE loc=' . $this->aauth->get_user()->loc;
            if (BDATA)
                $whr .= 'OR loc=0 ';
        }

        $query = $this->db->query("SELECT SUM(lastbal) AS balance,COUNT(id) AS count_a FROM smartpos_accounts $whr");

        $result = $query->row_array();
        echo json_encode(array(0 => array('balance' => amountExchange($result['balance'], 0, $this->aauth->get_user()->loc), 'count_a' => $result['count_a'])));
    }

      
    var $tablex = 'accounts';
    var $order = array('code' => 'asc');
    var $column_search = array('name');
    
    private function _get_datatables_query() {
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
        $this->db->select('accounts.id');
        $this->db->from($this->tablex);
        return $this->db->count_all_results();
    }

    public function add_account($sub, $code, $level, $name, $status){
        $data = array(
            'sub' => $sub,
            'code' => $code,
            'level' => $level,
            'name' => $name,
            'status' => $status
        );

        if ($this->db->insert('accounts', $data)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED') . "  <a href='" . base_url('accounts') . "' class='btn btn-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a> <a href='add' class='btn btn-info btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a>"));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
    

    public function update_account($id, $sub, $code, $level, $name, $status){
        $data = array(
            'sub' => $sub,
            'code' => $code,
            'level' => $level,
            'name' => $name,
            'status' => $status
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->db->update($this->tablex)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED') . "  <a href='" . base_url('accounts') . "' class='btn btn-blue btn-lg'><span class='fa fa-list-alt' aria-hidden='true'></span>  </a> <a href='add' class='btn btn-info btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a>"));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    
    public function sop_settings($payable, $purchase, $disc, $tax, $inventory) {

        //sop purchase
        //sop_purchase_payable
        //sop_purchase_purchase
        //sop_purchase_disc
        //sop_purchase_tax
        //sop_purchase_inventory
        $data = array(
            'type' => 1, //1: sop purchase, 2: sop project
            'name' => 'sop_purchase_payable',
            'account_id' => $payable,           
        );
        $data = array(
            'type' => 1, //1: sop purchase, 2: sop project
            'name' => 'sop_purchase_purchase',
            'account_id' => $purchase,           
        );
        $data = array(
            'type' => 1, //1: sop purchase, 2: sop project
            'name' => 'sop_purchase_disc',
            'account_id' => $disc,          
        );
        $data = array(
            'type' => 1, //1: sop purchase, 2: sop project
            'name' => 'sop_purchase_tax',
            'account_id' => $tax,        
        );
        $data = array(
            'type' => 1, //1: sop purchase, 2: sop project
            'name' => 'sop_purchase_inventory',
            'account_id' => $inventory,            
        );

        $this->db->set($data);
        //$this->db->where('id', 54);

        if ($this->db->update('accounts_config')) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }
}
