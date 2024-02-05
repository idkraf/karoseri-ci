<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices_model extends CI_Model {

    var $table = 'smartpos_invoices';
    var $column_order = array(null, 'smartpos_invoices.tid', 'smartpos_customers.name', 'smartpos_invoices.invoicedate', 'smartpos_invoices.total', 'smartpos_invoices.status', null);
    var $column_search = array('smartpos_invoices.tid', 'smartpos_customers.name', 'smartpos_invoices.invoicedate', 'smartpos_invoices.total', 'smartpos_invoices.status');
    var $order = array('smartpos_invoices.tid' => 'desc');

    public function __construct() {
        parent::__construct();
    }

    public function lastinvoice() {
        $this->db->select('tid');
        $this->db->from($this->table);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $this->db->where('i_class', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->tid;
        } else {
            return 1000;
        }
    }

    public function invoice_details($id, $eid = '', $p = true) {
        $this->db->select('smartpos_invoices.*,SUM(smartpos_invoices.shipping + smartpos_invoices.ship_tax) AS shipping,smartpos_customers.*,smartpos_invoices.loc as loc,smartpos_invoices.id AS iid,smartpos_customers.id AS cid,smartpos_terms.id AS termid,smartpos_terms.title AS termtit,smartpos_terms.terms AS terms');
        $this->db->from($this->table);
        $this->db->where('smartpos_invoices.id', $id);
        if ($eid) {
            $this->db->where('smartpos_invoices.eid', $eid);
        }
        if ($p) {


            if ($this->aauth->get_user()->loc) {
                $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
            } elseif (!BDATA) {
                $this->db->where('smartpos_invoices.loc', 0);
            }
        }
        $this->db->join('smartpos_customers', 'smartpos_invoices.csd = smartpos_customers.id', 'left');
        $this->db->join('smartpos_terms', 'smartpos_terms.id = smartpos_invoices.term', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function invoice_products($id) {

        $this->db->select('*');
        $this->db->from('smartpos_invoice_items');
        $this->db->where('tid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function items_with_product($id) {

        $this->db->select('smartpos_invoice_items.*,smartpos_products.qty AS alert');
        $this->db->from('smartpos_invoice_items');
        $this->db->where('tid', $id);
        $this->db->join('smartpos_products', 'smartpos_products.pid = smartpos_invoice_items.pid', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function currencies() {

        $this->db->select('*');
        $this->db->from('smartpos_currencies');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function currency_d($id, $loc = 0) {
        if ($loc) {
            $query = $this->db->query("SELECT cur FROM smartpos_locations WHERE id='$loc' LIMIT 1");
            $row = $query->row_array();
            $id = $row['cur'];
        }
        $this->db->select('*');
        $this->db->from('smartpos_currencies');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
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

    public function invoice_transactions($id) {

        $this->db->select('*');
        $this->db->from('smartpos_transactions');
        $this->db->where('tid', $id);
        $this->db->where('ext', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function invoice_delete($id, $eid = '') {
        $this->db->trans_start();
        $this->db->select('tid,total,status');
        $this->db->from('smartpos_invoices');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        if ($this->aauth->get_user()->loc) {
            if ($eid) {

                $res = $this->db->delete('smartpos_invoices', array('id' => $id, 'eid' => $eid, 'loc' => $this->aauth->get_user()->loc));
            } else {
                $res = $this->db->delete('smartpos_invoices', array('id' => $id, 'loc' => $this->aauth->get_user()->loc));
            }
        } else {
            if (BDATA) {
                if ($eid) {

                    $res = $this->db->delete('smartpos_invoices', array('id' => $id, 'eid' => $eid));
                } else {
                    $res = $this->db->delete('smartpos_invoices', array('id' => $id));
                }
            } else {


                if ($eid) {

                    $res = $this->db->delete('smartpos_invoices', array('id' => $id, 'eid' => $eid, 'loc' => 0));
                } else {
                    $res = $this->db->delete('smartpos_invoices', array('id' => $id, 'loc' => 0));
                }
            }
        }

        $affect = $this->db->affected_rows();

        if ($res) {
            if ($result['status'] != 'canceled') {
                $this->db->select('pid,qty');
                $this->db->from('smartpos_invoice_items');
                $this->db->where('tid', $id);
                $query = $this->db->get();
                $prevresult = $query->result_array();

                foreach ($prevresult as $prd) {
                    $amt = $prd['qty'];
                    $this->db->set('qty', "qty+$amt", FALSE);
                    $this->db->where('pid', $prd['pid']);
                    $this->db->update('smartpos_products');
                }
            }


            if ($affect)
                $this->db->delete('smartpos_invoice_items', array('tid' => $id));

            $data = array('type' => 9, 'rid' => $id);
            $this->db->delete('smartpos_metadata', $data);

            $alert = $this->custom->api_config(66);
            if ($alert['method'] == 1) {
                $this->load->model('communication_model');
                $subject = $result['tid'] . ' ' . $this->lang->line('DELETED');
                $body = $subject . '<br> ' . $this->lang->line('Amount') . ' ' . $result['total'] . '<br> ' . $this->lang->line('Employee') . ' ' . $this->aauth->get_user()->username . '<br> ID# ' . $result['tid'];
                $out = $this->communication_model->send_corn_email($alert['url'], $alert['url'], $subject, $body, false, '');
            }

            if ($this->db->trans_complete()) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function _get_datatables_query($opt = '') {
        $this->db->select('smartpos_invoices.id,smartpos_invoices.tid,smartpos_invoices.invoicedate,smartpos_invoices.invoiceduedate,smartpos_invoices.total,smartpos_invoices.status,smartpos_customers.name');
        $this->db->from($this->table);
        $this->db->where('smartpos_invoices.i_class', 0);
        if ($opt) {
            $this->db->where('smartpos_invoices.eid', $opt);
        }
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }
        if ($this->input->post('start_date') && $this->input->post('end_date')) { // if datatable send POST for search
            $this->db->where('DATE(smartpos_invoices.invoicedate) >=', datefordatabase($this->input->post('start_date')));
            $this->db->where('DATE(smartpos_invoices.invoicedate) <=', datefordatabase($this->input->post('end_date')));
        }
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
        $this->db->where('smartpos_invoices.i_class', 0);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }

        return $query->result();
    }

    function count_filtered($opt = '') {
        $this->_get_datatables_query($opt);
        if ($opt) {
            $this->db->where('eid', $opt);
        }
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($opt = '') {
        $this->db->select('smartpos_invoices.id');
        $this->db->from($this->table);
        $this->db->where('smartpos_invoices.i_class', 0);
        if ($opt) {
            $this->db->where('smartpos_invoices.eid', $opt);
        }
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }
        return $this->db->count_all_results();
    }

    public function billingterms() {
        $this->db->select('id,title');
        $this->db->from('smartpos_terms');
        $this->db->where('type', 1);
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
        $this->db->where('smartpos_metadata.type', 1);
        $this->db->where('smartpos_metadata.rid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function meta_delete($id, $type, $name) {
        if (@unlink(FCPATH . 'userfiles/attach/' . $name)) {
            return $this->db->delete('smartpos_metadata', array('rid' => $id, 'type' => $type, 'col1' => $name));
        }
    }

    public function gateway_list($enable = '') {
        $this->db->from('smartpos_gateways');
        if ($enable == 'Yes') {
            $this->db->where('enable', 'Yes');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

}
