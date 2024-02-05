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