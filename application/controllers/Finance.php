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

    public function projectstaffpayment(){

        $head['title'] = "Project Staff Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/projectstaffpayment');
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
    public function cashbondpayment()
    {
        $head['title'] = "Cashbond Payment";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('finance/cashbondpayment');
        $this->load->view('fixed/footer');
    }
}