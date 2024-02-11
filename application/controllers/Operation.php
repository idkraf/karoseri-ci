<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operation extends CI_Controller
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
        $this->load->model('purchase_model');
        $this->load->model('purchase_payment_model');
        $this->load->model('data_model', 'dmodel');
    }

    public function purchase()
    {
        
        $head['title'] = "Purchase";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Purchase";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/purchase', $data);
        $this->load->view('fixed/footer');
    }
    public function posting_purchase(){}
    public function ajax_purchase_list(){

        $min = $this->input->post('min');
        $max = $this->input->post('max');
        $st = $this->input->post('status');   
        $data = array();    
        $output = array();
        
        $list = $this->purchase_model->get_datatables(0, $min, $max, $st);
        foreach ($list as $prd) {
            $total = 0;
            $row = array();
            //item
            $product = $this->purchase_model->purchase_products($prd->id);   
            foreach ($product as $srv) {
                $total += $srv['subtotal'];
            }
            $row[] = $prd->code;
            $row[] = dateformat($prd->date);
            $row[] = dateformat($prd->datedue);
            $row[] = $prd->name;
            $row[] = number_format($total, 4, ".", ".");
            $row[] = number_format($prd->payment, 4, ".", ".");
            $balance = $total - $prd->payment;
            //if($balance < 0) $balance = 0;
            $row[] = number_format($balance, 4, ".", ".");
            $row[] = $prd->posting == 1 ?'<button class="btn btn-sm bg-gray" disabled=""><i class="fa fa-unlock fa-sm"></i></button>'
            :'<button class="btn btn-sm bg-danger" disabled=""><i class="fa fa-ban fa-sm"></i></button>';//1:posting 2:unposting
            
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->purchase_model->count_all(),
            "recordsFiltered" => $this->purchase_model->count_filtered(),
            "data" => $data,
            'status' => true,
        );

        echo json_encode($output);
    }
    
    public function purchasepayment()
    {
        
        $head['title'] = "Purchase Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Purchase Payment";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/purchasepayment', $data);
        $this->load->view('fixed/footer');
    }
    public function posting_purchase_payment(){
        //update posting

    }    
    public function ajax_purchase_payment_list(){

        $min = $this->input->post('min');
        $max = $this->input->post('max');
        $st = $this->input->post('status');
        $data = array();
        $output = array();
        
        $list = $this->purchase_payment_model->get_datatables(0, $min, $max, $st);
        foreach ($list as $prd) {
            $row = array();
            $row[] = $prd->ppcode;
            $row[] = dateformat($prd->pdate);
            $row[] = dateformat($prd->pdatedue);
            $row[] = $prd->name;
            $row[] = number_format($prd->ptotal, 4, ".", ".");
            $row[] = number_format($prd->discount, 4, ".", ".");
            $row[] = number_format($prd->ppayment, 4, ".", ".");
            $row[] = $prd->posting == 1 ?'<button data-object-id="' . $prd->idp . '" class="btn btn-sm bg-success delete-object"><i class="fa fa-lock fa-sm"></i></button>'
            :'<button class="btn btn-sm bg-danger" disabled=""><i class="fa fa-ban fa-sm"></i></button>';//1:posting 2:unposting
            
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->purchase_payment_model->count_all(),
            "recordsFiltered" => $this->purchase_payment_model->count_filtered(),
            "data" => $data != null ? $data : [] ,
            'status' => true,
        );

        echo json_encode($output);
    }

    public function stockin()
    {
        
        $head['title'] = "Stock In";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Stock In";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/stockin', $data);
        $this->load->view('fixed/footer');
    }
    public function return()
    {
        
        $head['title'] = "Return";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Return";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/return', $data);
        $this->load->view('fixed/footer');
    }
    public function project()
    {
        
        $head['title'] = "Project";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Project";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/project', $data);
        $this->load->view('fixed/footer');
    }
    public function projectpayment()
    {
        
        $head['title'] = "Project Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Project Payment";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/projectpayment', $data);
        $this->load->view('fixed/footer');
    }
    public function stockout()
    {
        
        $head['title'] = "Stock Out";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Stock Out";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/stockout', $data);
        $this->load->view('fixed/footer');
    }
    public function staff()
    {
        
        $head['title'] = "Staff";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Staff";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/staff', $data);
        $this->load->view('fixed/footer');
    }
    public function cashbond()
    {
        
        $head['title'] = "Cashbond";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Cashbond";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/cashbond', $data);
        $this->load->view('fixed/footer');
    }
    public function cashbondpayment()
    {
        
        $head['title'] = "Cashbond Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Cashbond Payment";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/cashbondpayment', $data);
        $this->load->view('fixed/footer');
    }
    public function opname()
    {
        
        $head['title'] = "Opname";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Opname";
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('operation/opname', $data);
        $this->load->view('fixed/footer');
    }
}