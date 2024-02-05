<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Extended_invoices_model extends CI_Model {

    var $table = 'smartpos_invoice_items';
    var $column_order = array(null, 'smartpos_invoices.tid', 'smartpos_customers.name', 'smartpos_invoices.invoicedate', 'smartpos_invoice_items.subtotal', 'smartpos_invoice_items.qty', 'smartpos_invoice_items.discount', 'smartpos_invoice_items.tax');
    var $column_search = array('smartpos_invoices.tid', 'smartpos_customers.name', 'smartpos_invoices.invoicedate', 'smartpos_invoice_items.subtotal', 'smartpos_invoice_items.qty', 'smartpos_invoice_items.tax');
    var $order = array('smartpos_invoices.tid' => 'desc');

    public function __construct() {
        parent::__construct();
    }

    private function _get_datatables_query($opt = '') {
        $this->db->select('smartpos_invoices.id,smartpos_invoices.tid,smartpos_invoices.invoicedate,smartpos_invoices.invoiceduedate,smartpos_invoice_items.subtotal,smartpos_invoice_items.qty,smartpos_invoice_items.product,smartpos_invoice_items.discount,smartpos_invoice_items.tax,smartpos_customers.name');
        $this->db->from($this->table);
        //$this->db->where('smartpos_invoices.i_class', 1);
        $this->db->where('smartpos_invoices.status !=', 'canceled');
        if ($opt) {
            $this->db->where('smartpos_invoices.eid', $opt);
        }
        if ($this->input->post('start_date') && $this->input->post('end_date')) { // if datatable send POST for search
            $this->db->where('DATE(smartpos_invoices.invoicedate) >=', datefordatabase($this->input->post('start_date')));
            $this->db->where('DATE(smartpos_invoices.invoicedate) <=', datefordatabase($this->input->post('end_date')));
        }
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }
        $this->db->join('smartpos_invoices', 'smartpos_invoices.id=smartpos_invoice_items.tid', 'left');
        $this->db->join('smartpos_customers', 'smartpos_invoices.csd=smartpos_customers.id', 'left');

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

    function get_datatables($opt = '') {
        $this->_get_datatables_query($opt);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        //  $this->db->join('smartpos_invoices', 'smartpos_invoices.id=smartpos_invoice_items.tid', 'left');
        return $query->result();
    }

    function count_filtered($opt = '') {
        $this->_get_datatables_query($opt);
        if ($opt) {
            $this->db->where('eid', $opt);
        }

        //       $this->db->join('smartpos_invoices', 'smartpos_invoices.id=smartpos_invoice_items.tid', 'left');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($opt = '') {
        $this->db->select('smartpos_invoice_items.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}
