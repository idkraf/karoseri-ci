<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warehouse extends CI_Controller
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
        $this->load->model('data_model', 'dmodel');
        $this->load->model('purchase_model');
        $this->load->model('purchase_item_model');
        $this->load->model('opname_model');
        $this->load->model('stock_model');
        $this->load->model('products_model');
        $this->load->model('stockreturn_model');
        $this->load->model('produksi_model');
        $this->load->model('produksi_item_model');
        $this->load->model('stockout_model');
    }

    
    public function purchase()
    {
        $head['title'] = "Purchase";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/purchase');
        $this->load->view('fixed/footer');
    }

    public function ajax_item() {
        $list = $this->produksi_item_model->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            //product_id, produksi_id, produksi_job_id,

            //$produksi = $this->dmodel->get('smartpos_produksi', ['id'=>$prd->produksi_id]);
            $customer_name = $this->dmodel->get_column('smartpos_customers', 'name', ['id'=>$prd->customer_id]);
            $vehicle_name = $this->dmodel->get_column('smartpos_vehicle', 'name', ['id'=>$prd->vehicle_id]);
            $stockin = $prd->qty - $prd->indent;

            $row[] = '';//kode diawalai dengan kata TPU  -- belum ditemukan dari mana
            $row[] = $prd->date;//tgl produksi
            $row[] = $customer_name;//nama customer
            $row[] = $vehicle_name;//nama vehicle
            $row[] = $prd->name;//nama job
            $row[] = $prd->product_name;//nama item
            $row[] = $prd->qty;//qty
            $row[] = $stockin;//stock in dari mana/ asumsi saat ini dari table stockout (buat baru)
            $row[] = $prd->indent;//indent
            $row[] = '<a href="#" 
                data-object-product-id="'.$prd->product_id.'"  
                data-object-product-name="'.$prd->product_name.'"  
                data-object-product-code="'.$prd->product_code.'"
                data-object-request="'.$prd->product_code.' - '.$prd->product_name.'"
                data-object-customer-id="'.$prd->customer_id.'"
                data-object-customer-name="'.$customer_name.'"
                data-object-vehicle-id="'.$prd->vehicle_id.'"
                data-object-vehicle-name="'.$vehicle_name.'"
                data-object-job-id="'.$prd->produksi_job_id.'"
                data-object-job-name="'.$prd->name.'"
                data-object-qty="'.$prd->qty.'"
                data-object-indent="'.$prd->indent.'"
                class="btn btn-warning btn-sm edit-object" >
                <span class="fa fa-truck"></span></a>'; //ke purchase stockin form
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->produksi_item_model->count_all(),
            "recordsFiltered" => $this->produksi_item_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list_purchase() {
        $list = $this->purchase_item_model->get_datatables();    
        $data = array();    
        $output = array();
        foreach ($list as $prd) {
            $row = array();
            
            //status
            $row[] = $prd->code;
            $row[] = $prd->date;
            $row[] = $prd->name;            
            $row[] = $prd->product_code;
            $row[] = $prd->product_name;
            $row[] = $prd->size;
            $row[] = $prd->rcvbig;
            $row[] = $prd->size - $prd->rcvbig;
            $row[] = '<a href="' . base_url("receive_add?id=$prd->id") . '" 
            class="text-black rounded-0 btn btn-warning" style="text-decoration: none"><span class="fa fa-truck"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->purchase_item_model->count_all(),
            "recordsFiltered" => $this->purchase_item_model->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }
    
    public function stockin()
    {
        $head['title'] = "Stock In";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/stockin');
        $this->load->view('fixed/footer');
    }

    public function ajax_list_stockin() {

        $list = $this->purchase_model->get_datatables();    
        $data = array();    
        $output = array();
        foreach ($list as $prd) {
            $row = array();
            
            //status
            $row['id'] = $prd->id;
            $row['status'] = $prd->status;
            $row['posting'] = $prd->posting;//1: selesai, 2: belum selesai maka muncul edit
            $row['code2'] = $prd->code2 !=null ? $prd->code2 : '';
            $row['code'] = $prd->code;//'<a href="' . base_url("stockreturn/view?id=$prd->id") . '"><strong>&nbsp; ' . $prd->tid . '</strong></a>';
            $row['date'] = dateformat($prd->date);
            $row['supplier_name'] = $prd->name;
            
            //item  
            $product_list = $this->purchase_item_model->purchase_products($prd->id);      
            foreach ($product_list as $srv) {
                $row2 = array();
                $row2['item_code'] = $srv['product_code'];
                $row2['item_name'] = $srv['product_name'];
                $row2['size'] = $srv['size'];//$srv['size'];//size ini ngga jelas
                $row2['big'] = $srv['big'];//qty purchase
                $row2['rcvbig'] = $srv['rcvbig'];//qty masuk
                $row['detail'][] = $row2;
            }
            $data[] = $row;
        }
        $output = array(
            "pages" => $this->purchase_model->count_all(),
            "rows" => $this->purchase_model->count_filtered(),
            "data" => $data,
            'status' => true,
        );

        echo json_encode($output);
    }

    public function ajax_list_stockin_() {
        $min = $this->input->get('min');
        $max = $this->input->get('max');
        $st = $this->input->get('status');       
        $output = array();
        
        //table smartpos_stock_r
        $list = $this->stockreturn_model->get_datatables();
        foreach ($list as $prd) {

            //item
            $product = $this->stockreturn_model->purchase_products($prd->id);   
            foreach ($product as $srv) {
                //dari tabel smartpos_stock_r_items
                $row2 = array();
                $row2['item_code'] = $srv['code'];
                $row2['item_name'] = $srv['product'];
                $row2['size'] ="";//size ini ngga jelas
                $row2['big'] ="";//qty purchase
                $row2['rcvbig'] ="";//qty masuk
                array_push($row['detail'], $row2);
            }
            
            //status
            $row['id'] = $prd->id;
            $row['status'] = $prd->status;
            $row['posting'] = 1;//1: selesai, 2: belum selesai maka muncul edit
            $row['code2'] = '';
            $row['code'] = '<a href="' . base_url("stockreturn/view?id=$prd->id") . '" class="text-black rounded-0" style="text-decoration: none"><strong>&nbsp; ' . $prd->tid . '</strong></a>';
            $row['date'] = dateformat($prd->invoicedate);
            $row['supplier_name'] = $prd->name;
            
            $data[] = $row;
        }
        $output = array(
            "pages" => $this->stockreturn_model->count_all(),
            "rows" => $this->stockreturn_model->count_filtered(),
            "data" => $data,
            'status' => true,
        );

        echo json_encode($output);
    }

    public function receive()
    {
        $head['title'] = "Receive";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/receive');
        $this->load->view('fixed/footer');
    }
    
    public function return()
    {
        $head['title'] = "Return";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/return');
        $this->load->view('fixed/footer');
    }
    
    public function project()
    {
        $head['title'] = "Project";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/project');
        $this->load->view('fixed/footer');
    }
    public function projectdelivery_add()
    {
        $head['title'] = "Project Delivery to Stock out";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['title'] = "Stock out";
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/projectdelivery_add', $data);
        $this->load->view('fixed/footer');

    }

    public function ajax_modal_product(){
        $list = $this->products_model->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = $prd->product_code;
            $row[] = $prd->c_title;
            $row[] = $prd->product_name;
            $row[] = +$prd->qty;
            $row[] = $prd->unit;
            $row[] = '<a
                data-object-id="'.$prd->pid.'"  
                data-object-code="'.$prd->product_code.'"
                data-object-name="'.$prd->product_name.'"
                class="btn btn-success btn-sm pilih-produk"
                data-toggle="modal" data-target="#dataProduk">
                <span class="fa fa-edit"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->products_model->count_all('','',''),
            "recordsFiltered" => $this->products_model->count_filtered('','',''),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_project() {
        $list = $this->produksi_item_model->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            //product_id, produksi_id, produksi_job_id,

            //$produksi = $this->dmodel->get('smartpos_produksi', ['id'=>$prd->produksi_id]);
            $customer_name = $this->dmodel->get_column('smartpos_customers', 'name', ['id'=>$prd->customer_id]);
            $vehicle_name = $this->dmodel->get_column('smartpos_vehicle', 'name', ['id'=>$prd->vehicle_id]);

            $row[] = '';//kode diawalai dengan kata RITE  -- belum ditemukan dari mana
            $row[] = $prd->date;//tgl produksi
            $row[] = $customer_name;//nama customer
            $row[] = $vehicle_name;//nama vehicle
            $row[] = $prd->name;//nama job
            $row[] = $prd->product_name;//nama item
            $row[] = $prd->qty;//qty
            $row[] = '';//stock out dari mana/ asumsi saat ini dari table stockout (buat baru)
            $row[] = $prd->indent;//indent
            $row[] = '<a href="#" 
                data-object-product-id="'.$prd->product_id.'"  
                data-object-product-name="'.$prd->product_name.'"  
                data-object-product-code="'.$prd->product_code.'"
                data-object-request="'.$prd->product_code.' - '.$prd->product_name.'"
                data-object-customer-id="'.$prd->customer_id.'"
                data-object-customer-name="'.$customer_name.'"
                data-object-vehicle-id="'.$prd->vehicle_id.'"
                data-object-vehicle-name="'.$vehicle_name.'"
                data-object-job-id="'.$prd->produksi_job_id.'"
                data-object-job-name="'.$prd->name.'"
                data-object-qty="'.$prd->qty.'"
                data-object-indent="'.$prd->indent.'"
                class="btn btn-warning btn-sm edit-object" 
                data-toggle="modal" data-target="#dataAddDelivery">
                <span class="fa fa-truck"></span></a>'; //kearash stouck out form
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->produksi_item_model->count_all(),
            "recordsFiltered" => $this->produksi_item_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function stockout()
    {
        $head['title'] = "Stock Out";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/stockout');
        $this->load->view('fixed/footer');
    }
    public function ajax_list_stockout() {
        $min = $this->input->get('min');
        $max = $this->input->get('max');
        $st = $this->input->get('status');
        $list = $this->stockout_model->get_datatables($min, $max, $st);
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = $prd->code;
            $row[] = $prd->tanggal;
            $row[] = $prd->cname;
            $row[] = $prd->vname;
            $row[] = $prd->product_code;
            $row[] = $prd->product_name;
            $row[] = $prd->qty;
            $row[] = $prd->status != 1 ? '<a 
            data-object-id="'.$prd->id.'"
            class="btn btn-success btn-sm edit-object"><span class="fa fa-edit"></span></a>' : '';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->stockout_model->count_all(),
            "recordsFiltered" => $this->stockout_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function item()
    {
        $head['title'] = "Item Opname";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/item', $head);
        $this->load->view('fixed/footer');
    }

    public function ajax_list_item_opname() {
        $list = $this->products_model->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = $prd->product_code;
            $row[] = $prd->c_title;
            $row[] = $prd->product_name;
            $row[] = +$prd->qty;
            $row[] = $prd->unit;
            $row[] = '<a href="#" 
                data-object-id="'.$prd->pid.'"  
                data-object-pcat="'.$prd->pcat.'"
                data-object-qty="'.$prd->qty.'"
                data-object-name="'.$prd->product_code.' - '.$prd->product_name.'"
                class="btn btn-success btn-sm edit-object"><span class="fa fa-edit"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->products_model->count_all('','',''),
            "recordsFiltered" => $this->products_model->count_filtered('','',''),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function insert_opname(){

        if ($this->input->post('id') != null 
            && $this->input->post('id') != "" ) {
            $data = array();
            $data['product_id'] = $this->input->post('id');
            $data['notes'] = $this->input->post('notes');
            $data['tanggal'] = $this->input->post('tanggal');
            $data['opname'] = $this->input->post('opname');
            $data['qty'] = $this->input->post('qty');
            $data['notes'] = $this->input->post('notes');

            if($this->dmodel->insert('opname', $data)){
                echo json_encode(array('status' => 'Success', 'message' => 'Opname berhasil di tambahkan'));
            }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
            }
            //$this->products_model->opname($id, $notes, $date);          
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }

    public function opname()
    {
        $head['title'] = "Opname";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/opname');
        $this->load->view('fixed/footer');
    }
    public function ajax_list_opname() {
        $min = $this->input->get('min');
        $max = $this->input->get('max');
        $st = $this->input->get('status');
        $list = $this->opname_model->get_datatables($min, $max, $st);
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = $prd->kode_opname;
            $row[] = $prd->tanggal;
            $row[] = $prd->product_name;
            $row[] = $prd->qty;
            $row[] = $prd->opname;
            $row[] = $prd->status != 1 ? '<a href="#" 
            data-object-id="'.$prd->id.'"
            class="btn btn-success btn-sm edit-object"><span class="fa fa-edit"></span></a>' : '';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->opname_model->count_all(),
            "recordsFiltered" => $this->opname_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function stock()
    {
        $head['title'] = "Stock";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/stock');
        $this->load->view('fixed/footer');
    }

    public function ajax_list_stock() {
        $id = $this->input->post('product_id');
        $list = $this->stock_model->get_datatables($id);
        $data = array();
        foreach ($list as $prd) {            
            $row = array();
            $row[] = $prd->product_code;
            $row[] = $prd->c_title;
            $row[] = $prd->product_name;
            $row[] = +$prd->qty;
            $row[] = $prd->unit;
            $row[] = '<a href="#" 
                data-object-id="'.$prd->pid.'"  
                data-object-pcat="'.$prd->pcat.'"
                data-object-qty="'.$prd->qty.'"
                data-object-name="'.$prd->product_code.' - '.$prd->product_name.'"
                class="btn btn-success btn-sm edit-object"><span class="fa fa-edit"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->stock_model->count_all(),
            "recordsFiltered" => $this->stock_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function history()
    {
        $head['title'] = "History";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $this->load->view('fixed/header', $head);
        $this->load->view('warehouse/history');
        $this->load->view('fixed/footer');
    }
}