<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ledger extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }
        $this->load->model('accounts_model');
        $this->load->model('ledger_model');
        $this->load->model('data_model', 'dmodel');
    }
    
    public function index(){
        $id = $this->input->get('id');

        $head['title'] = "Ledger";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        //$data['ledger'] = $this->dmodel->get('ledger', ['account_id', $id]);
        $account = $this->dmodel->get('accounts', ['id', $id]);
        $data['id'] = $id;
        $data['title'] = $account['code'].' - '.$account['name'];
        $this->load->view('fixed/header', $head);
        $this->load->view('ledger/index', $data);
        $this->load->view('fixed/footer');
    }

    public function ajax_list(){
        $id = $this->input->post('ledger_id');
        $data = array();
        $output = array();
        $list = $this->ledger_model->get_datatables($id);
        foreach($list as $led){
            $row = array();
            $name = '';
            if($led->customer_id != 0){
                
            }
            $row[] = $led->id;
            $row[] = date('d-M-Y', strtotime($prd->created_at));
            $row[] = $led->code;
            $row[] = date('d-M-Y', strtotime($prd->tanggal));
            $row[] = $led->deskripsi;
            $row[] = $name;
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->ledger_model->count_all(),
            "recordsFiltered" => $this->ledger_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}