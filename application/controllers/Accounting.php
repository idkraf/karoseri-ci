<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting extends CI_Controller
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
        $this->load->model('balance_model');
        $this->load->model('data_model', 'dmodel');
    }

    public function ledger()
    {
    }
    
    public function account()
    {
        $head['title'] = "Account";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['akun'] = $this->dmodel->get('accounts');
        
        $this->load->view('fixed/header', $head);
        $this->load->view('accounting/account', $data);
        $this->load->view('fixed/footer');
    }
    
    public function ajax_list_account() {
        $list = $this->accounts_model->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = $prd->code;
            $row[] = $prd->level;
            $row[] = $prd->name;
            $row[] = $prd->status == 1 ? "Show" : "Hide";
            $row[] = '<a href="#" 
                data-object-id="'.$prd->id.'"  
                data-object-sub="'.$prd->sub.'"
                data-object-code="'.$prd->code.'"
                data-object-level="'.$prd->level.'"
                data-object-name="'.$prd->name.'"
                data-object-show="'.$prd->status.'" 
                class="btn btn-success btn-sm edit-object"><span class="fa fa-edit"></span></a> 
            <a href="#" data-object-id="'.$prd->id.'" class="btn btn-danger btn-sm delete-object"><span class="fa fa-minus"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->accounts_model->count_all(),
            "recordsFiltered" => $this->accounts_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function create_account(){

        if ($this->input->post('name') != null 
            && $this->input->post('name') != "" ) {
            $sub = $this->input->post('sub', true);
            $code = $this->input->post('code', true);
            $level = $this->input->post('level', true);
            $name = $this->input->post('name', true);
            $status = $this->input->post('status', true);
            $this->accounts_model->add_account($sub, $code, $level, $name, $status);          
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function update_account(){
        if ($this->input->post('editid') != null && $this->input->post('editid') != "" ) {
            $id = $this->input->post('editid');
            $sub = $this->input->post('sub', true);
            $code = $this->input->post('code', true);
            $level = $this->input->post('level', true);
            $name = $this->input->post('name', true);
            $status = $this->input->post('status', true);
            $this->accounts_model->update_account($id, $sub, $code,$level,$name,$status);          
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function delete_account() {
        if ($this->aauth->premission(11)) {
            $id = $this->input->post('deleteid');
           
            $this->db->delete('smartpos_job', array('id' => $id));
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));

        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    //end account
    
    //start jurnal    
    public function jurnal()
    {
        $head['title'] = "Journal";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('accounting/jurnal');
        $this->load->view('fixed/footer');
    }   
    
    public function ajax_list_jurnal() {
    }
    public function create_jurnal(){

    }
    public function update_jurnal(){

    }
    public function delete_jurnal() {
        if ($this->aauth->premission(11)) {
            $id = $this->input->post('deleteid');
           
            $this->db->delete('jurnal', array('id' => $id));
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));

        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    //end jurnal
    //start proitloss  
    public function profitloss()
    {
        $head['title'] = "Profil/Loss";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('accounting/profitloss');
        $this->load->view('fixed/footer');
    }

    //end proitloss
    //balance sheet  
    public function balancesheet()
    {
        $head['title'] = "Balance Sheet";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('accounting/balancesheet');
        $this->load->view('fixed/footer');
    }

    public function api_balancesheet(){

    }

    public function api_balancesheet_search(){
        $data = $array();
        $output = $array();
        $list1 = $this->account_model->get_datatables();        
        foreach($list1 as $lis){
            //$list1 = $this->balance_model->get_datatables();
            $leds = $this->ledger_model->get_datatables($lis->id);
            foreach($leds as $led){
                //$account_name = $this->dmodel->get_column('accounts','name',['id'=>1]);
                $row = $array();
                $row['account_show'] = $lis->level != 3 ? 1 : 3; //1=click to ledger
                $row['description'] = $list->name;//$account_name;//.'-'.$led->deskripsi;
                $row['account_id'] = $led->account_id;
                $row['debit'] = $led->debit;
                $row['total'] = $led->credit;
                $row['balance'] = +$led->credit;
                
                $data = $row;
            }
        }
        
        $output = array(
            "data1" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    //end balancesheet
    //sop purchase
    public function soppurchase()
    {
        $head['title'] = "Sop Purchase";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['hutang'] = $this->dmodel->get('accounts', null, ['sub'=> 16]);
        $data['persediaan'] = $this->dmodel->get('accounts', null, ['sub'=> 33]);
        $data['pembelian'] = $this->dmodel->get('accounts', null, ['sub'=> 33]);
        $data['pajak'] = $this->dmodel->get('accounts', null, ['sub'=> 23]);
        $data['discount'] = $this->dmodel->get('accounts', null, ['sub'=> 20]);
        
        $data['payable_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 1]);
        $data['purchase_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 2]);
        $data['discount_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 3]);
        $data['taxes_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 4]);
        $data['inventory_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 5]);
        $this->load->view('fixed/header', $head);
        $this->load->view('accounting/soppurchase', $data);
        $this->load->view('fixed/footer');
    }
    
    public function update_sop_purchase()
    {
        $payable =$this->input->post('payable_id');
        $purchase =$this->input->post('purchase_id');
        $disc =$this->input->post('discount_id');
        $tax =$this->input->post('taxes_id');
        $inventory =$this->input->post('inventory_id');
        
        $this->dmodel->update('accounts_config', 'id', 1, ['accounts_id'=>$payable]);
        $this->dmodel->update('accounts_config', 'id', 2, ['accounts_id'=>$purchase]);
        $this->dmodel->update('accounts_config', 'id', 3, ['accounts_id'=>$disc]);
        $this->dmodel->update('accounts_config', 'id', 4, ['accounts_id'=>$tax]);
        $this->dmodel->update('accounts_config', 'id', 5, ['accounts_id'=>$inventory]);   

        redirect(base_url('accounting/soppurchase'));

    } 
    //sop purchaprojectse
    public function sopproject()
    {
        $head['title'] = "Sop Project";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['receivable'] = $this->dmodel->get('accounts', null, ['sub'=> 72]);
        $data['sale'] = $this->dmodel->get('accounts', null, ['sub'=> 47]);
        $data['discount'] = $this->dmodel->get('accounts', null, ['sub'=> 54]);
        $data['pajak'] = $this->dmodel->get('accounts', null, ['sub'=> 23]);
        $data['inventory'] = $this->dmodel->get('accounts', null, ['sub'=> 33]);
        $data['cogs'] = $this->dmodel->get('accounts', null, ['sub'=> 52]);
        $data['cost'] = $this->dmodel->get('accounts', null, ['sub'=> 56]);
        
        
        $data['receivable_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 6]);
        $data['sale_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 7]);
        $data['discount_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 8]);
        $data['ppn_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 9]);
        $data['pph_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 10]);
        $data['inventory_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 11]);
        $data['cogs_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 12]);
        $data['cost_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 13]);

        $this->load->view('fixed/header', $head);
        $this->load->view('accounting/sopproject', $data);
        $this->load->view('fixed/footer');
    }
    
    public function update_sop_project()
    {
        $receivable =$this->input->post('receivable_id');
        $sale =$this->input->post('sale_id');
        $disc =$this->input->post('discount_id');
        $ppn =$this->input->post('ppn_id');
        $pph =$this->input->post('pph_id');
        $inventory =$this->input->post('inventory_id');
        $cogs =$this->input->post('cogs_id');
        $cost =$this->input->post('cost_id');
        
        $this->dmodel->update('accounts_config', 'id', 6, ['accounts_id'=>$receivable]);
        $this->dmodel->update('accounts_config', 'id', 7, ['accounts_id'=>$sale]);
        $this->dmodel->update('accounts_config', 'id', 8, ['accounts_id'=>$disc]);
        $this->dmodel->update('accounts_config', 'id', 9, ['accounts_id'=>$ppn]);
        $this->dmodel->update('accounts_config', 'id', 10, ['accounts_id'=>$pph]);
        $this->dmodel->update('accounts_config', 'id', 11, ['accounts_id'=>$inventory]);
        $this->dmodel->update('accounts_config', 'id', 12, ['accounts_id'=>$cogs]); 
        $this->dmodel->update('accounts_config', 'id', 13, ['accounts_id'=>$cost]);    

        redirect(base_url('accounting/sopproject'));

    }
    //sop opname
    public function sopopname()
    {
        $head['title'] = "Sop Opname";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['cost'] = $this->dmodel->get('accounts', null, ['sub'=> 68]);
        $data['inventory'] = $this->dmodel->get('accounts', null, ['sub'=> 33]);
        
        
        $data['inventory_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 14]);
        $data['cost_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 15]);

        $this->load->view('fixed/header', $head);
        $this->load->view('accounting/sopopname', $data);
        $this->load->view('fixed/footer');
    }
    
    public function update_sop_opname()
    {
        $inventory =$this->input->post('inventory_id');
        $cost =$this->input->post('cost_id');
        
        $this->dmodel->update('accounts_config', 'id', 14, ['accounts_id'=>$inventory]);
        $this->dmodel->update('accounts_config', 'id', 15, ['accounts_id'=>$cost]);    

        redirect(base_url('accounting/sopopname'));

    }
    //sop cashbond
    public function sopcashbond()
    {
        $head['title'] = "Sop Cashbond";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['receivable'] = $this->dmodel->get('accounts', null, ['sub'=> 15]);
        
        $data['receivable_id'] = $this->dmodel->get_column('accounts_config', 'accounts_id',['id'=> 16]);

        $this->load->view('fixed/header', $head);
        $this->load->view('accounting/sopcashbond', $data);
        $this->load->view('fixed/footer');
    }
    
    public function update_sop_cashbond()
    {
        $receivable =$this->input->post('receivable_id');
        
        $this->dmodel->update('accounts_config', 'id', 16, ['accounts_id'=>$receivable]);

        redirect(base_url('accounting/sopcashbond'));

    }
}