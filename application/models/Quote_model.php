<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Quote_model extends CI_Model {

    var $table = 'smartpos_quotes';
    var $column_order = array(null, 'smartpos_quotes.tid', 'smartpos_customers.name', 'smartpos_quotes.invoicedate', 'smartpos_quotes.total', 'smartpos_quotes.status', null);
    var $column_search = array('smartpos_quotes.tid', 'smartpos_customers.name', 'smartpos_quotes.invoicedate', 'smartpos_quotes.total', 'smartpos_quotes.status',);
    var $order = array('smartpos_quotes.tid' => 'desc');

    public function __construct() {
        parent::__construct();
    }

    public function lastquote() {
        $this->db->select('tid');
        $this->db->from($this->table);
        $this->db->order_by('tid', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->tid;
        } else {
            return 1000;
        }
    }

    public function warehouses() {
        $this->db->select('*');
        $this->db->from('smartpos_warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('loc', 0);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }


        $query = $this->db->get();
        return $query->result_array();
    }

    public function quote_details($id) {

        $this->db->select('smartpos_quotes.*,smartpos_quotes.id AS iid,SUM(smartpos_quotes.shipping + smartpos_quotes.ship_tax) AS shipping,smartpos_customers.*,smartpos_quotes.loc as loc,smartpos_customers.id AS cid,smartpos_terms.id AS termid,smartpos_terms.title AS termtit,smartpos_terms.terms AS terms');
        $this->db->from($this->table);
        $this->db->where('smartpos_quotes.id', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_quotes.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_quotes.loc', 0);
        }
        $this->db->join('smartpos_customers', 'smartpos_quotes.csd = smartpos_customers.id', 'left');
        $this->db->join('smartpos_terms', 'smartpos_terms.id = smartpos_quotes.term', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function quote_products($id) {

        $this->db->select('*');
        $this->db->from('smartpos_quotes_items');
        $this->db->where('tid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function quote_delete($id) {
        $this->db->trans_start();
        if ($this->aauth->get_user()->loc) {
            $res = $this->db->delete('smartpos_quotes', array('id' => $id, 'loc' => $this->aauth->get_user()->loc));
        } else {
            if (BDATA) {
                $res = $this->db->delete('smartpos_quotes', array('id' => $id));
            } else {
                $res = $this->db->delete('smartpos_quotes', array('id' => $id, 'loc' => 0));
            }
        }
        if ($this->db->affected_rows())
            $this->db->delete('smartpos_quotes_items', array('tid' => $id));
        if ($this->db->trans_complete()) {
            return true;
        } else {
            return false;
        }
    }

    private function _get_datatables_query($eid) {

        $this->db->select('smartpos_quotes.id,smartpos_quotes.tid,smartpos_quotes.invoicedate,smartpos_quotes.invoiceduedate,smartpos_quotes.total,smartpos_quotes.status,smartpos_customers.name');
        $this->db->from($this->table);
        if ($eid)
            $this->db->where('smartpos_quotes.eid', $eid);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_quotes.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_quotes.loc', 0);
        }
        if ($this->input->post('start_date') && $this->input->post('end_date')) { // if datatable send POST for search
            $this->db->where('DATE(smartpos_quotes.invoicedate) >=', datefordatabase($this->input->post('start_date')));
            $this->db->where('DATE(smartpos_quotes.invoicedate) <=', datefordatabase($this->input->post('end_date')));
        }

        $this->db->join('smartpos_customers', 'smartpos_quotes.csd=smartpos_customers.id', 'left');

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

    function get_datatables($eid) {
        $this->_get_datatables_query($eid);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_quotes.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_quotes.loc', 0);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($eid) {
        $this->_get_datatables_query($eid);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_quotes.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_quotes.loc', 0);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($eid) {
        $this->db->select('smartpos_quotes.id');
        $this->db->from($this->table);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_quotes.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_quotes.loc', 0);
        }
        if ($eid)
            $this->db->where('smartpos_quotes.eid', $eid);
        return $this->db->count_all_results();
    }

    public function billingterms() {
        $this->db->select('id,title');
        $this->db->from('smartpos_terms');
        $this->db->where('type', 2);
        $this->db->or_where('type', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function employee($id) {
        $this->db->select('smartpos_employees.name,smartpos_employees.sign,smartpos_users.roleid');
        $this->db->from('smartpos_employees');
        $this->db->where('smartpos_employees.id', $id);
        $this->db->join('smartpos_users', 'smartpos_employees.id = smartpos_users.id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function convert($id) {

        $invoice = $this->quote_details($id);
        $products = $this->quote_products($id);
        $this->db->trans_start();
        $this->db->select('tid');
        $this->db->from('smartpos_invoices');
        $this->db->where('i_class', 0);
        $this->db->order_by('tid', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $iid = $query->row()->tid + 1;
        } else {
            $iid = 1000;
        }
        $productlist = array();
        $prodindex = 0;
        if ($invoice['loc'] == $this->aauth->get_user()->loc) {
            $data = array('tid' => $iid, 'invoicedate' => $invoice['invoicedate'], 'invoiceduedate' => $invoice['invoicedate'], 'subtotal' => $invoice['invoicedate'], 'shipping' => $invoice['shipping'], 'discount' => $invoice['discount'], 'tax' => $invoice['tax'], 'total' => $invoice['total'], 'notes' => $invoice['notes'], 'csd' => $invoice['csd'], 'eid' => $invoice['eid'], 'items' => $invoice['items'], 'taxstatus' => $invoice['taxstatus'], 'discstatus' => $invoice['discstatus'], 'format_discount' => $invoice['format_discount'], 'refer' => $invoice['refer'], 'term' => $invoice['term'], 'multi' => $invoice['multi'], 'loc' => $invoice['loc']);
            $this->db->insert('smartpos_invoices', $data);
            $iid = $this->db->insert_id();
            foreach ($products as $row) {
                $amt = $row['qty'];
                $data = array(
                    'tid' => $iid,
                    'pid' => $row['pid'],
                    'product' => $row['product'],
                    'code' => $row['code'],
                    'qty' => $amt,
                    'price' => $row['price'],
                    'tax' => $row['tax'],
                    'discount' => $row['discount'],
                    'subtotal' => $row['subtotal'],
                    'totaltax' => $row['totaltax'],
                    'totaldiscount' => $row['totaldiscount'],
                    'product_des' => $row['product_des'],
                    'unit' => $row['unit']
                );
                $productlist[$prodindex] = $data;
                $prodindex++;
                $this->db->set('qty', "qty-$amt", FALSE);
                $this->db->where('pid', $row['pid']);
                $this->db->update('smartpos_products');
            }


            $this->db->insert_batch('smartpos_invoice_items', $productlist);

            //profit calculation
            $t_profit = 0;
            $this->db->select('smartpos_invoice_items.pid, smartpos_invoice_items.price, smartpos_invoice_items.qty, smartpos_products.fproduct_price');
            $this->db->from('smartpos_invoice_items');
            $this->db->join('smartpos_products', 'smartpos_products.pid = smartpos_invoice_items.pid', 'left');
            $this->db->where('smartpos_invoice_items.tid', $iid);
            $query = $this->db->get();
            $pids = $query->result_array();
            foreach ($pids as $profit) {
                $t_cost = $profit['fproduct_price'] * $profit['qty'];
                $s_cost = $profit['price'] * $profit['qty'];
                $t_profit += $s_cost - $t_cost;
            }
            $data = array('type' => 9, 'rid' => $iid, 'col1' => rev_amountExchange_s($t_profit, $invoice['multi'], $this->aauth->get_user()->loc), 'd_date' => $invoice['invoicedate']);

            $this->db->insert('smartpos_metadata', $data);

            if ($this->db->trans_complete()) {
                $this->db->set('status', 'accepted');
                $this->db->where('id', $id);
                $this->db->update('smartpos_quotes');
                return true;
            } else {
                return false;
            }
        } else {

            return false;
        }
    }

    public function convert_po($id, $person) {

        $invoice = $this->quote_details($id);
        $products = $this->quote_products($id);
        $this->db->trans_start();
        $this->db->select('tid');
        $this->db->from('smartpos_purchase');
        $this->db->order_by('tid', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $iid = $query->row()->tid + 1;
        } else {
            $iid = 1000;
        }
        $productlist = array();
        $prodindex = 0;
        if ($invoice['loc'] == $this->aauth->get_user()->loc) {
            $data = array('tid' => $iid, 'invoicedate' => $invoice['invoicedate'], 'invoiceduedate' => $invoice['invoicedate'], 'subtotal' => $invoice['invoicedate'], 'shipping' => $invoice['shipping'], 'discount' => $invoice['discount'], 'tax' => $invoice['tax'], 'total' => $invoice['total'], 'notes' => $invoice['notes'], 'csd' => $person, 'eid' => $invoice['eid'], 'items' => $invoice['items'], 'taxstatus' => $invoice['taxstatus'], 'discstatus' => $invoice['discstatus'], 'format_discount' => $invoice['format_discount'], 'refer' => $invoice['refer'], 'term' => $invoice['term'], 'multi' => $invoice['multi'], 'loc' => $invoice['loc']);
            $this->db->insert('smartpos_purchase', $data);
            $iid = $this->db->insert_id();
            foreach ($products as $row) {
                $amt = $row['qty'];
                $data = array(
                    'tid' => $iid,
                    'pid' => $row['pid'],
                    'product' => $row['product'],
                    'code' => $row['code'],
                    'qty' => $amt,
                    'price' => $row['price'],
                    'tax' => $row['tax'],
                    'discount' => $row['discount'],
                    'subtotal' => $row['subtotal'],
                    'totaltax' => $row['totaltax'],
                    'totaldiscount' => $row['totaldiscount'],
                    'product_des' => $row['product_des'],
                    'unit' => $row['unit']
                );
                $productlist[$prodindex] = $data;
                $prodindex++;
                $this->db->set('qty', "qty+$amt", FALSE);
                $this->db->where('pid', $row['pid']);
                $this->db->update('smartpos_products');
            }


            $this->db->insert_batch('smartpos_purchase_items', $productlist);

            if ($this->db->trans_complete()) {
                $this->db->set('status', 'accepted');
                $this->db->where('id', $id);
                $this->db->update('smartpos_quotes');
                return true;
            } else {
                return false;
            }
        } else {

            return false;
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

    public function meta_insert($id, $type, $meta_data) {

        $data = array('type' => $type, 'rid' => $id, 'col1' => $meta_data);
        if ($id) {
            return $this->db->insert('smartpos_metadata', $data);
        } else {
            return 0;
        }
    }

    public function attach($id) {
        $this->db->select('smartpos_metadata.*');
        $this->db->from('smartpos_metadata');
        $this->db->where('smartpos_metadata.type', 2);
        $this->db->where('smartpos_metadata.rid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function meta_delete($id, $type, $name) {
        if (@unlink(FCPATH . 'userfiles/attach/' . $name)) {
            return $this->db->delete('smartpos_metadata', array('rid' => $id, 'type' => $type, 'col1' => $name));
        }
    }

}
