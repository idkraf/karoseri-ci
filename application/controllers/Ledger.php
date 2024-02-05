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
        $this->load->model('data_model', 'dmodel');
    }
}