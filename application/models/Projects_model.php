<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Projects_model extends CI_Model {

    var $column_order = array('smartpos_projects.status', 'smartpos_projects.name', 'smartpos_projects.edate', 'smartpos_projects.worth', null, null);
    var $column_search = array('smartpos_projects.name', 'smartpos_projects.edate', 'smartpos_projects.status');
    var $tcolumn_order = array('status', 'name', 'duedate', 'start', null, null);
    var $tcolumn_search = array('name', 'edate', 'status');
    var $order = array('id' => 'desc');

    public function explore($id) {
        //project
        $this->db->select('smartpos_projects.*,smartpos_customers.name AS customer,smartpos_customers.email');
        $this->db->from('smartpos_projects');
        $this->db->where('smartpos_projects.id', $id);
        $this->db->join('smartpos_customers', 'smartpos_projects.cid = smartpos_customers.id', 'left');
        $query = $this->db->get();
        $project = $query->row_array();
        //employee
        $this->db->select('smartpos_employees.name');
        $this->db->from('smartpos_project_meta');
        $this->db->where('smartpos_project_meta.pid', $id);
        $this->db->where('smartpos_project_meta.meta_key', 6);
        $this->db->join('smartpos_employees', 'smartpos_project_meta.meta_data = smartpos_employees.id', 'left');
        $query = $this->db->get();
        $employee = $query->result_array();
        //invoices
        $this->db->select('smartpos_invoices.*');
        $this->db->from('smartpos_project_meta');
        $this->db->where('smartpos_project_meta.pid', $id);
        $this->db->where('smartpos_project_meta.meta_key', 11);
        $this->db->join('smartpos_invoices', 'smartpos_project_meta.meta_data = smartpos_invoices.id', 'left');
        $query = $this->db->get();
        $invoices = $query->result_array();
        //clock
        $this->db->select('*');
        $this->db->from('smartpos_project_meta');
        $this->db->where('pid', $id);
        $this->db->where('meta_key', 29);
        $this->db->where('meta_data', $this->aauth->get_user()->id);
        $query = $this->db->get();
        $clock = $query->row_array();

        return array('project' => $project, 'employee' => $employee, 'invoices' => $invoices, 'clock' => $clock);
    }

    public function details($id) {
        //project
        $this->db->select('smartpos_projects.*,smartpos_projects.id AS prj, smartpos_customers.name AS customer,smartpos_project_meta.*');
        $this->db->from('smartpos_projects');
        $this->db->where('smartpos_projects.id', $id);
        $this->db->where('smartpos_project_meta.meta_key', 2);
        $this->db->join('smartpos_customers', 'smartpos_projects.cid = smartpos_customers.id', 'left');
        $this->db->join('smartpos_project_meta', 'smartpos_project_meta.pid = smartpos_projects.id', 'left');

        $query = $this->db->get();
        return $query->row_array();
    }

    private function _project_datatables_query($cday = '', $eid = '') {
        $this->db->select("smartpos_projects.*,smartpos_customers.name AS customer");
        $this->db->from('smartpos_projects');
        $this->db->join('smartpos_customers', 'smartpos_projects.cid = smartpos_customers.id', 'left');
        if ($eid) {

            $this->db->join('smartpos_project_meta', 'smartpos_projects.id = smartpos_project_meta.pid', 'left');
            $this->db->where('smartpos_project_meta.meta_key', 19);
            $this->db->where('smartpos_project_meta.meta_data', $eid);
        }
        if ($cday) {
            $this->db->where('DATE(smartpos_projects.edate)=', $cday);
        }


        $i = 0;

        foreach ($this->column_search as $item) { // loop column
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->column_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function project_datatables($cday = '', $eid = '') {


        $this->_project_datatables_query($cday, $eid);

        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function project_count_filtered($cday = '', $eid = '') {
        $this->_project_datatables_query($cday, $eid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function project_count_all($cday = '', $eid = '') {
        $this->_project_datatables_query($cday, $eid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function addproject($name, $status, $priority, $progress, $customer, $sdate, $edate, $tag, $phase, $content, $budget, $customerview, $customer_comment, $link_to_cal, $color, $ptype, $employee) {
        $data = array('name' => $name, 'status' => $status, 'priority' => $priority, 'progress' => $progress, 'cid' => $customer, 'sdate' => $sdate, 'edate' => $edate, 'tag' => $tag, 'phase' => $phase, 'note' => $content, 'worth' => $budget, 'ptype' => $ptype);
        $this->db->insert('smartpos_projects', $data);
        $last = $this->db->insert_id();
        $title = '[Project Created] ';
        $this->add_activity($title, $last);
        $data = array('pid' => $last, 'meta_key' => 2, 'meta_data' => $customerview, 'value' => $customer_comment);
        $this->db->insert('smartpos_project_meta', $data);

        if ($employee) {
            foreach ($employee as $key => $value) {

                $data = array('pid' => $last, 'meta_key' => 19, 'meta_data' => $value);
                $this->db->insert('smartpos_project_meta', $data);
            }
        } else {
            $data = array('pid' => $last, 'meta_key' => 19, 'meta_data' => $this->aauth->get_user()->id);
            $this->db->insert('smartpos_project_meta', $data);
        }


        if ($link_to_cal > 0) {
            if ($link_to_cal == 1) {
                $sdate = $edate;
            }
            $data = array(
                'title' => '[Project] ' . $name,
                'start' => $sdate,
                'end' => $edate,
                'description' => $priority . ' priority. Start date: ' . $sdate . ' End Date: ' . $edate, 'color' => $color,
                'rel' => 1,
                'rid' => $last
            );
            $this->db->insert('smartpos_events', $data);
        }

        return $last;
    }

    public function editproject($id, $name, $status, $priority, $progress, $customer, $sdate, $edate, $tag, $phase, $content, $budget, $customerview, $customer_comment, $link_to_cal, $color, $ptype, $employee) {
        $title = '[Project Edited] ';
        $this->add_activity($title, $id);
        $data = array('name' => $name, 'status' => $status, 'priority' => $priority, 'progress' => $progress, 'cid' => $customer, 'sdate' => $sdate, 'edate' => $edate, 'tag' => $tag, 'phase' => $phase, 'note' => $content, 'worth' => $budget, 'ptype' => $ptype);
        $this->db->set($data);
        $this->db->where('id', $id);
        $out = $this->db->update('smartpos_projects');

        $this->db->delete('smartpos_events', array('rel' => 1, 'rid' => $id));
        if ($link_to_cal > 0) {
            if ($link_to_cal == 1) {
                $sdate = $edate;
            }
            $data = array(
                'title' => '[Project] ' . $name,
                'start' => $sdate,
                'end' => $edate,
                'description' => $priority . ' priority. Start date: ' . $sdate . ' End Date: ' . $edate, 'color' => $color,
                'rel' => 1,
                'rid' => $id
            );
            $this->db->insert('smartpos_events', $data);
        }
        if ($employee) {
            $this->db->delete('smartpos_project_meta', array('pid' => $id, 'meta_key' => 19));
            foreach ($employee as $key => $value) {

                $data = array('pid' => $id, 'meta_key' => 19, 'meta_data' => $value);
                $this->db->insert('smartpos_project_meta', $data);
            }
        }

        $data1 = array('meta_data' => $customerview, 'value' => $customer_comment);
        $this->db->set($data1);
        $this->db->where('pid', $id);
        $this->db->where('meta_key', 2);

        return $this->db->update('smartpos_project_meta');
    }

    public function addtask($name, $status, $priority, $stdate, $tdate, $employee, $assign, $content, $prid, $milestone) {

        $data = array('tdate' => date('Y-m-d H:i:s'), 'name' => $name, 'status' => $status, 'start' => $stdate, 'duedate' => $tdate, 'description' => $content, 'eid' => $employee, 'aid' => $assign, 'related' => 1, 'priority' => $priority, 'rid' => $prid);
        if ($prid) {

            $this->db->insert('smartpos_todolist', $data);
            $last = $this->db->insert_id();

            if ($milestone) {
                $this->meta_insert($prid, 8, $milestone, $last);
            }

            $out = $this->communication($prid, $name);

            return 1;
        } else {
            return 0;
        }
    }

    public function add_milestone($name, $stdate, $tdate, $content, $color, $prid) {

        $data = array('pid' => $prid, 'name' => $name, 'sdate' => $stdate, 'edate' => $tdate, 'color' => $color, 'exp' => $content);
        if ($prid) {

            $title = '[Milestone] ' . $name;
            $this->add_activity($title, $prid);

            return $this->db->insert('smartpos_milestones', $data);
        } else {
            return 0;
        }
    }

    public function edittask($id, $name, $status, $priority, $stdate, $tdate, $employee, $content) {

        $data = array('tdate' => date('Y-m-d H:i:s'), 'name' => $name, 'status' => $status, 'start' => $stdate, 'duedate' => $tdate, 'description' => $content, 'eid' => $employee, 'priority' => $priority);
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('smartpos_todolist');
        //return $this->db->insert('smartpos_todolist', $data);
    }

    public function settask($id, $stat) {

        $data = array('status' => $stat);
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('smartpos_todolist');
    }

    public function setnote($id, $stat) {

        $data = array('note' => $stat);
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('smartpos_projects');
    }

    public function deletetask($id) {

        return $this->db->delete('smartpos_todolist', array('id' => $id));
    }

    public function deleteproject($id) {
        $this->db->delete('smartpos_todolist', array('related' => 1, 'rid' => $id));

        return $this->db->delete('smartpos_projects', array('id' => $id));
    }

    public function viewtask($id) {

        $this->db->select('smartpos_todolist.*,smartpos_employees.name AS emp, assi.name AS assign');
        $this->db->from('smartpos_todolist');
        $this->db->where('smartpos_todolist.id', $id);
        $this->db->join('smartpos_employees', 'smartpos_employees.id = smartpos_todolist.eid', 'left');
        $this->db->join('smartpos_employees AS assi', 'assi.id = smartpos_todolist.aid', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function project_stats($project) {

        $query = $this->db->query("SELECT
				COUNT(IF( status = 'Waiting', id, NULL)) AS Waiting,
				COUNT(IF( status = 'Progress', id, NULL)) AS Progress,
				COUNT(IF( status = 'Finished', id, NULL)) AS Finished			
				FROM smartpos_projects");

        echo json_encode($query->result_array());
    }

    //project tasks

    private function _task_datatables_query($cday = '') {

        $this->db->from('smartpos_todolist');
        $this->db->where('related', 1);
        if ($cday) {

            $this->db->where('rid=', $cday);
        }


        $i = 0;

        foreach ($this->tcolumn_search as $item) { // loop column
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->tcolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->tcolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function task_datatables($cday = '') {


        $this->_task_datatables_query($cday);

        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $this->db->where('related', 1);
        $this->db->where('rid=', $cday);
        $query = $this->db->get();
        return $query->result();
    }

    function task_count_filtered($cday = '') {
        $this->_task_datatables_query($cday);
        $this->db->where('related', 1);
        $this->db->where('rid=', $cday);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function task_count_all($cday = '') {
        $this->_task_datatables_query($cday);
        $this->db->where('related', 1);
        $this->db->where('rid=', $cday);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //thread task


    public function task_thread($id) {

        $this->db->select('smartpos_todolist.*, smartpos_employees.name AS emp');
        $this->db->from('smartpos_todolist');
        $this->db->where('smartpos_todolist.related', 1);
        $this->db->where('smartpos_todolist.rid', $id);
        $this->db->join('smartpos_employees', 'smartpos_todolist.eid = smartpos_employees.id', 'left');
        $this->db->order_by('smartpos_todolist.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function milestones($id) {

        $this->db->select('*');
        $this->db->from('smartpos_milestones');
        $this->db->where('pid', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function milestones_list($id) {

        $query = $this->db->query('SELECT smartpos_milestones.*,smartpos_todolist.name as task FROM smartpos_milestones LEFT JOIN smartpos_project_meta ON smartpos_project_meta.meta_data=smartpos_milestones.id AND smartpos_project_meta.meta_key=8 LEFT JOIN smartpos_todolist ON smartpos_project_meta.value=smartpos_todolist.id WHERE smartpos_milestones.pid=' . $id . ' ORDER BY smartpos_milestones.id DESC;');
        return $query->result_array();
    }

    public function activities($id) {

        $this->db->select('smartpos_project_meta.value');
        $this->db->from('smartpos_project_meta');
        $this->db->where('pid', $id);
        $this->db->where('meta_key', 12);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function p_files($id) {

        $this->db->select('*');
        $this->db->from('smartpos_project_meta');
        $this->db->where('pid', $id);
        $this->db->where('meta_key', 9);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_activity($name, $prid) {

        $data = array('pid' => $prid, 'meta_key' => 12, 'value' => $name . ' @' . date('Y-m-d H:i:s'));
        if ($prid) {
            return $this->db->insert('smartpos_project_meta', $data);
        } else {
            return 0;
        }
    }

    public function meta_insert($prid, $meta_key, $meta_data, $value) {

        $data = array('pid' => $prid, 'meta_key' => $meta_key, 'meta_data' => $meta_data, 'value' => $value);
        if ($prid) {
            return $this->db->insert('smartpos_project_meta', $data);
        } else {
            return 0;
        }
    }

    public function deletefile($pid, $mid) {

        $this->db->select('value');
        $this->db->from('smartpos_project_meta');
        $this->db->where('pid', $pid);
        $this->db->where('meta_key', 9);
        $this->db->where('meta_data', $mid);
        $query = $this->db->get();
        $result = $query->row_array();
        unlink(FCPATH . 'userfiles/project/' . $result['value']);
        $this->db->delete('smartpos_project_meta', array('pid' => $pid, 'meta_key' => 9, 'meta_data' => $mid));
    }

    public function deletemilestone($mid) {
        $this->db->delete('smartpos_milestones', array('id' => $mid));
    }

    //comments

    public function comments_thread($id) {

        $this->db->select('smartpos_project_meta.value, smartpos_project_meta.key3,smartpos_employees.name AS employee, smartpos_customers.name AS customer');
        $this->db->from('smartpos_project_meta');
        $this->db->where('smartpos_project_meta.pid', $id);
        $this->db->where('smartpos_project_meta.meta_key', 13);
        $this->db->join('smartpos_employees', 'smartpos_project_meta.meta_data = smartpos_employees.id', 'left');
        $this->db->join('smartpos_customers', 'smartpos_project_meta.key3 = smartpos_customers.id', 'left');
        $this->db->order_by('smartpos_project_meta.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_comment($comment, $prid, $emp) {

        $data = array('pid' => $prid, 'meta_key' => 13, 'meta_data' => $emp, 'value' => $comment . '<br><small>@' . date('Y-m-d H:i:s') . '</small>');
        if ($prid) {
            return $this->db->insert('smartpos_project_meta', $data);
        } else {
            return 0;
        }
    }

    public function progress($id, $val) {
        if ($val == 100)
            $stat = 'Finished';
        else
            $stat = 'Progress';
        $data = array('status' => $stat, 'progress' => $val);
        $this->db->set($data);
        $this->db->where('id', $id);
        return $this->db->update('smartpos_projects');
    }

    public function task_stats($id) {
        $query = $this->db->query("SELECT
				COUNT(IF( status = 'Due', id, NULL)) AS Due,
				COUNT(IF( status = 'Progress', id, NULL)) AS Progress,
				COUNT(IF( status = 'Done', id, NULL)) AS Done
				FROM smartpos_todolist WHERE related=1 AND rid=$id");

        echo json_encode($query->result_array());
    }

    public function list_project_employee($id) {
        $this->db->select('smartpos_employees.*');
        $this->db->from('smartpos_project_meta');
        $this->db->where('smartpos_project_meta.pid', $id);
        $this->db->where('smartpos_project_meta.meta_key', 19);
        $this->db->join('smartpos_employees', 'smartpos_employees.id = smartpos_project_meta.meta_data', 'left');
        $this->db->join('smartpos_users', 'smartpos_employees.id = smartpos_users.id', 'left');
        $this->db->order_by('smartpos_users.roleid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function list_project_time($id) {
        $this->db->select('smartpos_employees.*,smartpos_project_meta.key4');
        $this->db->from('smartpos_project_meta');
        $this->db->where('smartpos_project_meta.pid', $id);
        $this->db->where('smartpos_project_meta.meta_key', 29);
        $this->db->join('smartpos_employees', 'smartpos_employees.id = smartpos_project_meta.meta_data', 'left');
        $this->db->join('smartpos_users', 'smartpos_employees.id = smartpos_users.id', 'left');
        $this->db->order_by('smartpos_users.roleid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    private function communication($id, $sub) {

        $this->db->select('smartpos_projects.name as pname,smartpos_projects.ptype,smartpos_customers.name as cust,smartpos_customers.email');
        $this->db->from('smartpos_projects');
        $this->db->where('smartpos_projects.id', $id);
        $this->db->join('smartpos_customers', "smartpos_customers.id = smartpos_projects.cid", 'left');
        $query = $this->db->get();
        $result = $query->row_array();

        if ($result['ptype'] == '1') {
            $this->db->select('smartpos_users.email,smartpos_users.username');
            $this->db->from('smartpos_project_meta');
            $this->db->where('smartpos_project_meta.pid', $id);
            $this->db->where('smartpos_project_meta.meta_key', 19);
            $this->db->join('smartpos_users', "smartpos_project_meta.meta_data = smartpos_users.id", 'left');
            $query = $this->db->get();
            $result_c = $query->result_array();
            $message = '<h3>Dear Project Participant,</h3>
                        <p>This is an update mail regarding your project ' . $result['pname'] . '</p> <p>A new task has been added ' . $sub . '</p><p>With Reagrds,<br>Project Communication Manager';
            foreach ($result_c as $row) {
                $this->send_email($row['email'], $row['username'], '[Task Added]' . $sub, $message);
            }
        } else if ($result['ptype'] == '2') {

            $this->db->select('smartpos_users.email,smartpos_users.username');
            $this->db->from('smartpos_project_meta');
            $this->db->where('smartpos_project_meta.pid', $id);
            $this->db->where('smartpos_project_meta.meta_key', 19);
            $this->db->join('smartpos_users', "smartpos_project_meta.meta_data = smartpos_users.id", 'left');
            $query = $this->db->get();
            $result_c = $query->result_array();
            $message = '<h3>Dear Project Participant,</h3>
                        <p>This is an update mail regarding your project ' . $result['pname'] . '</p> <p>A new task has been added <strong>' . $sub . '</strong></p><p>With Regards,<br>Project Communication Manager</p>';
            foreach ($result_c as $row) {
                $this->send_email($row['email'], $row['username'], '[Task Added] ' . $sub, $message);
            }

            $message = '<h3>Dear Customer,</h3>
                        <p>This is an update mail regarding your project ' . $result['pname'] . '</p> <p>A new task has been added <strong>' . $sub . '</strong></p><p>With Warm Regards,<br>Project Communication Manager</p>';

            $this->send_email($result['email'], $result['cust'], '[Task Added] ' . $sub, $message);
        }
    }

    private function send_email($mailto, $mailtotitle, $subject, $message, $attachmenttrue = false, $attachment = '') {
        $this->load->library('ultimatemailer');
        $this->db->select('host,port,auth,auth_type,username,password,sender');
        $this->db->from('smartpos_smtp');
        $query = $this->db->get();
        $smtpresult = $query->row_array();
        $host = $smtpresult['host'];
        $port = $smtpresult['port'];
        $auth_type = $smtpresult['auth_type'];
        $auth = $smtpresult['auth'];
        $username = $smtpresult['username'];
        ;
        $password = $smtpresult['password'];
        $mailfrom = $smtpresult['sender'];
        $mailfromtilte = $this->config->item('ctitle');

        $this->ultimatemailer->bin_send($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto, $mailtotitle, $subject, $message, $attachmenttrue, $attachment);
    }

    public function clockin($id, $eid) {
        $this->db->select('*');
        $this->db->where('pid', $id);
        $this->db->where('meta_key', 29);
        $this->db->where('meta_data', $eid);
        $this->db->from('smartpos_project_meta');
        $query = $this->db->get();
        $emp = $query->row_array();
        if (!$emp['key3'] AND $emp['pid']) {
            $this->db->set('value', time());
            $this->db->set('key3', 1);
            $this->db->where('id', $emp['id']);
            $this->db->update('smartpos_project_meta');
            $this->aauth->applog("[Employee ClockIn]  Project ID $id", $this->aauth->get_user()->username);
        } else if (!$emp['key3'] AND!$emp['pid']) {
            $total_time = time();
            $data = array(
                'pid' => $id,
                'meta_key' => 29,
                'meta_data' => $eid,
                'value' => $total_time,
                'key3' => 1,
                'key4' => 0,
            );
            $this->db->insert('smartpos_project_meta', $data);
            $this->aauth->applog("[Employee ClockIn]  Project ID $id", $this->aauth->get_user()->username);
        }
        return true;
    }

    public function clockout($id, $eid) {

        $this->db->select('*');
        $this->db->where('pid', $id);
        $this->db->where('meta_key', 29);
        $this->db->where('meta_data', $eid);
        $this->db->from('smartpos_project_meta');
        $query = $this->db->get();
        $emp = $query->row_array();
        if ($emp['key3'] AND $emp['pid']) {
            $total_time = time() - $emp['value'];
            $this->db->set('key4', "key4+$total_time", FALSE);
            $this->db->set('value', 0);
            $this->db->set('key3', 0);
            $this->db->where('id', $emp['id']);
            $this->db->update('smartpos_project_meta');
            $this->aauth->applog("[Employee ClockOut]  Project ID $id", $this->aauth->get_user()->username);
        }
        return true;
    }

}
