<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function todayInvoice($today) {
        $where = "DATE(invoicedate) ='$today'";
        $this->db->where($where);
        $this->db->from('smartpos_invoices');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        return $this->db->count_all_results();
    }

    public function todaySales($today) {

        $where = "DATE(invoicedate) ='$today'";
        $this->db->select_sum('total');
        $this->db->from('smartpos_invoices');
        $this->db->where($where);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function todayInexp($today) {
        $this->db->select('SUM(debit) as debit,SUM(credit) as credit', FALSE);
        $this->db->where("DATE(date) ='$today'");
        $this->db->where("type!='Transfer'");
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $this->db->from('smartpos_transactions');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function recent_payments() {
        $this->db->limit(13);
        $this->db->order_by('id', 'DESC');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $this->db->from('smartpos_transactions');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function stock() {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' AND (smartpos_warehouse.loc=' . $this->aauth->get_user()->loc . ')';
        } elseif (!BDATA) {
            $whr = ' AND (smartpos_warehouse.loc=0)';
        }

        $query = $this->db->query("SELECT smartpos_products.*,smartpos_warehouse.title FROM smartpos_products LEFT JOIN smartpos_warehouse ON smartpos_products.warehouse=smartpos_warehouse.id  WHERE (smartpos_products.qty<=smartpos_products.alert) $whr ORDER BY smartpos_products.product_name ASC LIMIT 10");
        return $query->result_array();
    }

    public function todayItems($today) {
        $where = "DATE(invoicedate) ='$today'";
        $this->db->select_sum('items');
        $this->db->from('smartpos_invoices');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row()->items;
    }

    public function todayProfit($today) {
        $where = "DATE(smartpos_metadata.d_date) ='$today'";
        $this->db->select_sum('smartpos_metadata.col1');
        $this->db->from('smartpos_metadata');
        $this->db->join('smartpos_invoices', 'smartpos_metadata.rid=smartpos_invoices.id', 'left');
        $this->db->where($where);
        $this->db->where('smartpos_metadata.type', 9);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('smartpos_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('smartpos_invoices.loc', 0);
        }
        $query = $this->db->get();
        return $query->row()->col1;
    }

    public function incomeChart($today, $month, $year) {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' AND (loc=' . $this->aauth->get_user()->loc . ')';
        } elseif (!BDATA) {
            $whr = ' AND (loc=0)';
        }
        $query = $this->db->query("SELECT SUM(credit) AS total,date FROM smartpos_transactions WHERE ((DATE(date) BETWEEN DATE('$year-$month-01') AND '$today') AND type='Income')  $whr GROUP BY date ORDER BY date DESC");
        return $query->result_array();
    }

    public function expenseChart($today, $month, $year) {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' AND (loc=' . $this->aauth->get_user()->loc . ')';
        } elseif (!BDATA) {
            $whr = ' AND (loc=0)';
        }
        $query = $this->db->query("SELECT SUM(debit) AS total,date FROM smartpos_transactions WHERE ((DATE(date) BETWEEN DATE('$year-$month-01') AND '$today') AND type='Expense')  $whr GROUP BY date ORDER BY date DESC");
        return $query->result_array();
    }

    public function countmonthlyChart() {
        $today = date('Y-m-d');
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' AND (loc=' . $this->aauth->get_user()->loc . ')';
        } elseif (!BDATA) {
            $whr = ' AND (loc=0)';
        }
        $query = $this->db->query("SELECT COUNT(id) AS ttlid,SUM(total) AS total,DATE(invoicedate) as date FROM smartpos_invoices WHERE (DATE(invoicedate) BETWEEN '$today' - INTERVAL 30 DAY AND '$today')  $whr GROUP BY DATE(invoicedate) ORDER BY date DESC");
        return $query->result_array();
    }

    public function monthlyInvoice($month, $year) {
        $today = date('Y-m-d');
        $days = date("t", strtotime($today));
        $where = "DATE(invoicedate) BETWEEN '$year-$month-01' AND '$year-$month-$days'";
        $this->db->where($where);
        $this->db->from('smartpos_invoices');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        return $this->db->count_all_results();
    }

    public function monthlySales($month, $year) {
        $today = date('Y-m-d');
        $days = date("t", strtotime($today));
        $where = "DATE(invoicedate) BETWEEN '$year-$month-01' AND '$year-$month-$days'";
        $this->db->select_sum('total');
        $this->db->from('smartpos_invoices');
        $this->db->where($where);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function recentInvoices() {
        $whr = '';

        if ($this->aauth->get_user()->loc) {
            $whr = ' WHERE (i.loc=' . $this->aauth->get_user()->loc . ') ';
        } elseif (!BDATA) {
            $whr = ' WHERE (i.loc=0) ';
        }
        $query = $this->db->query("SELECT i.id,i.tid,i.invoicedate,i.total,i.status,i.i_class,c.name,c.picture,i.csd
FROM smartpos_invoices AS i LEFT JOIN smartpos_customers AS c ON i.csd=c.id $whr ORDER BY i.id DESC LIMIT 10");
        return $query->result_array();
    }

    public function recentBuyers() {
        $this->db->trans_start();
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' WHERE (i.loc=' . $this->aauth->get_user()->loc . ') ';
        } elseif (!BDATA) {
            $whr = ' WHERE (i.loc=0) ';
        }
        $query = $this->db->query("SELECT MAX(i.id) AS iid,i.csd,SUM(i.total) AS total, c.cid,MAX(c.picture) as picture ,MAX(c.name) as name,MAX(i.status) as status FROM smartpos_invoices AS i LEFT JOIN (SELECT smartpos_customers.id AS cid, smartpos_customers.picture AS picture, smartpos_customers.name AS name FROM smartpos_customers) AS c ON c.cid=i.csd $whr GROUP BY i.csd ORDER BY iid DESC LIMIT 10;");
        $result = $query->result_array();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 'sql';
        } else {
            return $result;
        }
    }

    public function tasks($id) {
        $this->db->select('*');
        $this->db->from('smartpos_todolist');
        $this->db->where('eid', $id);
        $this->db->limit(10);
        $this->db->order_by('DATE(duedate)', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function clockin($id) {
        $this->db->select('clock');
        $this->db->where('id', $id);
        $this->db->from('smartpos_employees');
        $query = $this->db->get();
        $emp = $query->row_array();
        if (!$emp['clock']) {
            $data = array(
                'clock' => 1,
                'clockin' => time(),
                'clockout' => 0
            );
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('smartpos_employees');
            $this->aauth->applog("[Employee ClockIn]  ID $id", $this->aauth->get_user()->username);
        }
        return true;
    }

    public function clockout($id) {

        $this->db->select('clock,clockin');
        $this->db->where('id', $id);
        $this->db->from('smartpos_employees');
        $query = $this->db->get();
        $emp = $query->row_array();

        if ($emp['clock']) {

            $data = array(
                'clock' => 0,
                'clockin' => 0,
                'clockout' => time()
            );

            $total_time = time() - $emp['clockin'];

            $this->db->set($data);
            $this->db->where('id', $id);

            $this->db->update('smartpos_employees');
            $this->aauth->applog("[Employee ClockOut]  ID $id", $this->aauth->get_user()->username);

            $today = date('Y-m-d');

            $this->db->select('id,adate');
            $this->db->where('emp', $id);
            $this->db->where('DATE(adate)', date('Y-m-d'));
            $this->db->from('smartpos_attendance');
            $query = $this->db->get();
            $edate = $query->row_array();
            if ($edate['adate']) {


                $this->db->set('actual_hours', "actual_hours+$total_time", FALSE);
                $this->db->set('tto', date('H:i:s'));
                $this->db->where('id', $edate['id']);
                $this->db->update('smartpos_attendance');
            } else {
                $data = array(
                    'emp' => $id,
                    'adate' => date('Y-m-d'),
                    'tfrom' => gmdate("H:i:s", $emp['clockin']),
                    'tto' => date('H:i:s'),
                    'note' => 'Self Attendance',
                    'actual_hours' => $total_time
                );

                $this->db->insert('smartpos_attendance', $data);
            }
        }
        return true;
    }

}
