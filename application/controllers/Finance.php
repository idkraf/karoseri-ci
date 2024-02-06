<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Finance extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }
        $this->load->model('warehouse_model');
        $this->load->model('accounts_model');
        $this->load->model('cashbond_model');
        $this->load->model('employee_model');
        $this->load->model('data_model', 'dmodel');
    }

    
    public function purchase()
    {
        //data dari tabel smartpos_purchase - buat baru tabel purchase dan purchase item
        //

        $head['title'] = "Purchase";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/purchase');
        $this->load->view('fixed/footer');
    }
    public function purchasepayment_add()
    {
        //di klik dari https://gkcv.kotaawan.com/finance/purchase
        //sample https://gkcv.kotaawan.com/finance/purchasepayment_add
    }

    public function purchasepayment()
    {
        $head['title'] = "Purchase Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/purchasepayment');
        $this->load->view('fixed/footer');
    }

    
    public function purchasepayment_edit()
    {
        //di klik dari https://gkcv.kotaawan.com/finance/purchasepayment
        //sample https://gkcv.kotaawan.com/finance/purchasepayment_edit
        
    }
    public function project()
    {
        //data dari tabel


        $head['title'] = "Project";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/project');
        $this->load->view('fixed/footer');
    }
    
    public function payment()
    {
        $head['title'] = "Project Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/projectpayment');
        $this->load->view('fixed/footer');
    }
    function payment_edit()
    {
        //data dari tabel


        $head['title'] = "Project";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/projectpayment_edit');
        $this->load->view('fixed/footer');
    }
    
    public function staff()
    {
        //data dari tabel smartpos_produksi_staff
        //link: finance/staff
        //kode: RSTA
        //status: unposting bisa edit dan ke projectstaffpayment_add

        $head['title'] = "Staff";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/staff');
        $this->load->view('fixed/footer');
    }
    public function projectstaffpayment(){

        $head['title'] = "Project Staff Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/projectstaffpayment');
        $this->load->view('fixed/footer');
    }
    
    public function projectstaffpayment_add(){        
        //di klik dari https://gkcv.kotaawan.com/finance/staff
        //sample https://gkcv.kotaawan.com/finance/projectstaffpayment_add
        //pilih code dari list staff
        //simpan ke table smartpos_produksi_payment kode:PTEK
        
        $head['title'] = "Staff";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/projectstaffpayment_add');
        $this->load->view('fixed/footer');
    }

    public function projectstaffpayment_edit(){        
        //di klik dari https://gkcv.kotaawan.com/finance/projectstaffpayment
        //sample https://gkcv.kotaawan.com/finance/projectstaffpayment_edit
        //pilih code dari list staff
        //simpan ke table smartpos_produksi_payment kode:PTEK
        
        $head['title'] = "Staff";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/projectstaffpayment_edit');
        $this->load->view('fixed/footer');
    }
    
    public function receive()
    {
        $head['title'] = "Receive";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/receive');
        $this->load->view('fixed/footer');
    }
    public function receive_add()
    {
        $head['title'] = "Receive Add";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/receive_add');
        $this->load->view('fixed/footer');
    }
    
    public function receive_edit()
    {
        $head['title'] = "Receive Edit";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/receive_edit');
        $this->load->view('fixed/footer');
    }
    public function cost()
    {
        $head['title'] = "Cost";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/cost');
        $this->load->view('fixed/footer');
    }


    public function cashbond()
    {
        $head['title'] = "Cashbond";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/cashbond');
        $this->load->view('fixed/footer');
    }
    public function cashbond_add()
    {
        $head['title'] = "Cashbond";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/cashbond_add');
        $this->load->view('fixed/footer');
    }

    public function api_cashbond(){             
        $output = array();        
        $list = $this->cashbond_model->get_datatables();
        foreach ($list as $prd) {

            //item
            $staff = $this->dmodel->get('smartpos_employees', ['id', $prd->staff_id]);
            $account = $this->dmodel->get('accounts', ['id', $prd->account_id]);
            $row = array();
            $total = $prd->total;
            $payment = $prd->payment;
            $balance = $total - $payment;
            //status
            $row[] = $prd->code;
            $row[] = $prd->tanggal;
            $row[] = $staff['name'];
            $row[] = $prd->description;
            $row[] = $account['name'];
            $row[] = $total;
            $row[] = $payment;
            $row[] = $balance;
            $row[] = $prd->status == 1 ? '<button class="btn btn-sm btn-warning" onclick="showPayment('.$prd->id.'); return false;">
                <i class="fa fa-money-bill fa-sm"></i></button>':
                '<button class="btn btn-sm btn-warning" disabled>
                <i class="fa fa-ban fa-sm"></i></button>';
            
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->cashbond_model->count_all(),
            "recordsFiltered" => $this->cashbond_model->count_filtered(),
            "data" => $data,
            'status' => true,
        );

        echo json_encode($output);
    }

    public function api_cashbond_add(){
                     
        $output = array();

        //get data staff
        $staff = $this->dmodel->get('smartpos_employees', null, ['status'=>0]);   
        foreach ($staff as $srv) {
            //dari tabel smartpos_stock_r_items
            $row1 = array();
            //$row1['id'] = $srv->id;
            //$row1['code'] = $srv->code;
            //$row1['name'] = $srv->name;
            $row1['id'] = $srv['id'];
            $row1['code'] = $srv['code'];
            $row1['name'] = $srv['name'];
            //array_push($output['_staff'], $row1);
            $output['_staff'][] = $row1;
        }
        
        //get data account 
        //acount gabung 11100 - cash dan 11200 - bank
        $ac1 = $this->dmodel->get('accounts', null, ['sub'=> 3]);   
        foreach ($ac1 as $srv) {
            //dari tabel smartpos_stock_r_items
            $row2 = array();
            $row2['id'] = $srv['id'];
            $row2['code'] = $srv['code'];
            $row2['name'] = $srv['name'];
            //array_push($output['_account'], $row2);
            $output['_account'][] = $row2;
        }
        $ac2 = $this->dmodel->get('accounts', null, ['sub'=> 7]);   
        foreach ($ac2 as $srv) {
            //dari tabel smartpos_stock_r_items
            $row3 = array();
            $row3['id'] = $srv['id'];
            $row3['code'] = $srv['code'];
            $row3['name'] = $srv['name'];
            //array_push($output['_account'], $row3);
            $output['_account'][] = $row3;
        }
        $output['status'] = 1;

        echo json_encode($output);
    }

    public function api_cashbond_save(){

    }

    public function cashbondpayment()
    {
        $head['title'] = "Cashbond Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/cashbondpayment');
        $this->load->view('fixed/footer');
    }
    
    public function cashbondpayment_add()
    {
        $head['title'] = "Cashbond Payment Add";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/cashbondpayment_add');
        $this->load->view('fixed/footer');
    }

    public function api_cashbondpayment_add(){

    }

    public function api_cashbondpayment_save(){

    }
}