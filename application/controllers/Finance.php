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
        $this->load->model('payment_staff_model');
        $this->load->model('data_model', 'dmodel');
        $this->load->model('purchase_model');
        $this->load->model('purchase_payment_model');
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


    public function purchase_list(){
        $output = array();
        
        $purchase_id = intval($this->input->get('id'));
        
        $pid = intval($this->input->post('id'));
        //table smartpos_stock_r
        $list = $this->purchase_model->get_datatables($purchase_id, 0, 0, 0);
        $data = array();
        foreach ($list as $prd) {
            $total = $prd->total;
            $payment = $prd->payment;
            $balance = $total - $payment;
            $row = array();
            $row2 = array();

            $row[] = $prd->code;
            $row[] = '';
            $row[] = dateformat($prd->date);
            $row[] = $prd->name;
            $row[] = dateformat($prd->datedue);
            //$row[] = $prd->name;
            $row[] = $total;
            $row[] = $payment;
            $row[] = $balance;
            $row[] = '<button 
            data-view-id="' . $prd->id . '"
            data-view-name="'.$prd->name.'"
            data-view-code="'.$prd->code.'" 
            data-view-total="'.$prd->total.'"
            data-view-payment="'.$prd->payment.'"
            data-view-date="'.$prd->date.'"
            data-view-duedate="'.$prd->duedate.'"
            class="btn btn-sm btn-warning pilih-purchase"
            data-toggle="modal" data-target="#dataPurchase" data-dismiss="modal">
            <i class="fa fa-share fa-sm"></i></button>';
            
            $data[] = $pid == $prd->id ? $row2 : $row;
        }
        $output = array(
            "recordsTotal" => $this->purchase_model->count_all(),
            "recordsFiltered" => $this->purchase_model->count_filtered(),
            "data" => $data,
            'status' => true,
        );

        echo json_encode($output);
    }
    public function api_purchase(){
        $output = array();
        //table smartpos_stock_r
        $list = $this->purchase_model->get_datatables();
        foreach ($list as $prd) {
            $total = $prd->total;
            $payment = $prd->payment;
            $balance = $total - $payment;
            $row = array();
            $row[] = $prd->code;
            $row[] = dateformat($prd->date);
            $row[] = dateformat($prd->datedue);
            $row[] = $prd->name;
            $row[] = $total;
            $row[] = $payment;
            $row[] = $balance;
            $row[] = '<button class="btn btn-sm btn-warning" 
            onclick="showAdd('.$prd->id.'); return false;">
            <i class="fa fa-money fa-sm"></i></button>';
            
            $data[] = $row;
        }
        $output = array(
            "pages" => $this->purchase_model->count_all(),
            "rows" => $this->purchase_model->count_filtered(),
            "recordsTotal" => $this->purchase_model->count_all(),
            "recordsFiltered" => $this->purchase_model->count_filtered(),
            "data" => $data,
            'status' => true,
        );

        echo json_encode($output);
    }

    public function purchasepayment_add()
    {
        
        $purchase_id = intval($this->input->get('id'));
        //di klik dari https://gkcv.kotaawan.com/finance/purchase
        //sample https://gkcv.kotaawan.com/finance/purchasepayment_add
        $head['title'] = "Purchase Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data = array();
        $data['purchase'] = $this->purchase_model->purchase_details($purchase_id);
        $ac1 = $this->dmodel->get('accounts', null, ['sub'=> 3]);   
        foreach ($ac1 as $srv) {
            $row2 = array();
            $row2['id'] = $srv['id'];
            $row2['code'] = $srv['code'];
            $row2['name'] = $srv['name'];
            $data['account'][] = $row2;
        }
        $ac2 = $this->dmodel->get('accounts', null, ['sub'=> 7]);   
        foreach ($ac2 as $srv) {
            $row3 = array();
            $row3['id'] = $srv['id'];
            $row3['code'] = $srv['code'];
            $row3['name'] = $srv['name'];
            $data['account'][] = $row3;
        }

        $this->load->view('fixed/header', $head);
        $this->load->view('finance/purchasepayment_add', $data);
        $this->load->view('fixed/footer');
    }

    public function purchasepayment()
    {
        $head['title'] = "Purchase Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/purchasepayment');
        $this->load->view('fixed/footer');
    }
    public function api_purchasepayment(){
        $data = array();
        //$data['purchase'] = $this->purchase_model->purchase_details($purchase_id);
        $ac1 = $this->dmodel->get('accounts', null, ['sub'=> 3]);   
        foreach ($ac1 as $srv) {
            $row2 = array();
            $row2['id'] = $srv['id'];
            $row2['code'] = $srv['code'];
            $row2['name'] = $srv['name'];
            $data['account'][] = $row2;
        }
        $ac2 = $this->dmodel->get('accounts', null, ['sub'=> 7]);   
        foreach ($ac2 as $srv) {
            $row3 = array();
            $row3['id'] = $srv['id'];
            $row3['code'] = $srv['code'];
            $row3['name'] = $srv['name'];
            $data['account'][] = $row3;
        }
        $data['status'] = 1;
        return $data;
    }
    public function api_purchasepayment_search(){
        
        $output = array();
        $paging = $this->input->post('search_p');
        $search = $this->input->post('search_name');
        $min = $this->input->post('search_date1');
        $max = $this->input->post('search_date2');
        $posting = $this->input->post('search_posting');
        $list = $this->purchase_payment_model->get_datatables($search, $min, $max, $posting, $paging);
        //$list = $this->purchase_payment_model->get_datatables();
        foreach ($list as $prd) {
            $row = array();
            $total = $prd->total;
            $payment = $prd->payment;
            $row['id'] = $prd->idp;
            $row['code'] = $prd->ppcode;
            $row['date'] = dateformat($prd->date);
            $row['datedue'] = dateformat($prd->datedue);
            $row['supplier_name'] = $prd->name;
            $row['account_name'] = $prd->aname;
            $row['total'] = $total;
            $row['payment'] = $payment;
            $row['discount'] = $prd->discount;
            
            $purchase = $this->dmodel->get('purchase', null, ['id' => $prd->purchase_id]);
            foreach($purchase as $p){
                $row1 = array();   
                $row1['purchas_code'] = $p['code'];
                $row1['purchase_date'] = dateformat($p['date']);
                $row1['total'] = $p['total'];
                $row1['payment'] = $p['payment'];
                //array_push();
                $row['detail'][] = $row1;
            }
            
            $data[] = $row;
        }
        $output = array(
            "pages" => $this->purchase_payment_model->count_all(),
            "rows" => $this->purchase_payment_model->count_filtered(),
            "data" => $data != null ? $data : [],
            'status' => true,
        );

        echo json_encode($output);
    }

    public function api_purchasepayment_delete(){

    }

    
    public function purchasepayment_edit()
    {
        //di klik dari https://gkcv.kotaawan.com/finance/purchasepayment
        //sample https://gkcv.kotaawan.com/finance/purchasepayment_edit
        
        $purchase_id = intval($this->input->get('id'));
        //di klik dari https://gkcv.kotaawan.com/finance/purchase
        //sample https://gkcv.kotaawan.com/finance/purchasepayment_add
        $head['title'] = "Edit Purchase Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data = array();
        $data['purchase'] = $this->purchase_model->purchase_details($purchase_id);
        $ac1 = $this->dmodel->get('accounts', null, ['sub'=> 3]);   
        foreach ($ac1 as $srv) {
            $row2 = array();
            $row2['id'] = $srv['id'];
            $row2['code'] = $srv['code'];
            $row2['name'] = $srv['name'];
            $data['account'][] = $row2;
        }
        $ac2 = $this->dmodel->get('accounts', null, ['sub'=> 7]);   
        foreach ($ac2 as $srv) {
            $row3 = array();
            $row3['id'] = $srv['id'];
            $row3['code'] = $srv['code'];
            $row3['name'] = $srv['name'];
            $data['account'][] = $row3;
        }

        $this->load->view('fixed/header', $head);
        $this->load->view('finance/purchasepayment_edit', $data);
        $this->load->view('fixed/footer');
    }

    //end purchase payment

    //start project
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

    public function api_projectstaffpayment(){

        $min = $this->input->post('search_date1');
        $max = $this->input->post('search_date2');
        $se = $this->input->post('search_name');
        $st = $this->input->get('search_posting');       
        $output = array();
        
    }
    
    public function projectstaffpayment_add(){        
        //di klik dari https://gkcv.kotaawan.com/finance/staff
        //sample https://gkcv.kotaawan.com/finance/projectstaffpayment_add
        //pilih code dari list staff
        //simpan ke table smartpos_produksi_payment kode:PTEK
        
        $head['title'] = "Project Staff Add";
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
        
        $head['title'] = "Project Staff Edit";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/projectstaffpayment_edit');
        $this->load->view('fixed/footer');
    }

    public function api_projectstaffpayment_delete(){

        if ($this->aauth->premission(11)) {
            $id = $this->input->post('deleteid');
           
            //$this->db->delete('smartpos_job', array('id' => $id));
            //echo json_encode(array('status' => '1', 'message' => $this->lang->line('DELETED')));

        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
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