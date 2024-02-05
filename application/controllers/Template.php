<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }

        $this->load->model('template_model', 'vech');
        $this->load->model('template_job_model', 'tJob');

        $this->load->model('template_item_model', 'tItem');
        $this->load->model('template_staff_model', 'tStaff');
        $this->load->model('data_model', 'dmodel');
    }
    
    public function index()
    {
        $head['title'] = "Manage Template Karoseri";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['jobs'] = $this->dmodel->get('smartpos_job');
        $data['products'] = $this->dmodel->get('smartpos_products');
        $data['staff'] = $this->dmodel->get('smartpos_users');
        $this->load->view('fixed/header', $head);
        //$this->load->view('fixed/header-produksi', $head);
        $this->load->view('template/index', $data);
        $this->load->view('fixed/footer');
    }
    
    public function ajax_list() {
        $list = $this->vech->get_datatables();
        $data = array();
        $no = 0;
        foreach ($list as $prd) {
            $row = array();
            $day = 0;
            $qty = 0;
            $item = 0;
            $service = 0;
            
            //calculate    
            $jobs = $this->dmodel->getWhere('smartpos_template_job', ['template_id' => $prd->id]);            
            foreach ($jobs as $j) {
                $day += $j['day'];
                $qty += $this->dmodel->total_count('qty', ['produksi_job_id' => $j['id']], 'smartpos_template_item');
                $service += $this->dmodel->total_count('price', ['produksi_job_id' => $j['id']], 'smartpos_template_staff');
            
                $items = $this->dmodel->getWhere('smartpos_template_item', ['produksi_job_id' => $j['id']]);
                foreach ($items as $it) {
                   $harga = $this->dmodel->get_column('smartpos_products', 'fproduct_price', ['pid' => $it['product_id']]);
                  
                   $cogs = $it['qty'] * $harga;
                   $item += $cogs;
                   $subtotal += $cogs + $service;
                }
            }   
           

            if($qty == ""){
                $qty= 0;
            }
            if($item == ""){
                $item= 0;
            }
            if($service == ""){
                $service= 0;
            }

            $nama = '<a
            data-object-id="'.$prd->id.'"
            data-object-name="'.$prd->name.'"   
            data-object-price="'.$prd->price.'"
            data-object-pph="' . $prd->tax. '"
            data-object-ppn="' . $prd->taxppn. '"            
            class="produksiJob">'.$prd->name.'</a>';
            $row[] = '<a
            data-view-id="'.$prd->id.'"
            data-view-name="'.$prd->name.'"   
            data-view-price="'.$prd->price.'"
            data-view-pph="' . $prd->tax. '"
            data-view-ppn="' . $prd->taxppn. '"            
            class="btn btn-success btn-sm viewProduksi"><span class="icon-folder"></span></a>';
            $row[] = $nama;
            $row[] = $day;
            $row[] = $service;
            $row[] = $qty;
            $row[] = $item;
            $row[] = $subtotal;
            $row[] = $prd->taxppn;
            $row[] = $prd->tax;
            $row[] = '<button 
            data-edit-id="' . $prd->id . '"
            data-edit-name="'.$prd->name.'"   
            data-edit-price="'.$prd->price.'"
            data-edit-pph="' . $prd->tax. '"
            data-edit-ppn="' . $prd->taxppn. '"            
            id="edit-template" class="btn btn-sm btn-warning"><i class="fa fa-edit fa-sm"></i></button>
            <a href="#" data-object-id="'.$prd->id.'" class="btn btn-danger btn-sm delete-object"><i class="fa fa-minus fa-sm"></i></a>';
            //<a onclick="return confirm("Yakin ingin hapus?")"  href="'.base_url('template/delete').'/'.$prd->id.'" id="hapusProdukJob" class="btn btn-sm btn-danger"><i class="fa fa-minus fa-sm"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->vech->count_all(),
            "recordsFiltered" => $this->vech->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_modal_list() {
        $list = $this->vech->get_datatables();
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row[] = '<button 
            data-object-tid="' . $prd->id . '" 
            data-object-tname="' . $prd->name . '" 
            data-toggle="modal" data-target="#dataTemplate" data-dismiss="modal"            
            class="btn btn-success btn-sm pilih-template"><span class="icon-share-alt"></span></a>';
            $row[] = $prd->name;
            $row[] = $prd->price;
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->vech->count_all(),
            "recordsFiltered" => $this->vech->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    
    public function add()
    {
        if ($this->input->post('name') != null && $this->input->post('name') != "" ) {
            $name = $this->input->post('name', true);
            $price = $this->input->post('price', true);
            $tax = $this->input->post('tax');
            $taxppn = $this->input->post('taxppn');
            $this->vech->add($name, $price, $tax, $taxppn);         
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function edit()
    {
        if ($this->input->post('id') != null 
        && $this->input->post('id') != "" 
        && $this->input->post('name') != null 
        && $this->input->post('name') != "" ) {
            $id = $this->input->post('id', true);
            $name = $this->input->post('name', true);
            $price = $this->input->post('price', true);
            $tax = $this->input->post('tax');
            $taxppn = $this->input->post('taxppn');
            $this->vech->update($id, $name, $price, $tax, $taxppn);         
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    
    

    //add job
    public function add_job()
    {
        if ($this->input->post('job_id') != null && $this->input->post('job_id') != "" ) {
            $template_id = $this->input->post('template_id');
            $job_id = $this->input->post('job_id');
            $que = $this->input->post('que');
            $day = $this->input->post('day');
            
            $cek = $this->dmodel->getIfExist('smartpos_template_job', ['job_id' => $job_id, 'template_id' => $template_id]);
            if($cek){
                echo json_encode(array('status' => 'Error', 'message' => 'Job sudah dimasukkan tidak bisa duplikat, silahkan edit'));
            }else{
                $this->tJob->add($template_id,$job_id, $que, $day);     
            }    
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function edit_job()
    {
        if ($this->input->post('id') != null 
        && $this->input->post('id') != ""
        && $this->input->post('job_id') != null
        && $this->input->post('job_id') != "" ) {
            $id = $this->input->post('id');
            $template_id = $this->input->post('template_id');
            $job_id = $this->input->post('job_id');
            $que = $this->input->post('que');
            $day = $this->input->post('day');
            
            $this->tJob->update($id, $template_id, $job_id, $que, $day);     
            
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }

    
    public function ajax_modal_produksi(){
        $id = $this->input->post('produksi_id');
        $list = $this->tJob->get_datatables($id);
        $data = array();
        foreach ($list as $prd) {
            $row = array();
            $row['_position'] = array();
            $row['_item'] = array();
            
            $service = $this->tStaff->get_datatables($prd->id);       
            foreach ($service as $srv) {
                $row1 = array();
                $row1['staff_name'] = $srv->username;
                $row1['qty'] = $srv->price;
                array_push($row['_position'], $row1);
            }

            $item = $this->tItem->get_datatables($prd->id);
            foreach ($item as $it) { 
                $price = 0;
                $subtotal = 0;
                
                $price = $this->dmodel->get_column('smartpos_products', 'fproduct_price', ['pid' => $it->product_id]);
                //$price = $this->dmodel->total_count('product_price', ['pid' => $prd->product_id], 'smartpos_products');
                $subtotal = $it->qty * $price;
                $row2 = array();
                $row2['item_code'] = $it->product_code;
                $row2['item_name'] = $it->product_name;
                $row2['qty'] = $it->qty;
                $row2['price'] = $price;
                $row2['subtotal'] = $subtotal;
                array_push($row['_item'], $row2);
            }
            //calculate
            //$qty = $this->dmodel->total_count('qty', ['produksi_job_id' => $prd->job_id], 'smartpos_template_item');
            //$indent = $this->dmodel->total_count('indent', ['produksi_job_id' => $prd->job_id], 'smartpos_template_item');
            $qty = 0;
            $service = 0;
            $item = 0;
            $subtotal = 0;
            //calculate
            $qty = $this->dmodel->total_count('qty', ['produksi_job_id' => $prd->id], 'smartpos_template_item');            
            $service = $this->dmodel->total_count('price', ['produksi_job_id' => $prd->id], 'smartpos_template_staff');           
            
            $items = $this->dmodel->getWhere('smartpos_template_item', ['produksi_job_id' => $prd->id]);
            foreach ($items as $it) {
               $harga = $this->dmodel->get_column('smartpos_products', 'fproduct_price', ['pid' => $it['product_id']]);              
               $cogs = $it['qty'] * $harga;
               $item += $cogs;
               $subtotal += $cogs + $service;
            }

            if($qty == ""){
                $qty= 0;
            }
            if($item == ""){
                $item= 0;
            }
            if($service == ""){
                $service= 0;
            }

            $row['job_name'] = $prd->name;
            $row['day'] = $prd->day;
            $row['service'] = $service;
            $row['qty'] = $qty;
            $row['item'] = $item;
            $row['subtotal'] = $subtotal;
            


            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->tJob->count_all(),
            "recordsFiltered" => $this->tJob->count_filtered($id),
            "data" => $data,
            'status' => true,
        );
        //output to json format
        echo json_encode($output);
    }


    //detail    
    public function detail()
    {
        if (!$this->input->get()) {
            exit();
        }

        $data = array();
        $data['job_id'] = intval($this->input->get('id'));
        $jobid = $this->dmodel->get_column('smartpos_template_job', 'job_id', ['id' => $this->input->get('id')]);
        $data['jobname'] = $this->dmodel->get_column('smartpos_job', 'name', ['id' => $jobid]);
        $data['day'] = $this->dmodel->get_column('smartpos_template_job', 'day', ['id' => $this->input->get('id')]);
        
        $item = $this->dmodel->getWhere('smartpos_template_item', ['produksi_job_id' => $this->input->get('id')]);
        foreach ($item as $srv) {            
            $harga = $this->dmodel->get_column('smartpos_products', 'fproduct_price', ['pid' => $srv['product_id']]);
            $data['subtotal'] += $srv['qty'] * $harga;
        }
        $head['title'] = "Service & Produk dalam template";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['jobs'] = $this->dmodel->get('smartpos_job');
        $data['products'] = $this->dmodel->get('smartpos_products');
        $data['staff'] = $this->dmodel->get('smartpos_users');
        $this->load->view('fixed/header-produksi', $head);
        $this->load->view('template/detail', $data);
        $this->load->view('fixed/footer');
    }
    

    public function ajax_modal_produksi_job_list(){
        $id = $this->input->post('tid');
        $data = array();
        $list = $this->tJob->get_datatables($id);
        $no = 0;
        foreach ($list as $prd) {
            $no++;
            //calculate
            $qty = $this->dmodel->total_count('qty', ['produksi_job_id' => $prd->id], 'smartpos_template_item');            
            $service = $this->dmodel->total_count('price', ['produksi_job_id' => $prd->id], 'smartpos_template_staff');
           
            $item = 0;
            
            $items = $this->dmodel->getWhere('smartpos_template_item', ['produksi_job_id' => $prd->id]);
            //$items = $this->tItem->get_datatables($prd->id);
            foreach ($items as $it) {
               $harga = $this->dmodel->get_column('smartpos_products', 'fproduct_price', ['pid' => $it['product_id']]);
              
               //$item += $price; 
               //$item += $this->dmodel->total_count('product_price', ['pid' => $it->product_id], 'smartpos_products');

               $cogs = $it['qty'] * $harga;
               $item += $cogs;
               $subtotal += $cogs + $service;
            }
            if($qty == ""){
                $qty= 0;
            }
            if($item == ""){
                $item= 0;
            }
            if($service == ""){
                $service= 0;
            }

            $job = '<a
            href="template/detail?id='.$prd->id.'"
            data-job-id="'.$prd->job_id .'" 
            data-view-id="'.$prd->id .'"
            data-view-name="'.$prd->name.'"
            data-view-pph="'.$prd->tax.'"
            data-view-ppn="'.$prd->taxppn.'"
            >'. $prd->name .'</a>';

            $row = array();
            $row[] = $prd->que;
            $row[] = $job;
            $row[] = $prd->day;
            $row[] = $service;
            $row[] = $qty;
            $row[] = $item;
            $row[] = $subtotal;
            $row[] = '<button 
            data-jid="' . $prd->id . '"
            data-ej-id="'.$prd->job_id.'"   
            data-etid="'.$prd->template_id.'"
            data-eque="' . $prd->que. '"
            data-eday="' . $prd->day. '"            
            id="editTemplateJob" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#produksi_job_model" data-dismiss="modal"><i class="fa fa-edit fa-sm"></i></button>
            <a href="#" data-object-id="'.$prd->id.'" class="btn btn-danger btn-sm delete-object2"><i class="fa fa-minus fa-sm"></i></a>';
            //<a onclick="return confirm("Yakin ingin hapus?")"  href="'.base_url('template/delete_j').'/'.$prd->id.'" id="hapusTemplateJob" class="btn btn-sm btn-danger"><i class="fa fa-minus fa-sm"></i></a>';
            
            
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->tJob->count_all(),
            "recordsFiltered" => $this->tJob->count_filtered($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_modal_item_list(){
        $data = array();
        $no = 0;
        $id = $this->input->post('cid');

        $item = $this->tItem->get_datatables($id);
        foreach ($item as $it) { 
            $no++;
            $row = array();
            $qty = $it->qty != "" ? $it->qty : 0;
            $harga = $this->dmodel->get_column('smartpos_products', 'fproduct_price', ['pid' => $it->product_id]);
            $harga = $harga != "" ? $harga : 0;
            $cogs = $qty * $harga;

            $row[] = $no;
            $row[] = $it->product_name.' - '.$it->product_code;
            $row[] = $qty;
            $row[] = $harga;
            $row[] = $cogs;
            $row[] = '<button 
            data-eid="' . $it->id . '"
            data-eproduct-id="' . $it->product_id. '"     
            data-eqty="' . $it->qty. '"  
            id="editItemJob" class="btn btn-sm btn-warning"><i class="fa fa-edit fa-sm"></i></button>
                    <a data-item-id="'.$it->id.'" id="hapusItemJob" class="btn btn-sm btn-danger"><i class="fa fa-minus fa-sm"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "recordsTotal" => $this->tItem->count_all(),
            "recordsFiltered" => $this->tItem->count_filtered($id),
            "data" => $data,
            "id" => $id
        );
        //output to json format
        echo json_encode($output);
    }  

    public function ajax_modal_staff_list(){
        
        $data = array();
        $no = 0;
        //get data item
        $id = $this->input->post('cid');
        $service = $this->dmodel->getWhere('smartpos_template_staff', ['produksi_job_id' => $id]);
        if(isset($service)){                        
            foreach ($service as $srv) {
                $staff = $this->dmodel->get('smartpos_users', ['id' => $srv['staff_id']]);
                if(isset($staff)){ 
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $staff['username'];
                    $row[] = $srv['price'];
                   // $row[] = '';
                   // $row[] = '';
                    $row[] = '<button 
                    data-sid="' . $srv['id'] . '"
                    data-sstaff-id="' . $srv['staff_id']. '"     
                    data-sprice="' . $srv['price']. '"  
                    id="editStaffJob" class="btn btn-sm btn-warning"><i class="fa fa-edit fa-sm"></i></button>
                    <a data-staff-id="'.$srv['id'].'" id="hapusStaffJob" class="btn btn-sm btn-danger"><i class="fa fa-minus fa-sm"></i></a>';
                    $data[] = $row;
                }
            }
            
        }
        $output = array(
            "recordsTotal" => $this->tStaff->count_all(),
            "recordsFiltered" => $this->tStaff->count_filtered_1($id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);


    }


    public function add_produksi_item()
    {
        if ($this->input->post('produksi_job_id') != null && $this->input->post('produksi_job_id') != "" ) {
            $produksi_job_id = $this->input->post('produksi_job_id');
            $product_id = $this->input->post('product_id');
            $qty = $this->input->post('qty');
           
            $cek = $this->dmodel->getIfExist('smartpos_template_item', ['produksi_job_id' => $produksi_job_id, 'product_id' => $product_id]);
            if($cek){
                echo json_encode(array('status' => 'Error', 'message' => 'Produk sudah dimasukkan tidak bisa duplikat, silahkan edit'));
            }else{
                $this->tItem->add($produksi_job_id, $product_id, numberClean($qty));
            }
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    public function edit_produksi_item(){

        if ($this->input->post('id') != null 
        && $this->input->post('id') != ""
        && $this->input->post('product_id') != null
        && $this->input->post('product_id') != "" ) {
            $id = $this->input->post('id');
            $product_id = $this->input->post('product_id');
            $qty = $this->input->post('qty');
           
            $this->tItem->update($id, $product_id, numberClean($qty));
        
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }

    public function add_produksi_staff()
    {
        if ($this->input->post('produksi_job_id') != null 
        && $this->input->post('produksi_job_id') != ""
        && $this->input->post('staff_id') != ""
        ) {
            $produksi_job_id = $this->input->post('produksi_job_id');
            $staff_id = $this->input->post('staff_id');
            $price = $this->input->post('price');
            //cek if alreadygetIfExist
            //$cek = $this->dmodel->getWhere('smartpos_produksi_staff', ['produksi_job_id' => $produksi_job_id, 'staff_id' => $staff_id]);
            $cek = $this->dmodel->getIfExist('smartpos_template_staff', ['produksi_job_id' => $produksi_job_id, 'staff_id' => $staff_id]);
            if($cek){            
                echo json_encode(array('status' => 'Error', 'message' => 'Staff sudah dimasukkan tidak bisa duplikat, silahkan edit'));
            }else{
                $this->tStaff->add($produksi_job_id, $staff_id, $price);    
            }     
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    
    public function edit_produksi_staff()
    {
        if ($this->input->post('produksi_job_id') != null 
        && $this->input->post('produksi_job_id') != ""
        && $this->input->post('staff_id') != null
        && $this->input->post('staff_id') != ""
        && $this->input->post('id') != null
        && $this->input->post('id') != ""
        ) {
            $id = $this->input->post('id');
            $produksi_job_id = $this->input->post('produksi_job_id');
            $staff_id = $this->input->post('staff_id');
            $price = $this->input->post('price');
            
            
            $this->tStaff->edit($id, $produksi_job_id, $staff_id, $price);    
                
        }else{
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        } 
    }
    
    public function delete_t()
    {
        //hapus template
        $id = $this->input->post('deleteid');
        if ($id) {     
            
            $tjob = $this->dmodel->getWhere('smartpos_template_job', ['template_id' => $id]);
            foreach ($tjob as $srv) {                    
                $this->db->delete('smartpos_template_item', array('produksi_job_id' => $srv['id']));
                $this->db->delete('smartpos_template_staff', array('produksi_job_id' => $srv['id']));
            }
                    
            $this->db->delete('smartpos_template_job', array('template_id' => $id));
            $this->db->delete('smartpos_template', array('id' => $id));

            echo json_encode(array('status' => 'Success', 'message' => 'Template and all related template deleted Successfully!'));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        }
    }
    
    public function delete_j()
    {
        //hapus job
        $id = $this->input->post('deleteid');
        if ($id) {     
                
            $this->db->delete('smartpos_template_item', array('produksi_job_id' => $id));
            $this->db->delete('smartpos_template_staff', array('produksi_job_id' => $id));   

            $this->db->delete('smartpos_template_job', array('id' => $id));
            echo json_encode(array('status' => 'Success', 'message' => 'Job and all related job deleted Successfully!'));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        }
    }

    
    public function delete_i()
    {
        $id = $this->input->post('deleteid');
        //hapus item
        $this->db->delete('smartpos_template_item', array('produksi_job_id' => $id));

    }
    
    public function delete_s()
    {
        //hapus staff
        $id = $this->input->post('deleteid');
        //hapus item
        $this->db->delete('smartpos_template_staff', array('produksi_job_id' => $id));

    }
}