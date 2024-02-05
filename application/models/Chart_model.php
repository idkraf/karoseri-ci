<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_model extends CI_Model {

    public function productcat($type, $c1 = '', $c2 = '') {
        switch ($type) {
            case 'week':
                $day1 = date("Y-m-d", strtotime(' - 7 days'));
                $day2 = date('Y-m-d');
                break;
            case 'month':
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
            case 'year':
                $day1 = date("Y-m-d", strtotime(' - 1 years'));
                $day2 = date('Y-m-d');
                break;

            case 'custom':
                $day1 = datefordatabase($c1);
                $day2 = datefordatabase($c2);
                break;

            default :
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
        }
        $this->db->select_sum('smartpos_invoice_items.qty');
        $this->db->select_sum('smartpos_invoice_items.subtotal');
        $this->db->select('smartpos_invoice_items.pid');
        $this->db->select('smartpos_product_cat.title');
        $this->db->from('smartpos_invoice_items');
        $this->db->group_by('smartpos_product_cat.id');
        $this->db->join('smartpos_invoices', 'smartpos_invoices.id = smartpos_invoice_items.tid', 'left');
        $this->db->join('smartpos_products', 'smartpos_products.pid = smartpos_invoice_items.pid', 'left');
        $this->db->join('smartpos_product_cat', 'smartpos_product_cat.id = smartpos_products.pcat', 'left');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(smartpos_invoices.invoicedate) >=', $day1);
        $this->db->where('DATE(smartpos_invoices.invoicedate) <=', $day2);
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('smartpos_invoices.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function trendingproducts($type, $c1 = '', $c2 = '') {
        switch ($type) {
            case 'week':
                $day1 = date("Y-m-d", strtotime(' - 7 days'));
                $day2 = date('Y-m-d');
                break;
            case 'month':
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
            case 'year':
                $day1 = date("Y-m-d", strtotime(' - 1 years'));
                $day2 = date('Y-m-d');
                break;

            case 'custom':
                $day1 = datefordatabase($c1);
                $day2 = datefordatabase($c2);
                break;

            default :
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
        }

        $this->db->select_sum('smartpos_invoice_items.qty');
        $this->db->select('smartpos_products.product_name');
        $this->db->from('smartpos_invoice_items');
        $this->db->group_by('smartpos_invoice_items.pid');
        $this->db->join('smartpos_invoices', 'smartpos_invoices.id = smartpos_invoice_items.tid', 'left');
        $this->db->join('smartpos_products', 'smartpos_products.pid = smartpos_invoice_items.pid', 'left');

        $this->db->where('DATE(smartpos_invoices.invoicedate) >=', $day1);
        $this->db->where('DATE(smartpos_invoices.invoicedate) <=', $day2);
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('smartpos_invoices.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }
        $this->db->order_by('smartpos_invoice_items.qty', 'DESC');
        $this->db->limit(100);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function profitchart($type, $c1 = '', $c2 = '') {
        switch ($type) {
            case 'week':
                $day1 = date("Y-m-d", strtotime(' - 7 days'));
                $day2 = date('Y-m-d');
                break;
            case 'month':
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
            case 'year':
                $day1 = date("Y-m-d", strtotime(' - 1 years'));
                $day2 = date('Y-m-d');
                break;

            case 'custom':
                $day1 = datefordatabase($c1);
                $day2 = datefordatabase($c2);
                break;

            default :
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
        }

        $this->db->select_sum('smartpos_metadata.col1');
        $this->db->select('smartpos_metadata.d_date');
        $this->db->from('smartpos_metadata');
        $this->db->group_by('smartpos_metadata.d_date');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(smartpos_metadata.d_date) >=', $day1);
        $this->db->where('DATE(smartpos_metadata.d_date) <=', $day2);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function customerchart($type, $c1 = '', $c2 = '') {
        switch ($type) {
            case 'week':
                $day1 = date("Y-m-d", strtotime(' - 7 days'));
                $day2 = date('Y-m-d');
                break;
            case 'month':
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
            case 'year':
                $day1 = date("Y-m-d", strtotime(' - 1 years'));
                $day2 = date('Y-m-d');
                break;

            case 'custom':
                $day1 = datefordatabase($c1);
                $day2 = datefordatabase($c2);
                break;

            default :
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
        }
        $this->db->select_sum('smartpos_invoices.total');
        $this->db->select('smartpos_customers.name');
        $this->db->from('smartpos_invoices');
        $this->db->group_by('smartpos_invoices.csd');
        $this->db->join('smartpos_customers', 'smartpos_customers.id = smartpos_invoices.csd', 'left');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(smartpos_invoices.invoicedate) >=', $day1);
        $this->db->where('DATE(smartpos_invoices.invoicedate) <=', $day2);
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('smartpos_invoices.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }
        $this->db->order_by('smartpos_invoices.total', 'DESC');
        $this->db->limit(100);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function incomechart($type, $c1 = '', $c2 = '') {
        switch ($type) {
            case 'week':
                $day1 = date("Y-m-d", strtotime(' - 7 days'));
                $day2 = date('Y-m-d');
                break;
            case 'month':
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
            case 'year':
                $day1 = date("Y-m-d", strtotime(' - 1 years'));
                $day2 = date('Y-m-d');
                break;

            case 'custom':
                $day1 = datefordatabase($c1);
                $day2 = datefordatabase($c2);
                break;

            default :
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
        }
        $this->db->select_sum('credit');
        $this->db->select('date');
        $this->db->from('smartpos_transactions');
        $this->db->group_by('date');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(date) >=', $day1);
        $this->db->where('DATE(date) <=', $day2);
        $this->db->where('type', 'Income');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function expenseschart($type, $c1 = '', $c2 = '') {
        switch ($type) {
            case 'week':
                $day1 = date("Y-m-d", strtotime(' - 7 days'));
                $day2 = date('Y-m-d');
                break;
            case 'month':
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
            case 'year':
                $day1 = date("Y-m-d", strtotime(' - 1 years'));
                $day2 = date('Y-m-d');
                break;

            case 'custom':
                $day1 = datefordatabase($c1);
                $day2 = datefordatabase($c2);
                break;

            default :
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
        }
        $this->db->select_sum('debit');
        $this->db->select('date');
        $this->db->from('smartpos_transactions');
        $this->db->group_by('date');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(date) >=', $day1);
        $this->db->where('DATE(date) <=', $day2);
        $this->db->where('type', 'Expense');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function incexp($type, $c1 = '', $c2 = '') {
        switch ($type) {
            case 'week':
                $day1 = date("Y-m-d", strtotime(' - 7 days'));
                $day2 = date('Y-m-d');
                break;
            case 'month':
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
            case 'year':
                $day1 = date("Y-m-d", strtotime(' - 1 years'));
                $day2 = date('Y-m-d');
                break;

            case 'custom':
                $day1 = datefordatabase($c1);
                $day2 = datefordatabase($c2);
                break;

            default :
                $day1 = date("Y-m-d", strtotime(' - 30 days'));
                $day2 = date('Y-m-d');
                break;
        }
        $this->db->select_sum('debit');
        $this->db->select_sum('credit');
        $this->db->select('type');
        $this->db->from('smartpos_transactions');
        $this->db->group_by('type');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(date) >=', $day1);
        $this->db->where('DATE(date) <=', $day2);
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA)
                $this->db->or_where('loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}
