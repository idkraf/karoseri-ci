<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Restservice_model extends CI_Model {

    public function customers($id = '') {

        $this->db->select('*');
        $this->db->from('smartpos_customers');
        if ($id != '') {

            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_customer($id) {
        return $this->db->delete('smartpos_customers', array('id' => $id));
    }

    public function products($id = '') {

        $this->db->select('*');
        $this->db->from('smartpos_products');
        if ($id != '') {

            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function invoice($id) {
        $this->db->select('smartpos_invoices.*,smartpos_customers.*,smartpos_invoices.id AS iid,smartpos_customers.id AS cid,smartpos_terms.id AS termid,smartpos_terms.title AS termtit,smartpos_terms.terms AS terms');
        $this->db->from('smartpos_invoices');
        $this->db->where('smartpos_invoices.id', $id);
        $this->db->join('smartpos_customers', 'smartpos_invoices.csd = smartpos_customers.id', 'left');
        $this->db->join('smartpos_terms', 'smartpos_terms.id = smartpos_invoices.term', 'left');
        $query = $this->db->get();
        $invoice = $query->row_array();
        $loc = location($invoice['loc']);
        $this->db->select('smartpos_invoice_items.*');
        $this->db->from('smartpos_invoice_items');
        $this->db->where('smartpos_invoice_items.tid', $id);
        $query = $this->db->get();
        $items = $query->result_array();
        return array(array('invoice' => $invoice, 'company' => $loc, 'items' => $items, 'currency' => currency($invoice['loc'])));
    }

}
